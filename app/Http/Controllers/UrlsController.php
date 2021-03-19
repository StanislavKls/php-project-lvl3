<?php

namespace App\Http\Controllers;

use App\Http\Requests\Urls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use DiDom\Document;

class UrlsController extends Controller
{
    public function index(Request $request): \Illuminate\View\View
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
    public function store(Urls $request): \Illuminate\Http\RedirectResponse
    {
        $request->validated();
        $data = parse_url($request->input('url.name'));
        $name = "{$data['scheme']}://{$data['host']}";
        $now = now();

        if (DB::table('urls')->where('name', $name)->exists()) {
            $request->session()->flash('status', 'URL уже был добавлен!');
            return redirect()->route('home.index');
        } else {
            DB::table('urls')->insert([
                'created_at' => $now,
                'updated_at' => $now,
                'name' => $name,
            ]);
            $request->session()->flash('status', 'URL добавлен!');
        }
        return redirect()->route('urls.index');
    }
    public function show(Request $request): \Illuminate\View\View
    {
        $id = $request->id;
        $url = DB::table('urls')->find($id);
        $urlInfo = DB::table('url_checks')->where('url_id', '=', $id)->get();
        return view('urls.show', compact('url', 'urlInfo'));
    }
    public function edit(Request $request): \Illuminate\Http\RedirectResponse
    {
        $id  = $request->id;
        $now = now();
        $url = DB::table('urls')->find($id);
        $response = Http::get($url->name);
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
