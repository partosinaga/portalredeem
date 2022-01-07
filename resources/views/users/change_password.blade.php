@extends('layouts/main')
@section('title', 'Change Password')
@section('contentTitle', 'Change Password')
@section('content')

    <!--begin::Container-->
    <div class="container">
        @if ($message = Session::get('message'))
            <div class="alert alert-{{ Session::get('type') }} alert-dismissible fade show" role="alert">
                <div class="alert-text">{{ $message }}</div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        <!--begin::Row-->
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">Create New Passowrd</h3>
                    </div>
                    <!--begin::Form-->
                    <form method="POST" action="{{ route('change.password.store') }}">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label>Old Password</label>
                                <input type="password" class="form-control" name="old" autocomplete="old" required>
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" class="form-control" name="new" autocomplete="new" required>
                            </div>
                            <div class="form-group">
                                <label>Re-type New Password</label>
                                <input type="password" class="form-control" name="new_conf" autocomplete="new_conf" required>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success mr-2">Change</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                    <!--end::Form-->
                   </div>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->


@endsection