<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $date = '23/03/2023';

        $format = Carbon::parse(strtotime($date));

        // $format;
        // echo "<pre>";
        // for ($i = 0; $i < 3; $i++) {

        //     print_r($format->adddMonth()->format('Y-m-d'));
        // }

    }
}
