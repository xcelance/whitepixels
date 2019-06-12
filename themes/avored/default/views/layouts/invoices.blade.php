@extends('layouts.app_new')

@section('meta_title','My Account E commerce')
@section('meta_description','My Account E commerce')
@section('breadcrumbs')
<div class="breadcrumb-block">
   <div class="container">
       <nav aria-label="breadcrumb">
       {{ Breadcrumbs::render('my-invoice') }}
       </nav>
   </div>
</div>
@endsection
@section('content')
@include('user.my-account.sidebar')
@yield('invoice-content')
@endsection
