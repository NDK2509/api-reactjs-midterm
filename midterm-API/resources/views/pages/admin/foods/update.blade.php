@extends('layouts.main')
@section('content')
<div class="text-start">
    <a role="button" class="btn" href="{{route('foods.index')}}"><i class="fa fa-arrow-left text-warning" aria-hidden="true"></i></a>
</div>
<h1 class="text-center">UPDATE FORM</h1>
@include('pages.admin.foods.form')
@endsection
