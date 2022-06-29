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
                            <h3 class="mb-4">Account Settings</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" value="Kiran">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" value="Acharya">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" value="kiranacharya287@gmail.com">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone number</label>
                                        <input type="text" class="form-control" value="+91 9876543215">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Company</label>
                                        <input type="text" class="form-control" value="Kiran Workspace">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Designation</label>
                                        <input type="text" class="form-control" value="UI Developer">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Bio</label>
                                        <textarea class="form-control"
                                            rows="4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore vero enim error similique quia numquam ullam corporis officia odio repellendus aperiam consequatur laudantium porro voluptatibus, itaque laboriosam veritatis voluptatum distinctio!</textarea>
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