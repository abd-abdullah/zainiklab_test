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
                                    <h2>Course Details</h2>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-4 mx-auto">
                                            <div class="card my-3">
                                                <div class="card-thumbnail">
                                                    <img src="{{ asset($course->thumbnail) }}" class="img-fluid w-100" alt="{{ $course->thumbnail }}">
                                                </div>
                                                <div class="card-body p-0">
                                                    <table class="mb-0 table table-bordered table-sm">
                                                        <tr>
                                                            <td>Name</td>
                                                            <td>{{ $course->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>code</td>
                                                            <td>{{ $course->code }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Price</td>
                                                            <td>{{ $course->price }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h2>Enrolled Student List</h2>
                                        <table id="studentDataTable" class="table table-striped" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <td>SL#</td>
                                                    <td>First Name</td>
                                                    <td>Last Name</td>
                                                    <td>Registration Number</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($course->students as $index => $student)
                                                <tr>
                                                    <td>{{ ($index+1) }}</td>
                                                    <td>{{ $student->first_name }}</td>
                                                    <td>{{ $student->last_name }}</td>
                                                    <td>{{ $student->registration_no }}</td>
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
@push('script')
<script>
    $(document).ready(function () {
        var studentDataTable = $('#studentDataTable').DataTable()
    });
</script>
@endpush