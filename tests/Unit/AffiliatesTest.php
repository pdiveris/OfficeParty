<?php

namespace Tests\Unit;

use App\Models\Affiliates;
use ErrorException;
use Exception;
use Tests\TestCase;

class AffiliatesTest extends TestCase
{
    /**
     * Basic Affiliate creation (no params)
     */
    public function zest_create_empty_affiliate(): void
    {
        $affiliate = new Affiliates();

        $this->assertIsObject($affiliate);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function zest_load_from_text_no_file(): void
    {
        $this->expectException(ErrorException::class);
        $var = Affiliates::loadManyFromTextFile(storage_path('data/afiliates.txt'));
    }

    /**
     * @throws Exception
     */
    public function zest_load_from_text(): void
    {
        $affiliates = Affiliates::loadManyFromTextFile(storage_path('data/affiliates.txt'));

        $this->assertEquals(
            'Illuminate\Support\Collection',
            get_class($affiliates)
        );
    }

    /**
     * @return void
     * @throws Exception
     *
     * {"latitude": "53.008769", "affiliate_id": 11, "name": "Isla-Rose Hubbard", "longitude": "-6.1056711"}
     */
    public function zest_load_from_text_actual_data(): void
    {
        $affiliates = Affiliates::loadManyFromTextFile(storage_path('data/affiliates.txt'));

        $filtered = $affiliates->where('affiliate_id', 11);

        $isla = $filtered->first();

        $this->assertEquals('Isla-Rose Hubbard', $isla['name']);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function test_find_range(): void
    {
        $affiliates = new Affiliates(storage_path('data/affiliates.txt'));
        $selected = $affiliates->getAffiliates()->where(
            'distance_from_dublin',
            '<=',
            100
        );

        $this->assertEquals(
            16,
            $selected->count()
        );
    }
}
