<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\User;
use App\Repositories\StudentRepository;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, StudentRepository $studentRepository)
    {
        if ($request->wantsJson()) {
            return $studentRepository->getDataTableData($request);
        }

        return view('students.index', ['page_slug' => 'student']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request, StudentRepository $studentRepository)
    {
        $studentRepository->insertData($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $student
     * @return \Illuminate\Http\Response
     */
    public function show(User $student)
    {
        //for eger loading
        $student->courses;
        $data['student'] = $student;
        $data['page_slug'] = 'student';
        return view('students.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $student
     * @return \Illuminate\Http\Response
     */
    public function edit(User $student)
    {
        return view('students.form', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, StudentRepository $studentRepository , User $student)
    {
        $studentRepository->updateData($request, $student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $student)
    {
        $student->delete();
    }
}
