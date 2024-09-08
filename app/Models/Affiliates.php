<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Collection;
use JsonException;

class Affiliates
{
    protected ?Collection $affiliates;

    public function getAffiliates(): ?Collection
    {
        return $this->affiliates;
    }

    /**
     * @throws Exception
     */
    public static function loadManyFromTextFile(?string $path = ''): Collection
    {
        $affiliate = new self;

        if(!$lines = file($path))
        {
            throw new Exception('Load Failed');
        }

        $data = [];
        foreach ($lines as $line) {
            $datum = json_decode($line, true);
            if ($data === null) {
                throw new JsonException('Invalid JSON data passed');
            }
            $data[] = $datum;
        }
        $affiliate->affiliates = collect($data);

        return $affiliate->getAffiliates();
    }
}
