@extends('layouts.main')
@section('content')
    <div class="text-start">
        <a role="button" class="btn" href="{{ route('home.index') }}"><i class="fa fa-arrow-left text-warning"
                aria-hidden="true"></i></a>
    </div>
    <div class="row">
        <div class="col-8">
            <img src="/images/{{ $food->img }}" alt="" style="width: 80%">
        </div>
        <div class="col-4">
            <h2>{{ $food->name }}</h2>
            <h4 class="text-danger">{{ number_format($food->price) }}Đ</h4>
            <div class="row">
                <b>Description: </b> <span>{{ $food->description }}</span> 
            </div>
            <div class="row">
              <div class="col-3">
                <b>Ingredients: </b>
              </div>
              <div class="col-6">
                <ul>
                  @php
                    $ingredientArr = explode(",", $food->ingredients)   
                  @endphp
                  @foreach ($ingredientArr as $ingredient)
                      <li>{{$ingredient}}</li>
                  @endforeach
                </ul>
              </div>
            </div>
        </div>
    </div>
@endsection
