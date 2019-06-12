@extends('layouts.app_new')

@section('meta_title','Quote Detail')
@section('meta_description','Quote Detail')
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
@yield('quote-content')
@endsection
