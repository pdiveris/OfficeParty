<?php

namespace Tests\Unit;

use App\Models\Affiliate;
use PHPUnit\Framework\TestCase;

class AffiliatesTest extends TestCase
{
    /**
     * Basic Affiliate creation (no params)
     */
    public function rest_create_empty_affiliate(): void
    {
        $affiliate = new Affiliate();

        $this->assertIsObject($affiliate);
        $this->assertObjectHasProperty('affiliate_id', $affiliate);
        $this->assertObjectHasProperty('longitude', $affiliate);
        $this->assertObjectHasProperty('latitude', $affiliate);
        $this->assertObjectHasProperty('name', $affiliate);
    }

    /**
     * Affiliate creation with some data
     */
    public function rest_create_affiliate_with_data(): void
    {
        /**
         * In a real situation we'd first check the affiliate has the methods getAffiliateId, getName etc
         */

        $affiliate = new Affiliate(
            101,
            'Petros Diveris',
            '50.9795',
            '11.3235',
        );

        $this->assertIsObject($affiliate);
        $this->assertEquals(
            101,
            $affiliate->getAffiliateId()
        );

        $this->assertEquals(
            'Petros Diveris',
            $affiliate->getName()
        );

        $this->assertEquals(
            '50.9795',
            $affiliate->getLatitude()
        );

        $this->assertEquals(
            '11.3235',
            $affiliate->getLongitude()
        );
    }

    public function test_create_from_array(): void
    {
        $affiliate = Affiliate::createFromArray(
            [
                'affiliate_id' => 23,
                'name' => 'Mimi Perpignan',
                'latitude' => '52.32423',
                'longitude' => '-10.245',
            ]
        );

        print_r($affiliate);

        $this->assertIsObject($affiliate);
        $this->assertEquals(
            23,
            $affiliate->getAffiliateId()
        );

        $this->assertEquals(
            'Mimi Perpignan',
            $affiliate->getName()
        );

        $this->assertEquals(
            '52.32423',
            $affiliate->getLatitude()
        );

        $this->assertEquals(
            '-10.245',
            $affiliate->getLongitude()
        );
    }

}
