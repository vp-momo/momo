<?php

namespace Database\Seeders;

use App\Models\Events;
use Illuminate\Database\Seeder;

class EventDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Events::where('type', 'day')->delete();
        $data = [];
        for($i = 1; $i <= 5; $i++){
            $data[] = [
                "type" => "day",
                "position" => $i,
                "created_at" => now(),
                "updated_at" => now(),
            ];
        }
        Events::insert($data);

    }
}
