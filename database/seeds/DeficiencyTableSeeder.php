<?php

use App\Deficiency;
use App\Staff;
use App\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

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
            $startDate = Carbon::now();
            $endDate = Carbon::now()->subYears(2);

        	$def = new Deficiency;
        	$def->student_id = Student::whereStudentNumber($student_number)->first()->id;
        	$def->title = $title;
        	$def->note = $note;
        	$def->staff_id = $staff_id;
        	$def->department_id = Staff::find($staff_id)->department_id;
            $def->created_at = Carbon::createFromTimeStamp(rand($endDate->timestamp, $startDate->timestamp));
        	$def->save();
        }

        $melbs = 200824143;
        for($i=0;$i<15;$i++)
            makeDeficiency($melbs, str_random(15), str_random(10), rand(1,6));
    }
}
