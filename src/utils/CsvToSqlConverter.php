<?php

declare(strict_types=1);

namespace TaskForce\utils;

use TaskForce\exceptions\CsvToSqlException;
use TaskForce\exceptions\FileSourceException;
use SplFileObject;
use RuntimeException;

class CsvToSqlConverter
{
    public function __construct($sql_directory)
    {
        // Проверяю доступна ли папка для сохранения sql-файлов;
        if (!file_exists($sql_directory)) {
            throw new CsvToSqlException("Папка для сохранения sql-файлов " . $sql_directory . " не найдена.");
        }
        // Задаю директорию, если переданная в класс папка присутствует в проекте;
        $this->sql_directory = $sql_directory;
    }

    // Получаю колонки таблицы БД;
    private function get_tables_columns(SplFileObject $csv_file): string
    {
        // Перевожу файловый указатель в начало файла;
        $csv_file->rewind();
        // Получаю строку из файла в массив;
        $line = $csv_file->fgetcsv();
        $columns = '';
        // Пробегаюсь по массиву, пишу данные в строку: первое, извлеченное выше значение + остальные значения с запятой вначале;
        foreach ($line as $line_key => $line_value) {
            if ($line_key === 0) {
                $columns = $line_value;
            } else {
                $columns .= ', ' . $line_value;
            }
        }
        return $columns;
    }

    private function csv_to_string(array $array): string
    {
        return implode('", "', $array);
    }

    // Пишу данные в sql-файл;
    private function write_sql_line(SplFileObject $sql_file, string $sql_line): void
    {
        // Пишу в файл строку sql;
        $sql_file->fwrite("$sql_line\r\n");
    }

    private function get_next_line(SplFileObject $csv_file): iterable
    {
        // SplFileObject::eof — Проверяет, достигнут ли конец файла
        while (!$csv_file->eof()) {
            // SplFileObject::fgetcsv — Получить строку из файла и её разбор как поля CSV
            yield $csv_file->fgetcsv();
        }
    }

    public function convert_csv_file($csv_file_name): void
    {
        $csv_file = new SplFileObject($csv_file_name);

        try {
            $sql_file_name = pathinfo($csv_file_name, PATHINFO_FILENAME);
            $sql_file_path = $this->sql_directory . $sql_file_name . '.sql';
            $sql_file = new SplFileObject($sql_file_path, 'w');
        } catch (RuntimeException $error) {
            throw new FileSourceException('Ошибка создания sql-файла: ' . $error);
        }

        // Пропускаю пустые строки в файле; Удаляю символы переноса в конце строки;
        $csv_file->setFlags(SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);

        // Получаю колонки таблицы;
        $table_columns = $this->get_tables_columns($csv_file);

        $first_values = $this->csv_to_string($csv_file->fgetcsv());

        // Пишу запрос на добавление данных в таблицу БД: INSERT + колонки + первую строку значений;
        $sql_query = "INSERT INTO $sql_file_name (" . $table_columns . ")\r\n" . 'VALUES ("' . $first_values . '"),';
        // Пишу запрос в файл;
        $this->write_sql_line($sql_file, $sql_query);

        // Получаю следующую строку из csv-файла и пишу ее в sql-файл;
        foreach ($this->get_next_line($csv_file) as $next_values) {
            if ($next_values) {
                $next_values = $this->csv_to_string($next_values);

                $line = '("' . $next_values . '"),';
                $line = str_replace('"NULL"', 'NULL', $line);
                $this->write_sql_line($sql_file, $line);
            }
        }

        // Смещаю файловый указатель на последнюю ',' и заменяю ее на ';';
        $sql_file->fseek(-3, SEEK_END);
        $sql_file->fwrite(';');
    }
}
