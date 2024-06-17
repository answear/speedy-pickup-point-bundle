<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Service;

class CsvUtil
{
    public static function parseCsvStringToSplFileObject(string $csv): \SplFileObject
    {
        $file = new \SplFileObject('php://temp', 'r+');
        $file->fwrite($csv);
        $file->rewind();
        $file->setFlags(\SplFileObject::READ_CSV | \SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

        return $file;
    }
}
