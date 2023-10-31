<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Imports\CountryImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class CountrySeeder extends Seeder
{
    public function run()
    {
        Country::truncate();
        //
        Excel::import(new CountryImport, storage_path('app/public/data/countries.csv'));
        //
    }
}
