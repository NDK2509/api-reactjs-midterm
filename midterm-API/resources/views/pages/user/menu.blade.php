<section class="menu my-5 row">
    @foreach ($cateList as $cate)
        <h3 class="text-center mb-5">
            Category: {{ $cate->name }}
        </h3>
        @php
            $foodListByCate = array_filter($foodList, fn($food) => $food['cateId'] == $cate->id);
        @endphp
        @foreach ($foodListByCate as $food)
            <div class="card me-3 mb-3" style="width: 18rem;">
                <img src="/images/{{$food['img']}}" class="card-img-top" alt="">
                <div class="card-body">
                    <h4 class="card-title">{{$food['name']}}</h4>
                    <h4 class="text-danger">{{number_format($food['price'])}}Đ</h4>
                    <p class="card-text">{{$food['description']}}</p>
                    <a href="{{route("home.detail", $food['id'])}}" class="btn btn-primary">See detail</a>
                </div>
            </div>
        @endforeach
    @endforeach
</section>
