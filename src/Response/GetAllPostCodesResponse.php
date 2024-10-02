<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response;

use Answear\SpeedyBundle\Response\Struct\PostCode;
use Answear\SpeedyBundle\Response\Struct\PostCodeCollection;
use Answear\SpeedyBundle\Service\CsvUtil;

readonly class GetAllPostCodesResponse
{
    public function __construct(public PostCodeCollection $postCodes)
    {
    }

    public static function fromCsv(string $csv): self
    {
        $file = CsvUtil::parseCsvStringToSplFileObject($csv);

        $collection = [];
        foreach ($file as $i => $row) {
            if (0 === $i) {
                continue;
            }

            $postCode = new PostCode(
                $row[0],
                (int) $row[1]
            );

            $collection[] = $postCode;
        }

        return new self(
            new PostCodeCollection($collection)
        );
    }
}
