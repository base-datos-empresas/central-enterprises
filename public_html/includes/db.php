<?php
require_once __DIR__ . '/../stripe/config.php';

class DB
{
    private static $pdo = null;

    public static function connect()
    {
        if (self::$pdo === null) {
            try {
                $dsn = 'sqlite:' . DB_PATH;
                self::$pdo = new PDO($dsn);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                // Create table if not exists (Auto-migration)
                self::initSchema();
            } catch (PDOException $e) {
                die("DB Connection Error: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }

    private static function initSchema()
    {
        $query = "CREATE TABLE IF NOT EXISTS subscriptions (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            stripe_customer_id TEXT,
            stripe_subscription_id TEXT,
            stripe_price_id TEXT,
            status TEXT,
            current_period_end INTEGER,
            invoice_url TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";
        self::$pdo->exec($query);

        // Add index on customer_id for fast lookups
        $indexQuery = "CREATE INDEX IF NOT EXISTS idx_stripe_cust ON subscriptions(stripe_customer_id)";
        self::$pdo->exec($indexQuery);
    }
}
?>