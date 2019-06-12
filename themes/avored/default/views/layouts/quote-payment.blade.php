@extends('layouts.app_new')

@section('meta_title','Quote Payment')
@section('meta_description','Quote Payment')
@section('breadcrumbs')
<div class="breadcrumb-block">
   <div class="container">
       <nav aria-label="breadcrumb">
      
       </nav>
   </div>
</div>
@endsection
@section('content')
@include('user.my-account.sidebar')
@yield('quotePayment-content')
@endsection
