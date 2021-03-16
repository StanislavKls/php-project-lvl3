<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class UrlTest extends TestCase
{
    public $id;
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
        $name = "{$urlParsed['scheme']}://{$urlParsed['host']}";
        $url = [
            'name' => $name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $this->id = DB::table('urls')->insertGetId($url);

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
        $response = $this->post(route('urls.store'));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('urls', ['id' => $this->id]);
    }
}