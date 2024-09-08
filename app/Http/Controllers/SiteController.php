<?php

namespace App\Http\Controllers;

use App\Models\Affiliates;
use Illuminate\Http\Request;

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
