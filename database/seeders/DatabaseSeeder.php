<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(5)->create();   //factory ki madad se dummy users create hue       // php artisan db:seed   to run this seeder(creates 5 dummy users)           (migrate refresh krne se ye seeding hat jayegi)
          $user1=User::factory()->create(['name'=>'John','email'=>'john@gmail.com'])   ; #Specifically, the method will look for a factory in the Database\Factories namespace that has a class name matching the model name and is suffixed with Factory                                                 // refresh --seed    if you want to refresh without letting the seeding go.           WE CAN create a factory like this for listing as well.(make:factory Listingfactory)
         listing::factory(15)->create(['user_id'=> $user1->id ]);  #or poora create marna ho to listing::create([]);
    }
}

