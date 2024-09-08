<?php

namespace App\Models;

use Illuminate\Support\Str;

class Affiliate
{
    public function __construct(
        private ?int $affiliate_id = null,
        private ?string $name = '',
        private ?string $latitude = '',
        private ?string $longitude = ''
    )
    {
    }
    /**
     * @return int
     */
    public function getAffiliateId(): int
    {
        return $this->affiliate_id;
    }

    /**
     * @param int $affiliate_id
     * @return Affiliate
     */
    public function setAffiliateId(int $affiliate_id): Affiliate
    {
        $this->affiliate_id = $affiliate_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Affiliate
     */
    public function setName(string $name): Affiliate
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getLatitude(): string
    {
        return $this->latitude;
    }

    /**
     * @param string $latitude
     * @return Affiliate
     */
    public function setLatitude(string $latitude): Affiliate
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return string
     */
    public function getLongitude(): string
    {
        return $this->longitude;
    }

    /**
     * @param string $longitude
     * @return Affiliate
     */
    public function setLongitude(string $longitude): Affiliate
    {
        $this->longitude = $longitude;
        return $this;
    }

    public static function createFromArray(?array $data): Affiliate
    {
        $affiliate = new Affiliate();
        foreach ($data as $key => $datum) {
            $setter = 'set' . Str::camel($key);
            if (method_exists($affiliate, $setter)) {
                $affiliate->$setter($datum);
            }
        }

        return $affiliate;
    }
}
