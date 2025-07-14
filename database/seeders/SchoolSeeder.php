<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $elementarySchools = [
            'MIM 2 KALIKUNING',
            'SD 3 KALIKUNUNG',
            'SD N 2 KALIKUNING',
            'MIM BUBAKAN',
            'SD 4 KALIKUNING',
            'SD N 1 BUBAKAN',
            'SD 1 KALIKUNING',
            'SD N 1 GASANG',
            'SD N 2 GASANG',
            'MIM GASANG',
            'SD N 1 NGILE',
            'SD N 2 NGILE',
            'SD N 5 KALIKUNING',
            'MIM 3 KALIKUNING',
            'SD N 1 LOSARI',
            'SD N 2 LOSARI',
            'SD N 4 LOSARI',
            'MI NU LOSARI',
            'SDIT ALFIKRI LOSARI',
            'MIM 1 KALIKUNING',
            'SDN 2 BUBAKAN'
        ];

        $juniorHighSchools = [
            'SMP HASYIM',
            'MA M\'AARIF',
            'MTS MA\'ARIF',
            'MA NURUL HUDA',
            'SMP N 2 TULAKAN',
            'MTS 5 KALIKUNING',
            'MTS NURUL HUDA',
            'MTS FILIAL KETRO'
        ];

        $otherSchools = [
            'Ponpes Nurul Huda',
            'Posyandu remaja'
        ];

        foreach ($elementarySchools as $school) {
            School::create([
                'name' => $school,
                'type' => 'SD'
            ]);
        }

        foreach ($juniorHighSchools as $school) {
            School::create([
                'name' => $school,
                'type' => 'SMP'
            ]);
        }

        foreach ($otherSchools as $school) {
            School::create([
                'name' => $school,
                'type' => 'OTHER'
            ]);
        }
    }
}
