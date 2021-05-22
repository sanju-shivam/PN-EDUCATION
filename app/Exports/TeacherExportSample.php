<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\FromCollection;

use App\School\Teacher;

class TeacherExportSample implements  WithHeadings
{
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
		    	'Passowrd'
	    	];
	    }

    // public function collection()
    // {
    	//FromCollection,
    // 	// ,'sample Phone No','Sample Address','Sample City','Sample State','Sample Pincode', 'Sample Email', 'Sample ID Proof', 'Sample Passowrd'
    // 	return ('Sample Name');
    // }
}
