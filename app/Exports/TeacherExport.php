<?php

namespace App\Exports;

use App\School\Teacher;
use Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class TeacherExport implements FromCollection , ShouldAutoSize, WithHeadings, WithColumnFormatting
{
	use SkipsErrors;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
        	'Name',
	    	'Phone No',
	    	'Address',
	    	'city',
	    	'state',
	    	'Pincode',
	    	'Email',
	    	'ID Proof',
    	];
    }

     public function columnFormats(): array
    {
        return [
            'H' => NumberFormat::FORMAT_NUMBER,
        ];
    }

    public function collection()
    {
    	$teachers = 	Teacher::select('name','phone_no','address', 'city', 'state','pincode','email','id_proof')->where('institute_id', '=', Auth::user()->user_type_id)->get();
    	// foreach ($teachers as $teacher) {
    	// 	,$teacher->id_proof
    	// }
        return $teachers;
    }
}
