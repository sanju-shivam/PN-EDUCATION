<?php

use App\Timetable;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TimetableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i =0 ;$i<10000; $i++){
        	if($i< 2000){
	        	Timetable::create([
	        		'class_id'	=>	1,
			        'day_id' =>	1,
			        'teacher_id' =>	2,
			        'subject_id' =>	1,
			        'section_id' =>	1,
			        'created_at'    =>  Carbon::now(),
                        'updated_at'    =>  Carbon::now(),
	        	]);
        	}elseif($i> 2000 and $i <=5000){
        		Timetable::create([
	        		'class_id'	=>	2,
			        'day_id' =>	2,
			        'teacher_id' =>	1,
			        'subject_id' =>	1,
			        'section_id' =>	2,
			        'created_at'    =>  Carbon::now(),
                        'updated_at'    =>  Carbon::now(),
	        	]);
        	}
        	elseif($i > 5000){
        		Timetable::create([
	        		'class_id'	=>	3,
			        'day_id' =>	3,
			        'teacher_id' =>	3,
			        'subject_id' =>	1,
			        'section_id' =>	2,
			        'created_at'    =>  Carbon::now(),
                        'updated_at'    =>  Carbon::now(),
	        	]);
        	}
        }
    }
}
