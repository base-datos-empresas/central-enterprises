<?php

class TitanData
{
    private $dataDir;
    private $cache = [];

    public function __construct($dataDir)
    {
        $this->dataDir = rtrim($dataDir, '/') . '/';
    }

    /**
     * Retrieves all landing data for a specific country code.
     * @param string $countryCode (2-letter ISO)
     * @return array
     */
    public function getCountryData($countryCode)
    {
        $countryCode = strtolower(trim($countryCode));
        if (isset($this->cache[$countryCode])) {
            return $this->cache[$countryCode];
        }

        // 1. Load Stats (Single Row)
        $stats = $this->readCsvRow($this->dataDir . "country_stats_{$countryCode}.csv");

        if (!$stats) {
            // Fallback / 404 handling logic can be done here or in controller
            return null;
        }

        // 2. Load Top Categories
        $categories = $this->readCsvAll($this->dataDir . "country_top_categories_{$countryCode}.csv");

        // 3. Load Top Cities (Optional)
        $cities = $this->readCsvAll($this->dataDir . "country_top_cities_{$countryCode}.csv");

        $data = [
            'stats' => $stats,
            'categories' => $categories,
            'cities' => $cities,
            'meta' => [
                'generated_at' => $stats['updated_at'] ?? date('c'),
                'source' => 'titan_batch'
            ]
        ];

        $this->cache[$countryCode] = $data;
        return $data;
    }

    private function readCsvRow($filepath)
    {
        if (!file_exists($filepath))
            return null;

        // PHP 8.4 Fix: Explicitly pass empty string for escape char if needed, or just let default handle if not deprecated.
        // Actually the deprecation is about passing null. file() returns lines.
        // str_getcsv(string $string, string $separator = ",", string $enclosure = "\"", string $escape = "\\")
        // The issue is likely passing null to one of these or similar. 
        // Let's iterate manually to be safe or use fgetcsv.

        $handle = fopen($filepath, 'r');
        if (!$handle)
            return null;

        $header = fgetcsv($handle);
        $row = fgetcsv($handle);
        fclose($handle);

        if (!$header || !$row)
            return null;

        return array_combine($header, $row);
    }

    private function readCsvAll($filepath)
    {
        if (!file_exists($filepath))
            return [];

        $data = [];
        if (($handle = fopen($filepath, "r")) !== FALSE) {
            $header = fgetcsv($handle);

            while (($row = fgetcsv($handle)) !== FALSE) {
                if (count($header) === count($row)) {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
        return $data;
    }
}
