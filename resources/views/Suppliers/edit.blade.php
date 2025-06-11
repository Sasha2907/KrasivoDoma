@extends('layouts.Review.main')
@section('content')
    <div class="container">
        <form action="{{route('supplier.update',$supplier->id)}}" method="post">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Введите имя нового поставщика</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$supplier->name}}">

                </input>
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Введите страну нового поставщика</label>
                <input type="text" class="form-control" id="country" name="country" value="{{$supplier->country}}"
                ></input>
            </div>
            <div class="mb-3">
                <button type="submit">Подтвердить</button>
            </div>
        </form>
    </div>
@endsection
