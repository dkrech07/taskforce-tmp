<?php

declare(strict_types=1);

namespace TaskForce\utils;

use TaskForce\exceptions\CsvToSqlException;

class CheckDirectory
{
    public function __construct(string $csv_directory)
    {
        if (!$csv_directory) {
            throw new CsvToSqlException("Папка " . $csv_directory . " не найдена.");
        }
        $this->csv_directory = $csv_directory;
    }

    public function get_csv_files(): array
    {
        return glob($this->csv_directory  . '*' . '.csv');
    }
}
