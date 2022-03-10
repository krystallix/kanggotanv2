@extends('layout.dashboard')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
   <div class="text-center">
    <i class="fa-solid fa-lock fs-1"></i>
    <h4 class="py-2">This page can only be accessed by users with role Secretary</h4>
   </div>
</div>
@endsection
@section('single-page-js')
@endsection