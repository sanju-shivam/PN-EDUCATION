<?php

namespace App\Imports;


use App\School\Teacher;
use App\User;
use App\CommonModels\Role;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;


class TeacherImport implements ToCollection, WithUpserts, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function headingRow(): int
    {
        return 1;
    }


    public function uniqueBy()
    {
        return 'email';
    }

    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.email' => 'required|email',
            '*.name' => 'required|max:255',
            '*.phone_no'   =>'required',
            '*.password'   =>'required|min:8',
            '*.id_proof'   =>'required',
        ])->validate();
        foreach ($rows as $request) 
        {
            $teacher = Teacher::create([
                'name'         =>$request['name'],
                'phone_no'     =>$request['phone_no'],
                'address'      =>$request['address'],
                'city'         =>$request['city'],
                'state'        =>$request['state'],
                'pincode'      =>$request['pincode'],
                'email'        =>$request['email'],
                'id_proof'     =>$request['id_proof'],
                'password'     =>bcrypt($request['password']),
                'institute_id' =>Auth::user()->user_type_id,
                'image'        => "default_teacher.png",
            ]);

            User::create([
                'name'         =>$request['name'],
                'email'        =>$request['email'],
                'password'     =>bcrypt($request['password']),
                'role_id'      =>Role::where('name','Teacher')->first()->id,
                'user_type_id' =>$teacher->id,
            ]);
        }
    }
}
