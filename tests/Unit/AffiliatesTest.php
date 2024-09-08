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
    public function test_create_empty_affiliate(): void
    {
        $affiliate = new Affiliates();

        $this->assertIsObject($affiliate);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function test_load_from_text_no_file(): void
    {
        $this->expectException(ErrorException::class);
        $var = Affiliates::loadManyFromTextFile(storage_path('data/afiliates.txt'));
    }

    /**
     * @throws Exception
     */
    public function test_load_from_text(): void
    {
        $affs = Affiliates::loadManyFromTextFile(storage_path('data/affiliates.txt'));

        $this->assertEquals(
            'Illuminate\Support\Collection',
            get_class($affs)
        );
    }

    /**
     * @return void
     * @throws Exception
     *
     * {"latitude": "53.008769", "affiliate_id": 11, "name": "Isla-Rose Hubbard", "longitude": "-6.1056711"}
     */
    public function test_load_from_text_actual_data(): void
    {
        $affs = Affiliates::loadManyFromTextFile(storage_path('data/affiliates.txt'));

        $filtered = $affs->where('affiliate_id', 11);

        $isla = $filtered->first();

        $this->assertEquals('Isla-Rose Hubbard', $isla['name']);
    }

}
