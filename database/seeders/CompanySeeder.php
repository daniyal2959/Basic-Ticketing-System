<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::truncate();

        $company = new Company();
        $company->name = 'DigiKala';
        $company->save();

        $company = new Company();
        $company->name = 'Snapp';
        $company->save();

        $company = new Company();
        $company->name = 'BaSalam';
        $company->save();

        $company = new Company();
        $company->name = 'Bamilo';
        $company->save();

        $company = new Company();
        $company->name = 'Torob';
        $company->save();

        $company = new Company();
        $company->name = 'GapFilm';
        $company->save();

        User::find(2)->companies()->syncWithoutDetaching([1, 2, 3, 4, 5, 6]);
    }
}
