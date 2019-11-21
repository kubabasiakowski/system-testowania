<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->status = 'administrator';
        $user->name = 'Jan';
        $user->surname = 'Kowalski';
        $user->login = 'jankowalski';
        $user->email = 'kowalskijan@o2.pl';
        $user->password = bcrypt('jankowalski');
        $user->is_active = 'true';
        $user->save();

        $user = new User();
        $user->status = 'prowadzacy';
        $user->name = 'Piotr';
        $user->surname = 'Rak';
        $user->login = 'piotrek';
        $user->email = 'piotrrak@onet.pl';
        $user->password = bcrypt('piotrek');
        $user->is_active = 'true';
        $user->save();

        $user = new User();
        $user->status = 'student';
        $user->name = 'Jakub';
        $user->surname = 'Basiakowski';
        $user->login = 'kubsi';
        $user->email = 'kubik@o2.pl';
        $user->password = bcrypt('haslo1');
        $user->is_active = 'true';
        $user->save();

        $user = new User();
        $user->status = 'student';
        $user->name = 'Michał';
        $user->surname = 'Duży';
        $user->login = 'michal';
        $user->email = 'michal@gmail.com';
        $user->password = bcrypt('michal');
        $user->is_active = 'true';
        $user->save();

        $user = new User();
        $user->status = 'student';
        $user->name = 'Katarzyna';
        $user->surname = 'Stańko';
        $user->login = 'Katarzyna';
        $user->email = 'katarzynastanko@gmail.com';
        $user->password = bcrypt('katarzynastanko');
        $user->is_active = 'true';
        $user->save();

        $user = new User();
        $user->status = 'student';
        $user->name = 'Anna';
        $user->surname = 'Dąb';
        $user->login = 'annadab';
        $user->email = 'annadab@gmail.com';
        $user->password = bcrypt('annadab');
        $user->is_active = 'true';
        $user->save();
    }
}
