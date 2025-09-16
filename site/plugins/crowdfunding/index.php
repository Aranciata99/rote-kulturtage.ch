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
                    $payload = kirby()->request()->body()->toArray();

                    // TODO: Verify Payrexx signature here

                    if (($payload['transaction']['status'] ?? null) === 'confirmed') {
                        $amount = ($payload['transaction']['amount'] ?? 0) / 100.0;
                        $db     = crowdfundingDb();
                        $stmt   = $db->prepare('UPDATE campaign_status SET amount_raised = amount_raised + :amt, supporters_count = supporters_count + 1 WHERE id = 1');
                        $stmt->bindValue(':amt', $amount);
                        $stmt->execute();
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
