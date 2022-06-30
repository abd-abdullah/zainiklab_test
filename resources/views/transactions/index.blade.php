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
                                    <h2>Transaction List</h2>
                                </div>
                                <div class="card-body">
                                    <table id="transactionDataTable" class="table table-striped" style="width:100%;">
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
@push('script')
<script src="{{ asset('js/custom/transactions.js') }}"></script>
@endpush