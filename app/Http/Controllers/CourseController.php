<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\User;
use App\Repositories\CourseRepository;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CourseRepository $courseRepository)
    {
        if ($request->wantsJson()) {
            return $courseRepository->getDataTableData($request);
        }

        $students = User::where('user_type', 'student')->get();
        return view('courses.index', ['page_slug' => 'course', 'students' => $students]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request, CourseRepository $courseRepository)
    {
        $courseRepository->insertData($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //for eger loading
        $course->students;
        $data['course'] = $course;
        $data['page_slug'] = 'course';
        return view('courses.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('courses.form', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, CourseRepository $courseRepository, Course $course)
    {
        $courseRepository->updateData($request, $course);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
    }
   
    /**
     * assign student.
     *
     * @param  \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function assignStudent(CourseRequest $request, CourseRepository $courseRepository, Course $course)
    {
        $courseRepository->assignStudent($request, $course);
    }
}
