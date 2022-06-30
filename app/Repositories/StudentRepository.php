<?php

namespace App\Repositories;

use App\Models\User;
use App\Utilities\FileUploader;

class StudentRepository
{
    public function getDataTableData($request){
        $students = new User();
        $limit = 10;
        $offset = 0;
        $search = [];
        $where = [];
        $with = [];
        $orderBy = ['order' => 'ASC'];

        if ($request->input('length')) {
            $limit = $request->input('length');
        }

        if ($request->input('order')[0]['column'] != 0) {
            $column_name = $request->input('columns')[$request->input('order')[0]['column']]['name'];
            $sort = $request->input('order')[0]['dir'];
            $orderBy[$column_name] = $sort;
        }

        if ($request->input('start')) {
            $offset = $request->input('start');
        }

        if ($request->input('search') && $request->input('search')['value'] != "") {
            $search['first_name'] = $request->input('search')['value'];
            $search['last_name'] = $request->input('search')['value'];
            $search['registration_no'] = $request->input('search')['value'];
        }

        if ($request->input('where')) {
            $where = $request->input('where');
        }

        $where['users.user_type and'] = 'student';
        $where['users.status and'] = 1;

        $students = $students->getDataForDataTable($limit, $offset, $search, $where, $with);
        return response()->json($students);
    }

	public function insertData($request){
        $photo = FileUploader::upload('photo', 'uploads/students');
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'photo' => $photo,
            'password' => bcrypt(($request->password != NULL && $request->password != '') ? $request->password : $request->email),
            'registration_no' => $request->registration_no,
        ];

        return User::create($data);
    }
	
    public function updateData($request, $student){
        $photo = FileUploader::upload('photo', 'uploads/students');
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'photo' => ($photo) ? $photo : $student->photo,
            'password' => bcrypt(($request->password != NULL && $request->password != '') ? $request->password : $request->email),
            'registration_no' => $request->registration_no,
        ];

        return $student->update($data);
    }
}
