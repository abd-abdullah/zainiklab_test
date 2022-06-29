@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container">
            <h1 class="mb-5">{{ (auth()->user()->user_type == 'student' ? 'Student' : 'Admin') . ' Dashboard' }}</h1>
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
                            <div class="card border-0">
                                <div class="card-body">
                                    <h2 class="mb-4">Dashboard</h2>
                                    <div class="row">
                                        @if(auth()->user()->user_type == 'admin')
                                        <div class="col-xl-6 mb-4">
                                            <div
                                                class="border-0 border-5 border-primary border-start card h-100 py-2 shadow">
                                                <div class="card-body">
                                                    <div class="d-flex no-gutters align-items-center">
                                                        <div class="mr-2 w-100">
                                                            <div
                                                                class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                                Total Students</div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{
                                                                $totalStudent }}</div>
                                                        </div>
                                                        <div class="text-end text-primary w-auto">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-25"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                                stroke-width="2">
                                                                <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                                                <path
                                                                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 mb-4">
                                            <div
                                                class="border-0 border-5 border-info border-start card h-100 py-2 shadow">
                                                <div class="card-body">
                                                    <div class="d-flex no-gutters align-items-center">
                                                        <div class="mr-2 w-100">
                                                            <div
                                                                class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                                Total Course</div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{
                                                                $totalCourse }}
                                                            </div>
                                                        </div>
                                                        <div class="text-end text-info w-auto">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-25"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                                stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-xl-6 mb-4">
                                            <div
                                                class="border-0 border-5 border-info border-start card h-100 py-2 shadow">
                                                <div class="card-body">
                                                    <div class="d-flex no-gutters align-items-center">
                                                        <div class="mr-2 w-100">
                                                            <div
                                                                class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                                Total Enrolled Course</div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{
                                                                $totalEnrolledCourse }}
                                                            </div>
                                                        </div>
                                                        <div class="text-end text-info w-auto">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-25"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                                stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
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
</div>
@endsection