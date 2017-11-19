<?php

use App\Program;
use App\Role;
use App\Student;
use App\User;
use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	function makeStudent($name, $email, $student_number, $program)
        {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt('secret'),
            ]);
            $user->roles()->attach(Role::whereName('student')->first()->id);
            $student = new Student();
            $student->student_number = $student_number;
            $student->user_id = $user->id;
            $student->program_id = Program::whereShortName($program)
                ->first()->id;
            $student->save();
        }

        makeStudent('Melvin San Jose', 'melbs@gmail.com', 200824143, 'bscs');
        makeStudent('Mario De Mesa', 'mario@email.com', 200912345, 'bsbc');
        makeStudent('Xeus Foja', 'xdfoja@yahoomail.com', 201011132, 'baps');
        makeStudent('Beverly Festejo','bevfes@boobies', 200812151, 'bscs');
        makeStudent('Arianne May Balaoing', 'limeclouds@twitter', 200913222, 'bsph');
        makeStudent('Guillan May Tibule', 'nakakagiguil@twitter', 200909993, 'baoc');
        makeStudent('Some Student', 'somestudent@email.com', 201003293, 'baps');
        makeStudent('Ian Viena', 'ifviena@ims', 200800250, 'bscs');
        makeStudent('Kathlyn Valdez', 'kvaldez@up', 201013099, 'bsn');
        makeStudent('Edriann Hao', 'hao@up', 201113099, 'dd');
        makeStudent('Milany Anne Luay','mluay@up.edu.ph', 201220201, 'bsip');
    }
}
