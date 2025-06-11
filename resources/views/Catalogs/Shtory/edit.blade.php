@extends('layouts.Review.main')
@section('content')
    <div class="container">
        <form action="{{route('shtory.update',$product)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Введите новое название товара</label>
                <input type="text" class="form-control" id="name" name="name"
                       placeholder="Название товара" value="{{$product->name}}" required></input>
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Введите новый материал товара</label>
                <input type="text" class="form-control" id="material" name="material"
                       placeholder="Материал товара" value="{{$product->material}}" required></input>
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Вставте новую картинку</label>
                <input type="file" class="form-control" id="image" name="image"
                       placeholder="Картинка товара" value="{{$product->image}}"></input>
            </div>
            @error('image')
            <p class="alert-danger">Gbplt</p>
            @enderror
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Введите новую цену товара</label>
                <input type="number" class="form-control" id="price" name="price"
                       placeholder="Цена товара" value="{{$product->price}}" required></input>
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Выберите нового поставщика</label>
                <select class="form-select" id="supplier_id" aria-label="Default select example" name="supplier_id">
                    @foreach($suppliers as $supplier)
                        <option
                            {{$supplier->id == $product->supplier->id ? ' selected': ''}}
                            value="{{$supplier->id}}">{{$supplier->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <button type="submit">Подтвердить</button>
            </div>
        </form>
    </div>

@endsection
