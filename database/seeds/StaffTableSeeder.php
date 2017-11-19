<?php

use App\Department;
use App\Role;
use App\Staff;
use App\User;
use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
    	function makeStaff($name, $email, $department, $role='staff')
	    {
	    	$user = User::create([
	    		'name' => $name,
	    		'email' => $email,
	    		'password' => bcrypt('secret'),
	    	]);
            $user->roles()->attach(Role::whereName($role)->first()->id);
	    	$staff = new Staff();
	    	$staff->user_id = $user->id;
	    	$staff->department_id = Department::whereShortName($department)
	    		->first()->id;
	    	$staff->save();
	    }
     
     	
     	makeStaff('Eden Huelgas','eden@email.com','dpsm');
    	makeStaff('Rina Tolentino','rina@email.com','db');
    	makeStaff('Dong Calmada','dong@email.com','cngrad');
    	makeStaff('Gilbert Aquino','gilbert@email.com','dmb');
        makeStaff('John Doe','jdoe@email.com','dd');
        makeStaff('Max Caulfield','mcaulfield@email.com','dpsm');
        makeStaff('Super Admin', 'admin@admin.com', 'dpsm', 'admin');
    }
 
}
