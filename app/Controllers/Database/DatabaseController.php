<?php

namespace App\Controllers\Database;

use App\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Facades\Components\Config;
use App\Facades\Components\Redirect;
use App\Facades\Components\Session;
use App\Facades\Components\Crypto;

class DatabaseController extends Controller {

    protected function seed() {

        if (Config::application('environment') != 'development') {

            Session::flash('alert', [
                'type' => 'warning',
                'title' => 'Production Mode',
                'text' => 'The database could not be seeded because you are not in development mode.'
            ]);

            Redirect::route('login-page');
        }

        // Start Seeds
        
        $admin = Role::create([
            'role' => 'Administrator'
        ]);

        $default = Role::create([
            'role' => 'Default'
        ]);
        
        $denis = User::create([
            'email' => 'denisrpriebe@taylorcorp.com',
            'first_name' => 'Denis',
            'last_name' => 'Priebe',
            'password' => Crypto::hash('12500')
        ]);
        
        $denis->roles()->save($default);
        $denis->roles()->save($admin);
        
        $keith = User::create([
            'email' => 'keselle@taylorcorp.com',
            'first_name' => 'Keith',
            'last_name' => 'Selle',
            'password' => Crypto::hash('password')
        ]);
        
        $keith->roles()->save($default);
        $keith->roles()->save($admin);

        // End Seeds
        
        Session::flash('alert', [
            'type' => 'success',
            'title' => 'Database Seeded',
            'text' => 'The database has been successfully seeded.'
        ]);

        Redirect::route('login-page');
    }

}
