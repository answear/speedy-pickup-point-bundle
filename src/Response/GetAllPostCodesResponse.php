<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response;

use Answear\SpeedyBundle\Response\Struct\PostCode;
use Answear\SpeedyBundle\Response\Struct\PostCodeCollection;
use Answear\SpeedyBundle\Service\CsvUtil;

class GetAllPostCodesResponse
{
    public PostCodeCollection $postCodes;

    public function __construct(PostCodeCollection $postCodes)
    {
        $this->postCodes = $postCodes;
    }

    public function getPostCodes(): PostCodeCollection
    {
        return $this->postCodes;
    }

    public static function fromCsv(string $csv): self
    {
        $file = CsvUtil::parseCsvStringToSplFileObject($csv);

        $collection = [];
        while (!$file->eof()) {
            $row = $file->fgetcsv();

            $postCode = new PostCode();
            $postCode->postCode = $row[0];
            $postCode->siteId = (int) $row[1];

            $collection[] = $postCode;
        }

        return new self(
            new PostCodeCollection($collection)
        );
    }
}
