<?php

use App\Deficiency;
use App\Staff;
use App\Student;
use Illuminate\Database\Seeder;

class DeficiencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        function makeDeficiency($student_number, $title, $note, $staff_id){
        	$def = new Deficiency;
        	$def->student_id = Student::whereStudentNumber($student_number)->first()->id;
        	$def->title = $title;
        	$def->note = $note;
        	$def->staff_id = $staff_id;
        	$def->department_id = Staff::find($staff_id)->department_id;
        	$def->save();
        }

        $melbs = 200824143;
        makeDeficiency($melbs, 'Broken testubes', 'hala lagot kaaaaa' , 1);
        makeDeficiency($melbs, 'Lorem ipsum', 'boobies :)' , 2);
        makeDeficiency($melbs, 'sit_dd', 'hala lagot kaaaaa' , 1);
        makeDeficiency($melbs, 'bleep', 'bloop', 3);
        makeDeficiency($melbs, 'borp', 'gorp', 6);
        makeDeficiency($melbs, 'Broken testubes', 'hala lagot kaaaaa' , 1);
        makeDeficiency($melbs, 'Lorem ipsum', 'boobies :)' , 2);
        makeDeficiency($melbs, 'sit_dd', 'hala lagot kaaaaa' , 1);
        makeDeficiency($melbs, 'bleep', 'bloop', 3);
        makeDeficiency($melbs, 'borp', 'gorp', 6);
    }
}
