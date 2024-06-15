<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class OptimizePage extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function optimize()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        Artisan::call('optimize:clear');

        return 'Optimization completed';
    }
}