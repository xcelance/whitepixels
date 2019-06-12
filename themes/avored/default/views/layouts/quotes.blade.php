@extends('layouts.app_new')

@section('meta_title','My Quotes')
@section('meta_description','My Quotes')
@section('breadcrumbs')
<div class="breadcrumb-block">
   <div class="container">
       <nav aria-label="breadcrumb">
          {{ Breadcrumbs::render('my-quote') }}
       </nav>
   </div>
</div>
@endsection
@section('content')
@include('user.my-account.sidebar')
@yield('quote-content')
@endsection
