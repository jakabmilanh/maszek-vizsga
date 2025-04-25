<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Job;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create 2 employers
        $employer1 = User::create([
            'username' => 'Tamás',
            'email' => 'tamas@example.com',
            'password' => Hash::make('password'),
            'role' => 'Munkáltató',
            'telephone' => '+36705790793',
        ]);

        $employer2 = User::create([
            'username' => 'Béla',
            'email' => 'bela@example.com',
            'password' => Hash::make('password'),
            'role' => 'Munkáltató',
            'telephone' => '201203758',
        ]);

        // Create 1 employee
        User::create([
            'username' => 'Ferenc',
            'email' => 'ferenc@example.com',
            'password' => Hash::make('password'),
            'role' => 'Munkavállaló',
            'telephone' => '307003998',
        ]);

        $jobs = [
            [
                'title' => 'Kertgondozó heti 2 alkalomra',
                'description' => 'Budai családi ház kertjének gondozásához keresünk megbízható kertészt heti 2 alkalomra. Feladat: fűnyírás, metszés, locsolás.',
                'location' => 'Budapest II. kerület',
                'category' => 'Több alkalom',
                'salary'  => 2500,
            ],
            [
                'title' => 'Napi takarító irodaépületbe',
                'description' => 'XIII. kerületi irodaházba keresünk napi 4 órás takarítót. Munkaidő: reggel 6-10 között. Tapasztalat előny.',
                'location' => 'Budapest XIII. kerület',
                'category' => 'Részmunkaidős',
                'salary'  => 1800,
            ],
            [
                'title' => 'Egyszeri költöztetés segítő',
                'description' => 'Május 10-én költözéshez keresünk 2 fő erős fizikumú embert. Bútorok pakolása, teherautóra rakodás.',
                'location' => 'Érd',
                'category' => 'Egyszeri alkalom',
                'salary'  => 70000,
            ],
            [
                'title' => 'Online ügyfélszolgálati munkatárs',
                'description' => 'Webshopunkhoz keresünk otthonról végezhető ügyfélszolgálati munkatársat. Feltétel: jó kommunikáció, internetkapcsolat.',
                'location' => 'Otthonról',
                'category' => 'Teljes munkaidős',
                'salary'  => 2700,
            ],
            [
                'title' => 'Teljes munkaidős árufeltöltő',
                'description' => 'XVI. kerületi üzletbe keresünk árufeltöltőt teljes munkaidőbe. Napi 8 óra, heti 5 nap. Stabil munkahely.',
                'location' => 'Budapest XVI. kerület',
                'category' => 'Teljes munkaidős',
                'salary'  => 2000,
            ],
            [
                'title' => 'Otthon végezhető adatbevitel',
                'description' => 'Egyszerű adatbevitel számítógépen, otthonról. Napi 2-3 óra elfoglaltság. Saját laptop szükséges.',
                'location' => 'Otthonról',
                'category' => 'Otthon végezhető',
                'salary'  => 10000,
            ],
        ];

        foreach ([$employer1, $employer2] as $index => $employer) {
            for ($i = 0; $i < 3; $i++) {
                $jobData = $jobs[$index * 3 + $i];
                Job::create([
                    'title' => $jobData['title'],
                    'description' => $jobData['description'],
                    'location' => $jobData['location'],
                    'category' => $jobData['category'],
                    'salary' => $jobData['salary'],
                    'status' => 'open',
                    'employer_id' => $employer->id,
                ]);
            }
        }

    }
}
