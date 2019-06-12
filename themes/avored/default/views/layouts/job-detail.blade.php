@extends('layouts.app_new')

@section('meta_title','Job Detail')
@section('meta_description','Job Detail')
@section('breadcrumbs')
<div class="breadcrumb-block">
   <div class="container">
       <nav aria-label="breadcrumb">
           {{ Breadcrumbs::render('my-jobs') }}
       </nav>
   </div>
</div>
@endsection
@section('content')
@include('user.my-account.sidebar')
@yield('job-content')
@endsection
