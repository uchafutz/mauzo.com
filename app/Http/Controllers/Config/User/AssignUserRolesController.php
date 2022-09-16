<?php

namespace App\Http\Controllers\Config\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AssignUserRolesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, User $user)
    {
        //
    }
}
