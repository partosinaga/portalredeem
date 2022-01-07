{{-- HANYA CONTOH --}}
{{-- ini di copy kalau mau bikin page baru --}}
@extends('layouts/main')
@section('title', 'Campaign')
@section('contentTitle', 'All Campaign')
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
                
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->


@endsection