<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	
	    DB::table('users')->insert([
		    'role_id' => '1',
		    'name' => 'Admin',
		    'email' => 'admin@mail.com',
		    'email_verified_at' => now(),
		    'password' => Hash::make('secret'),
		    'created_at' => now(),
		    'updated_at' => now()
	    ]);
	    
	    DB::table('users')->insert([
		    'role_id' => '2',
		    'name' => 'Supervisor',
		    'email' => 'super@mail.com',
		    'email_verified_at' => now(),
		    'password' => Hash::make('secret'),
		    'created_at' => now(),
		    'updated_at' => now()
	    ]);
	    
	    DB::table('users')->insert([
		    'role_id' => '3',
		    'name' => 'Warehouse',
		    'email' => 'user@mail.com',
		    'email_verified_at' => now(),
		    'password' => Hash::make('secret'),
		    'created_at' => now(),
		    'updated_at' => now()
	    ]);
    }
}
