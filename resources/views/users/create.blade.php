@extends('layouts/main')
@php
    $headerTitle = @$user ? 'Edit User' : 'Create New User';
    $disabled = '';
    $checked = '';
    if (Auth::user()->account_type == 'client') {
        $disabled = 'disabled';
        $checked = 'checked';
    }
@endphp
@section('title', 'User')
@section('contentTitle', $headerTitle)
@section('content')

    <!--begin::Container-->
    <div class="container">
        <!--begin::Row-->
        <div class="row">
            <div class="col-xl-12">
                
                <div class="card card-custom">
                    <div class="card-header flex-wrap py-3">
                        <div class="card-title">
                            <h3 class="card-label">User Profile <br> <small class="text-muted">Create a brand new user and add them to this site. <br>All field must be filled out.</small></h3>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('users.index') }}" class="btn btn-light font-weight-bold mr-2">Cancel</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="row justify-content-center py-10 px-8 py-lg-12 px-lg-10">
                            <div class="col-xl-12">
                                @php
                                    $route = @$user ? route('users.update', $user->id) : route('users.store');
                                @endphp
                                <form class="form" id="kt_form" method="POST" action="{{ $route }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Salutation</label>
                                                <div class="radio-inline">
                                                    <label class="radio">
                                                        <input type="radio" name="salutation" value="mr" {{ @$user->salutation == 'mr' ? 'checked' : '' }} >
                                                        <span></span>Mr.
                                                    </label>
                                                    <label class="radio">
                                                        <input type="radio" name="salutation" value="ms" {{ @$user->salutation == 'ms' ? 'checked' : '' }} >
                                                        <span></span>Ms.
                                                    </label>
                                                    <label class="radio">
                                                        <input type="radio" name="salutation" value="mrs" {{ @$user->salutation == 'mrs' ? 'checked' : '' }} >
                                                        <span></span>Mrs.
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" class="form-control" name="full_name" value="{{ @$user->name }}" />
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>User Type</label>
                                                <div class="radio-inline">
                                                    <label class="radio">
                                                        <input type="radio" name="user_type" value="client" {{ @$user->account_type == 'client' ? 'checked' : '' }} {{ $checked }} >
                                                        <span></span>Client User
                                                    </label>
                                                    <label class="radio">
                                                        <input type="radio" name="user_type" value="prezent" {{ @$user->account_type == 'prezent' ? 'checked' : '' }} {{ $disabled }}>
                                                        <span></span>Prezent
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label for="exampleSelect1">Client</label>
                                                <select class="form-control" id="client" name="client_id" >
                                                    <option selected disabled>select</option>
                                                    @foreach ($client as $item)
                                                        @php
                                                            $selected = '';
                                                            if(@$user->client_id == $item->client_id)
                                                            {
                                                                    $selected = 'selected';
                                                            }
                                                        @endphp
                                                        <option value="{{ $item->client_id }}" {{ $selected }}> {{ $item->client_title }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                       
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="exampleSelect1">Role</label>
                                                <select class="form-control" id="role" name="role_id">
                                                    <option selected disabled>select</option>
                                                    @foreach ($roles as $item)
                                                    @php
                                                    $selected = '';
                                                    if(@$user->roles_id == $item->roles_id)
                                                    {
                                                         $selected = 'selected';
                                                    }
                                                @endphp
                                                    <option value="{{ $item->roles_id }}" {{ $selected }}> {{ $item->roles_title }} </option>
                                               @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email" value="{{ @$user->email }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="number" class="form-control" name="phone" value="{{ @$user->phone }}" />
                                            </div>
                                        </div>

                                    </div>
                                    @php
                                        $logo = @$user->user_image ? asset("assets/images/users/$user->user_image") : asset('assets/media/logos/logo-letter-9.png')
                                    @endphp
                                    <div class="form-group row">
                                        <label class="col-lg-12 col-form-label">Profile Picture</label>
                                        <div class="col-lg-12">
                                            <div class="image-input image-input-outline" id="profile_pict">
                                                <div class="image-input-wrapper" style="background-image: url({{ $logo }})"></div>
                                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Logo">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="profile_pict" accept=".png, .jpg, .jpeg" />
                                                    <input type="hidden" name="profile_pict_remove" />
                                                </label>
                                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel Logo">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                                            </div>
                                            <span class="form-text text-muted">Allowed file types: png, jpg, jpeg. (min 50 x 50 px)</span>
                                        </div>
                                    </div>
                                    
                                     <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                        <div>
                                            <button type="submit" class="btn btn-success font-weight-bolder text-uppercase px-9 py-4">Save</button>
                                        </div>
                                    </div>


                                </form>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->


@endsection
@push('footer_scripts')
<script>
    $(document).ready( function () {
        $('#client').select2();
        $('#role').select2();
        new KTImageInput('profile_pict');

    })
</script>
@endpush