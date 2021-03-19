<?php

namespace Tests\Feature;

use Tests\TestCase;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class UrlTest extends TestCase
{
    private $id;
    private $name;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        \Artisan::call('migrate');
        \Artisan::call('db:seed');

        $faker = Factory::create();

        $urlParsed = parse_url($faker->url);
        $this->name = "{$urlParsed['scheme']}://{$urlParsed['host']}";
        $url = [
            'name' => $this->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $this->id = DB::table('urls')->insertGetId($url);
        DB::table('url_checks')->insert(
            [
                'url_id' => $this->id,
                'status_code' => null,
                'h1' => null,
                'keywords' => null,
                'description' => null,
                'created_at' => '2021-03-17',
                'updated_at' => '2021-03-17'
            ]
        );
        Http::fake([$this->name => Http::response(['test'], 200, ['Headers'])]);
    }
    public function testIndex()
    {
        $response = $this->get(route('urls.index'));
        $response->assertOk();
    }
    public function testShow()
    {
        $response = $this->get(route('urls.show', $this->id));
        $response->assertOk();
    }
    public function testStore()
    {
        $faker = Factory::create();
        $urlParsed = parse_url($faker->url);
        $url = "{$urlParsed['scheme']}://{$urlParsed['host']}";
        $response = $this->post(route('urls.store'), ['url' => ['name' => $url]]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('urls', ['name' => $url]);
    }
    public function testEdit()
    {
        $response = $this->get(route('urls.checks', $this->id));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('url_checks', [
            'url_id' => $this->id
        ]);
        $response = Http::get($this->name);
        $this->assertEquals(200, $response->status());
    }
}
