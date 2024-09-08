<?php

namespace App\Console\Commands;

use App\Models\Affiliates;
use Illuminate\Console\Command;

class ListInRange extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'affiliates:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List affiliates in range';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $affiliates = Affiliates::getAffiliatesWithinRange(
            [
                'name',
                'distance_from_dublin'
            ]
        );

        $this->table(
            ['Name', 'Distance'],
            $affiliates
        );
    }
}
