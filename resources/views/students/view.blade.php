@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container">
            @if (session('status'))
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                </div>
            </div>
            @endif
            <div class="border-0 card shadow">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="sidebar h-100 border-end pb-4">
                                @include('layouts.sidebar')
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="card border-0 py-2">
                                <div class="bg-white card-header">
                                    <h2>Student Details</h2>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-4 mx-auto">
                                            <div class="card my-3">
                                                <div class="card-thumbnail">
                                                    <img src="{{ asset($student->profile_photo) }}" class="img-fluid w-100" alt="{{ $student->profile_photo }}">
                                                </div>
                                                <div class="card-body p-0">
                                                    <table class="mb-0 table table-bordered table-sm">
                                                        <tr>
                                                            <td>Name</td>
                                                            <td>{{ $student->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <td>{{ $student->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Registration No</td>
                                                            <td>{{ $student->registration_no }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h2>Enrolled Course List</h2>
                                        <table class="table table-striped" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <td>SL#</td>
                                                    <td>Name</td>
                                                    <td>Code</td>
                                                    <td>Price</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($student->courses as $index => $course)
                                                <tr>
                                                    <td>{{ ($index+1) }}</td>
                                                    <td>{{ $course->name }}</td>
                                                    <td>{{ $course->code }}</td>
                                                    <td>{{ $course->price }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection