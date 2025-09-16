<?php
// HELLO WORLD
// server.php
// A lightweight PHP server script providing the same functionality as server.js (Express)
// ------------------------------------------------------------
// Usage (development):
//     php -S localhost:3000 server.php
// This will boot PHP's built-in web server and delegate static
// assets under the "public" directory while handling API routes
// and dynamic endpoints below.
// ------------------------------------------------------------

// Allow the built-in server to serve existing static files directly
if (php_sapi_name() === 'cli-server') {
    $requestedPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $filePath      = __DIR__ . $requestedPath;
    if (is_file($filePath)) {
        return false; // Serve the requested resource as-is.
    }
}

// ------------------------------------------------------------
// Configuration
// ------------------------------------------------------------
$port     = getenv('PORT') ?: 3000;
$baseUrl  = getenv('BASE_URL') ?: "http://localhost:{$port}";
$dbPath   = getenv('DB_NAME') ?: __DIR__ . '/campaign.db';

// Load goodies definitions once
$goodies = json_decode(file_get_contents(__DIR__ . '/goodies.json'), true);

// ------------------------------------------------------------
// Database setup
// ------------------------------------------------------------
$db = new SQLite3($dbPath);
initializeDatabase($db);

function initializeDatabase(SQLite3 $db): void
{
    // Create table if it doesn't exist
    $db->exec(<<<SQL
        CREATE TABLE IF NOT EXISTS campaign_status (
            id INTEGER PRIMARY KEY,
            amountRaised REAL,
            goal REAL,
            startDate TEXT,
            endDate  TEXT,
            supportersCount INTEGER
        )
    SQL);

    // Ensure a default row with id = 1 exists
    $result = $db->querySingle('SELECT COUNT(*) as count FROM campaign_status');
    if ((int)$result === 0) {
        $db->exec(<<<SQL
            INSERT INTO campaign_status (id, amountRaised, goal, startDate, endDate, supportersCount)
            VALUES (1, 10307, 30000, '2023-04-29', '2023-06-19', 107)
        SQL);
    }
}

function jsonResponse($data, int $statusCode = 200): void
{
    header('Content-Type: application/json');
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

function sendFile(string $path, string $contentType): void
{
    if (!is_file($path)) {
        http_response_code(404);
        echo 'Not found.';
        exit;
    }
    header("Content-Type: {$contentType}");
    readfile($path);
    exit;
}

// ------------------------------------------------------------
// Routing
// ------------------------------------------------------------
$uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// ---- CORS headers (allow all origins) ----
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Handle preflight request quickly
if ($method === 'OPTIONS') {
    http_response_code(204); // No Content
    exit;
}

switch (true) {
    // ----------------------------------------------------------------
    // Config JS – Exposes API base URL to the browser
    // ----------------------------------------------------------------
    case $uri === '/config.js':
        header('Content-Type: application/javascript');
        echo "window.config = { apiUrl: \"{$baseUrl}\" };";
        exit;

    // ----------------------------------------------------------------
    // API: Get campaign status
    // ----------------------------------------------------------------
    case $uri === '/api/campaign-status' && $method === 'GET':
        $row = $db->querySingle('SELECT * FROM campaign_status', true);
        jsonResponse($row ?: new stdClass());

    // ----------------------------------------------------------------
    // API: Submit donation (manual form submission)
    // ----------------------------------------------------------------
    case $uri === '/api/submit-donation' && $method === 'POST':
        $payload = json_decode(file_get_contents('php://input'), true);
        $amount  = isset($payload['amount']) ? (float)$payload['amount'] : 0;
        $stmt    = $db->prepare('UPDATE campaign_status SET amountRaised = amountRaised + :amt WHERE id = 1');
        $stmt->bindValue(':amt', $amount, SQLITE3_FLOAT);
        $stmt->execute();
        http_response_code(200);
        exit;

    // ----------------------------------------------------------------
    // API: Get goodies list
    // ----------------------------------------------------------------
    case $uri === '/api/goodies' && $method === 'GET':
        jsonResponse($goodies);

    // ----------------------------------------------------------------
    // API: Payrexx webhook
    // ----------------------------------------------------------------
    case $uri === '/api/payrexx-webhook' && $method === 'POST':
        $payload     = json_decode(file_get_contents('php://input'), true);
        $transaction = $payload['transaction'] ?? null;
        if ($transaction && ($transaction['status'] ?? '') === 'confirmed') {
            $amount = ($transaction['amount'] ?? 0) / 100.0; // Amount is provided in cents
            // Update amountRaised
            $stmt = $db->prepare('UPDATE campaign_status SET amountRaised = amountRaised + :amt WHERE id = 1');
            $stmt->bindValue(':amt', $amount, SQLITE3_FLOAT);
            $stmt->execute();
            // Increment supporters count
            $db->exec('UPDATE campaign_status SET supportersCount = supportersCount + 1 WHERE id = 1');
        }
        http_response_code(200);
        exit;

    // ----------------------------------------------------------------
    // Payment success / failed pages
    // ----------------------------------------------------------------
    case $uri === '/payment-success' && $method === 'GET':
        sendFile(__DIR__ . '/public/success.html', 'text/html');

    case $uri === '/payment-failed' && $method === 'GET':
        sendFile(__DIR__ . '/public/failed.html', 'text/html');

    // ----------------------------------------------------------------
    // Fallback: 404 Not Found
    // ----------------------------------------------------------------
    default:
        http_response_code(404);
        echo 'Endpoint not found.';
        exit;
}

// ------------------------------------------------------------
// Graceful shutdown (CLI-server only)
// ------------------------------------------------------------
register_shutdown_function(static function () use ($db) {
    $db?->close();
});
