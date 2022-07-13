@extends("layouts.main")

@section("content")
<h1 class="text-center">Food Table</h1>
<div class="text-end">
    <a role="button" href="{{route('foods.create')}}" class="btn btn-primary">Create</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Image</th>
            <th scope="col">Price</th>
            <th scope="col">Category</th>
            <th scope="col">Description</th>
            <th scope="col">Ingredients</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(empty($foodList))
        <tr>
            <td colspan="8">
                No data is available!
            </td>
        </tr>
        @else
        @foreach($foodList as $food)
        <tr>
            <th scope="row">{{$food->id}}</th>
            <td>{{$food->name}}</td>
            <td><img src="/images/{{$food->img}}" alt="" style="width: 5rem;"></td>
            <td>{{$food->price}}</td>
            <td>{{$food->category->name}}</td>
            <td>{{$food->description}}</td>
            <td>{{$food->description}}</td>
            <td>
                <form action="{{route('foods.destroy', $food->id)}}" method="post">
                    @csrf
                    @method("delete")
                    <button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </form>
                <a role="button" href="{{route('foods.edit', $food->id)}}" class="btn btn-warning mt-3"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
@endsection
