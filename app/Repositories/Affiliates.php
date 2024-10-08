<?php

namespace App\Repositories;

use App\Helpers;
use Exception;
use Illuminate\Support\Collection;
use JsonException;

class Affiliates
{
    const SORT_BY = 'affiliate_id';

    const DUBLIN_LAT = 53.3340285;
    const DUBLIN_LON = -6.2535495;

    protected ?Collection $affiliates;

    /**
     * @throws Exception
     */
    public function __construct(
        ?string $path = ''
    )
    {
        if ($path !== '') {
            $this->loadFromFile($path);
        }
    }

    /**
     * @throws Exception
     */
    private function loadFromFile(string $path): void
    {
        if(!$lines = file($path))
        {
            throw new Exception('Load Failed');
        }

        $data = [];
        foreach ($lines as $line) {
            $datum = json_decode($line, true);
            if ($datum === null) {
                throw new JsonException('Invalid JSON data passed');
            }

            $datum['distance_from_dublin'] = Helpers::getDistance(
                self::DUBLIN_LAT,
                self::DUBLIN_LON,
                $datum['latitude'],
                $datum['longitude']
            );

            $data[] = $datum;
        }
        $this->affiliates = collect($data)->sortBy(self::SORT_BY);
    }

    /**
     * @return Collection|null
     */
    public function getAffiliates(): ?Collection
    {
        return $this->affiliates;
    }

    /**
     * @throws Exception
     */
    public static function loadManyFromTextFile(?string $path = ''): Collection
    {
        $affiliate = new self($path);
        return $affiliate->getAffiliates();
    }

    /**
     * @throws Exception
     */
    public static function getAffiliatesWithinRange(?array $fields = []): ?array
    {
        $affiliates = new self(storage_path('data/affiliates.txt'));
        $selected = $affiliates->getAffiliates()->where(
            'distance_from_dublin',
            '<=',
            100
        );

        if (!empty($fields)) {
            return $selected->select($fields)->toArray();
        }

        return $selected->toArray();
    }
}
