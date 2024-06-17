<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Service;

use Answear\SpeedyBundle\Exception\CsvProcessingException;

class CsvUtil
{
    public static function parseCsvStringToSplFileObject(string $csv): \SplFileObject
    {
        $file = new \SplFileObject('php://temp', 'r+');
        $file->fwrite($csv);
        $file->rewind();
        $file->setFlags(\SplFileObject::READ_CSV | \SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

        $headers = $file->fgetcsv();
        if (false === $headers) {
            throw new CsvProcessingException('File is empty.');
        }

        return $file;
    }
}
