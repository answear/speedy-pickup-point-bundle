<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Service;

use Answear\SpeedyBundle\Exception\CsvProcessingException;

class CsvUtil
{
    public static function parseCsvStringToArray(string $csv, int $length = 10000, string $separator = ','): array
    {
        $rows = [];
        $handle = fopen('php://memory', 'rb+');
        fwrite($handle, $csv);
        rewind($handle);

        if (false !== $handle) {
            while (false !== ($data = fgetcsv($handle, $length, $separator))) {
                $rows[] = $data;
            }
            fclose($handle);
        } else {
            throw new CsvProcessingException('Unable to process CSV string');
        }

        return $rows;
    }
}
