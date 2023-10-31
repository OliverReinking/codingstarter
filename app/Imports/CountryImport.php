<?php

namespace App\Imports;

use App\Models\Country;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CountryImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        //Log::info('CountryImport.php model', [
        //    'row' => $row,
        //]);
        //
        // lege neues Country in countries an
        $article = Country::create([
            'name' => $row['name'],
            'alpha_2' => $row['alpha_2'],
            'alpha_3' => $row['alpha_3'],
            'country_code' => $row['country_code'],
            'iso_3166_2' => $row['iso_3166_2'],
            'region' => $row['region'],
            'sub_region' => $row['sub_region'],
            'intermediate_region' => $row['intermediate_region'],
            'region_code' => $row['region_code'],
            'sub_region_code' => $row['sub_region_code'],
            'intermediate_region_code' => $row['intermediate_region_code'],
        ]);
    }
}
