<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'robburley',
            'name'     => 'Rob Burley',
            'password' => 'secret',
            'email'    => 'rob@quantumjunction.co.uk',
        ]);

        $user->syncRoles(['Admin']);

        $user = User::create([
            'username' => 'dd',
            'name'     => 'Dave Duckworth',
            'password' => 'secret',
            'email'    => 'dave@quantumjunction.co.uk',
        ]);

        $user->syncRoles(['Admin']);
    }
}
