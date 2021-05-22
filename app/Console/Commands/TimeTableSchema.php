<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Artisan;
use Str;


class TimeTableSchema extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:timetable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = Auth::user()->id.'-'.Str::slug(Auth::user()->name);
        
        Artisan::call("make:migration:schema create_".$name."_table --schema='class_id:bigInteger,day_id:integer,teacher_id:bigInteger,subject_id:bigInteger,section_id:integer:nullable,institute_id:bigInteger'");
    }
}
