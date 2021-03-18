<?php

namespace App\Http\Controllers;

use App\Http\Requests\Urls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use DiDom\Document;

class UrlsController extends Controller
{
    public function index(Request $request)
    {

        $urls      = DB::table('urls')->get();
        $lastCheck = DB::table('url_checks')
                     ->select('url_id', 'created_at', 'status_code')
                     ->orderBy('url_id')
                     ->orderByDesc('created_at')
                     ->distinct('url_id')
                     ->get()
                     ->keyBy('url_id');

        $flash = $request->session()->get('status');
        return view('urls.index', compact('flash', 'urls', 'lastCheck'));
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
        $urlInfo = DB::table('url_checks')->where('url_id', '=', $id)->get();
        return view('urls.show', compact('url', 'urlInfo'));
    }
    public function edit(Request $request)
    {
        $id  = $request->id;
        $now = now();
        $url = DB::table('urls')->select('name')->where('id', '=', $id)->first()->name;
        $response = Http::get($url);
        $body = $response->body();
        $document = new Document($body);
        $h1 = optional($document->first('h1'))->text();
        $keywords = optional($document->first('meta[name=keywords]'))->attr('content');
        $description = optional($document->first('meta[name=description]'))->attr('content');

        DB::table('url_checks')->insert([
            'created_at'  => $now,
            'updated_at'  => $now,
            'url_id'      => $id,
            'status_code' => $response->status(),
            'h1'          => $h1,
            'keywords'    => $keywords,
            'description' => $description,
        ]);
        return redirect()
               ->route('urls.show', $id);
    }
}
