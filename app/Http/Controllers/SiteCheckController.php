<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteCheckController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  int  $check_id
     */
    public function show(Request $request, $id, $check_id): \Illuminate\View\View
    {
        $url   = DB::table('urls')->find($id);
        $check = DB::table('url_checks')->find($check_id);
        return view('urls.checks', compact('url', 'check'));
    }
}
