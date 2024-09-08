<?php

namespace App\Http\Controllers;

use App\Models\Affiliates;

class SiteController extends Controller
{
    public function __invoke()
    {
        return view(
            'welcome',
            [
                'affiliates' => Affiliates::getAffiliatesWithinRange()
            ]
        );
    }
}
