<?php

namespace App\Http\Controllers\Dashbord;

use Illuminate\Http\Request;

class dashbordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('pages.dashboard.index');
    }
}
