<?php

use Illuminate\Database\Seeder;

class MessageSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\IO\Models\Message::class, 25)->create();
    }
}
