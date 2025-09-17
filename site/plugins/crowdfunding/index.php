<?php
// site/plugins/crowdfunding/index.php

use Kirby\Http\Response;
use Kirby\Cms\App as Kirby;

// ------------------------------------------------------------
// SQLite-based crowdfunding plugin - no external dependencies
// ------------------------------------------------------------

Kirby::plugin('custom/crowdfunding', [
    // --------------------------------------------------------
    // Options (none yet)
    // --------------------------------------------------------

    // --------------------------------------------------------
    // API Routes
    // --------------------------------------------------------
    'api' => [
        'authentication' => function() { return true; },
        'routes' => [
            [
                'pattern' => 'campaign-status',
                'method'  => 'GET',
                'action'  => function () {
                    // Ensure table exists
                    crowdfundingEnsureTable();
                    
                    $db   = crowdfundingDb();
                    $stmt = $db->query('SELECT * FROM campaign_status LIMIT 1');
                    $row  = $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
                    $row  = crowdfundingToCamelCase($row);
                    return new Response(json_encode($row), 'application/json');
                },
            ],
            [
                'pattern' => 'submit-donation',
                'method'  => 'POST',
                'action'  => function () {
                    $payload = kirby()->request()->body()->toArray();
                    $amount  = isset($payload['amount']) ? (float)$payload['amount'] : 0;

                    $db   = crowdfundingDb();
                    $stmt = $db->prepare('UPDATE campaign_status SET amount_raised = amount_raised + :amt WHERE id = 1');
                    $stmt->bindValue(':amt', $amount);
                    $stmt->execute();

                    return new Response('OK', 'text/plain');
                },
            ],
            [
                'pattern' => 'goodies',
                'method'  => 'GET',
                'action'  => function () {
                    $path = kirby()->root('index') . '/assets/jason/goodies.json';
                    $json = file_exists($path) ? file_get_contents($path) : '[]';
                    return new Response($json, 'application/json');
                },
            ],
            [
                'pattern' => 'payrexx-webhook',
                'method'  => 'POST',
                'action'  => function () {
                    // Ensure all tables exist
                    crowdfundingEnsureTable();
                    
                    $payload = kirby()->request()->body()->toArray();
                    $rawBody = kirby()->request()->body()->toString();

                    // Verify Payrexx signature (optional but recommended)
                    $webhookSecret = option('crowdfunding.webhook_secret', ''); // Add to config
                    if ($webhookSecret) {
                        $signature = $_SERVER['HTTP_X_PAYREXX_SIGNATURE'] ?? '';
                        $expectedSignature = hash_hmac('sha256', $rawBody, $webhookSecret);
                        
                        if (!hash_equals($expectedSignature, $signature)) {
                            return new Response('Unauthorized', 'text/plain', 401);
                        }
                    }

                    // Log webhook for debugging
                    error_log('Payrexx webhook received: ' . $rawBody);
                    error_log('Webhook payload parsed: ' . json_encode($payload, JSON_PRETTY_PRINT));

                    $transactionStatus = $payload['transaction']['status'] ?? null;
                    error_log('Transaction status: ' . $transactionStatus);

                    if ($transactionStatus === 'confirmed') {
                        $amount = ($payload['transaction']['amount'] ?? 0) / 100.0;
                        $transactionId = $payload['transaction']['id'] ?? '';
                        
                        error_log("Processing confirmed transaction: ID={$transactionId}, Amount={$amount}");
                        
                        // Prevent duplicate processing
                        $db = crowdfundingDb();
                        $stmt = $db->prepare('SELECT COUNT(*) FROM transactions WHERE transaction_id = :tid');
                        $stmt->bindValue(':tid', $transactionId);
                        $stmt->execute();
                        
                        if ($stmt->fetchColumn() == 0) {
                            // Record transaction to prevent duplicates
                            $stmt = $db->prepare('INSERT INTO transactions (transaction_id, amount, processed_at) VALUES (:tid, :amt, :processed)');
                            $stmt->execute([
                                ':tid' => $transactionId,
                                ':amt' => $amount,
                                ':processed' => date('Y-m-d H:i:s')
                            ]);
                            
                            // Update campaign status
                            $stmt = $db->prepare('UPDATE campaign_status SET amount_raised = amount_raised + :amt, supporters_count = supporters_count + 1 WHERE id = 1');
                            $stmt->bindValue(':amt', $amount);
                            $stmt->execute();
                            
                            error_log("Transaction processed successfully. New total raised: " . ($amount + 25)); // Assuming previous amount
                        } else {
                            error_log("Transaction {$transactionId} already processed, skipping.");
                        }
                    } else {
                        error_log("Transaction status '{$transactionStatus}' not confirmed, skipping.");
                    }
                    return new Response('OK', 'text/plain');
                },
            ]
        ]
    ],

    // --------------------------------------------------------
    // Ready callback: ensure table exists
    // --------------------------------------------------------
    'ready' => function () {
        crowdfundingEnsureTable();
    },
]);

// ------------------------------------------------------------
// Helper functions (not namespaced, internal use)
// ------------------------------------------------------------
function crowdfundingDb(): PDO
{
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    // SQLite database stored in site/storage/
    $dbPath = dirname(__DIR__, 2) . '/storage/crowdfunding.sqlite';
    $dbDir = dirname($dbPath);
    
    // Ensure storage directory exists
    if (!is_dir($dbDir)) {
        mkdir($dbDir, 0755, true);
    }

    $dsn = "sqlite:{$dbPath}";
    
    $pdo = new PDO($dsn, null, null, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    return $pdo;
}

function crowdfundingEnsureTable(): void
{
    $db = crowdfundingDb();
    $db->exec('CREATE TABLE IF NOT EXISTS campaign_status (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        amount_raised      REAL DEFAULT 0,
        goal               REAL DEFAULT 0,
        start_date         TEXT,
        end_date           TEXT,
        supporters_count   INTEGER DEFAULT 0
    )');

    // Create transactions table for duplicate prevention
    $db->exec('CREATE TABLE IF NOT EXISTS transactions (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        transaction_id TEXT UNIQUE NOT NULL,
        amount REAL NOT NULL,
        processed_at TEXT NOT NULL
    )');

    // seed default row if empty
    $count = $db->query('SELECT COUNT(*) FROM campaign_status')->fetchColumn();
    if ($count == 0) {
        $stmt = $db->prepare('INSERT INTO campaign_status (amount_raised, goal, start_date, end_date, supporters_count)
                              VALUES (:raised, :goal, :start, :end, :sup)');
        $stmt->execute([
            ':raised' => 0,
            ':goal'   => 15000,
            ':start'  => '2025-09-16',
            ':end'    => '2025-10-16',
            ':sup'    => 0,
        ]);
    }
}

/**
 * Convert snake_case keys to camelCase recursively
 */
function crowdfundingToCamelCase(array $row): array
{
    $camel = [];
    foreach ($row as $k => $v) {
        $camelKey = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $k))));
        $camel[$camelKey] = $v;
    }
    return $camel;
}
