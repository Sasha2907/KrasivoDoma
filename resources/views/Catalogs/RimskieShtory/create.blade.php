@extends('layouts.review.main')
@section('content')
    <div class="container mt-3">
        <form action="{{route('rimskieShtory.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Введите название товара</label>
                <input type="text" class="form-control" id="name" name="name"
                          placeholder="Название товара" value="{{old('name')}}" required></input>
            </div>
            @error('name')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Введите материал товара</label>
                <input type="text" class="form-control" id="material" name="material"
                          placeholder="Материал товара" value="{{old('material')}}" required></input>
            </div>
            @error('material')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Вставте картинку</label>
                <input type="file" class="form-control" id="image" name="image"
                          placeholder="Картинка товара" value="{{old('image')}}" required></input>
            </div>
            @error('image')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Введите цену товара</label>
                <input type="number" class="form-control" id="price" name="price"
                       placeholder="Цена товара" value="{{old('price')}}" required></input>
            </div>
            @error('price')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Выберите поставщика</label>
                <select class="form-select" id="supplier_id" aria-label="Default select example" name="supplier_id">
                    @foreach($suppliers as $supplier)
                        <option
                            {{old('supplier_id') == $supplier->id ? ' selected': ''}}
                            value="{{$supplier->id}}">{{$supplier->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <button type="submit">Создать</button>
            </div>
        </form>
    </div>


@endsection
