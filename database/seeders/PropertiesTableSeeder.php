<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use Illuminate\Support\Facades\Storage;

class PropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvData = Storage::get('csv/data.csv');
        $lines = explode(PHP_EOL, $csvData);
        $header = null;

        foreach ($lines as $line) {
            $data = str_getcsv($line);

            if (!$header) {
                $header = $data;
            } else {
                $property = new Property();
                $property->name = $data[0];
                $property->price = (float) $data[1];
                $property->bedrooms = (int) $data[2];
                $property->bathrooms = (int) $data[3];
                $property->storeys = (int) $data[4];
                $property->garages = (int) $data[5];
                $property->save();
            }
        }
    }
}
