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
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h2>Student List</h2>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#studentModal">Add +</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="studentDataTable" class="table table-striped" style="width:100%;">
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
@endsection
@push('modal')
    <div class="modal" id="studentModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Student</h5>
                    <button type="button" class="btn-close btn-remove" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="studentAddForm">
                    @include('students.form')
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-remove" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="addBtn">Save</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal" id="studentEditModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Student</h5>
                    <button type="button" class="btn-close btn-remove" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="studentEditForm">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-remove" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-info" id="editBtn">Update</button>
                </div>
            </div>
        </div>
    </div>
@endpush
@push('script')
<script src="{{ asset('js/custom/students.js') }}"></script>
@endpush