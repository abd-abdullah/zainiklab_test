<?php

namespace App\Repositories;

use App\Models\Course;
use App\Utilities\FileUploader;

class CourseRepository
{
    public function getDataTableData($request)
    {
        $courses = new Course();
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
            $search['name'] = $request->input('search')['value'];
            $search['code'] = $request->input('search')['value'];
        }

        if ($request->input('where')) {
            $where = $request->input('where');
        }

        $where['courses.status and'] = 1;

        $courses = $courses->getDataForDataTable($limit, $offset, $search, $where, $with);
        return response()->json($courses);
    }

    public function insertData($request)
    {
        $thumbnail = FileUploader::upload('thumbnail', 'uploads/courses');
        $data = [
            'name' => $request->name,
            'code' => $request->code,
            'price' => $request->price,
            'thumbnail' => $thumbnail,
        ];

        return Course::create($data);
    }

    public function updateData($request, $course)
    {
        $thumbnail = FileUploader::upload('thumbnail', 'uploads/courses');
        $data = [
            'name' => $request->name,
            'code' => $request->code,
            'price' => $request->price,
            'thumbnail' => ($thumbnail) ? $thumbnail : $course->thumbnail,
        ];

        return $course->update($data);
    }

    public function assignStudent($request, $course)
    {
        $course->students()->syncWithoutDetaching($request->student_id);
    }
}
