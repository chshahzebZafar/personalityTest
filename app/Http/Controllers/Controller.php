<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

abstract class Controller
{
    function testFee()
    {
        // Call external API
        $response = Http::get('https://test.myrtcat.com/api/career-test-fee');

        if ($response->successful()) {
            $fee = $response->json()['fee'] ?? 0;
        } else {
            // fallback if API fails
            $fee = 0;
        }
        return $fee;
    }
}
