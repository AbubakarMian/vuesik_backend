<?php

use Illuminate\Database\Seeder;

use App\Models\Client;
class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::firstOrCreate(           
            ['client_id' => 'vuesik-app-mobile'],
            ['client_secret' => 'TW9iaWxlIENsaWVudElEOiBUVzlpYVd4bElFTnNhV1Z1ZEVsRU9pQjJkV1Z6YVdzdFlYQndMV']
        ); 
    }
}
