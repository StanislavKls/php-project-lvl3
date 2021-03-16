<?php

namespace App\Http\Controllers;

use App\Http\Requests\Urls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UrlsController extends Controller
{
    public function index(Request $request)
    {
        $urls = DB::table('urls')->get();
        $flash = $request->session()->get('status');
        return view('urls.index', compact('flash', 'request', 'urls'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Urls $request)
    {
        $request->validated();
        $data = parse_url($request->input('url.name'));
        $name = "{$data['scheme']}://{$data['host']}";
        $now = now();
        DB::table('urls')->insert([
            'created_at' => $now,
            'updated_at' => $now,
            'name' => $name,
        ]);
        $request->session()->flash('status', 'URL добавлен!');
        return redirect()
               ->route('urls.index'); 
    }
    public function show(Request $request)
    {
        $id = $request->id;
        $url = DB::table('urls')->find($id);
        var_dump($url);
        return view('urls.show', compact('url'));
    }
}
