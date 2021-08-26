<?php

namespace Database\Seeders;

use App\Models\MealHistory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class MealHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $stream = Storage::disk()->readStream('poledniMenu_jidla.csv');
        while (($data = fgetcsv($stream, 1000, ",")) !== FALSE) {
            $m = new MealHistory();
            $m->restaurantId = 2;
            $m->type = $data[0] == 'polevka' ? 'soup' : 'main';
            $m->name = $data[1];
            $m->alergens = $data[2];
            $m->price = $data[3];
            $m->ammount = '';
            try {
                $m->saveOrFail();
            }
            catch(\Exception $e) {

            }

        }


        //
    }
}
