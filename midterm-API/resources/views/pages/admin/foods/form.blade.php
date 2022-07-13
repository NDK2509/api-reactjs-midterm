<form action="{{ !isset($food) ? route('foods.store') : route('foods.update', $food->id) }}" method="post"
    enctype="multipart/form-data">
    @csrf
    @if (isset($food))
        @method('put')
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    Name:
    <input type="text" class="form-control mb-3" name="name" value="{{ isset($food) ? $food->name : '' }}"
        placeholder="Enter food's name...">

    <select name="cateId" class="form-select mb-3">
        @foreach ($categories as $cate)
            <option value="{{ $cate->id }}">{{ $cate->name }}</option>
        @endforeach
    </select>

    Price:
    <input type="text" class="form-control" name="price" value="{{ isset($food) ? $food->price : '' }}"
        placeholder="Enter food's price...">
    Description:
    <input type="text" class="form-control" name="description" value="{{ isset($food) ? $food->description : '' }}"
        placeholder="Enter food's description...">
    Ingredients:
    <input type="text" class="form-control" name="ingredients" value="{{ isset($food) ? $food->ingredients : '' }}"
        placeholder="Enter food's ingredients...">
    @if (isset($food))
        <img class="mt-3" src="/images/{{ $food->img }}" alt="" style="width: 5rem"><br />
    @endif
    <input type="file" class="form-control-file mt-3" name="img" onchange="changeImage(event)"><br />
    <img src="{{ isset($food) ? '/images/' . $food->img : '' }}" class="col-6" id="preview-img" style="width: 10rem"
        alt=""> <br>
    <script>
        const changeImage = (e) => {
            const img = e.target.files[0]
            const preImg = document.getElementById("preview-img")
            preImg.src = URL.createObjectURL(img)
            preImg.onload = () => {
                URL.revokeObjectURL(preImg.src)
            }
        }
    </script>
    <button class="btn btn-primary mt-3" type="submit">Save</button>
</form>
