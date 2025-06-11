@extends('layouts.Review.main')

@section('content')
{{-- <div class="container mb-3 mt-3">
    <h2>Создание предзаказа</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('preorders.store') }}">
        @csrf

        <h5>Выберите товары для предзаказа:</h5>

        <div class="row mb-3">
            <label><strong>Избранные товары:</strong></label><br>
            @foreach($favorites as $product)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h6 class="card-title">{{ $product->name }}</h6>
                            <p class="card-text">{{ Str::limit($product->description, 50) }}</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="favorites[]" value="{{ $product->id }}" id="favorite-{{ $product->id }}">
                                <label class="form-check-label" for="favorite-{{ $product->id }}">Выбрать</label>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mb-3">
            <label><strong>Мои конфигурации:</strong></label><br>
            @foreach($configs as $config)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="configs[]" value="{{ $config->id }}">
                    <label class="form-check-label">{{ $config->name }}</label>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание заказа</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Отправить заявку</button>
    </form>
</div> --}}
<div class="container mt-4 mb-5">
    <h2 class="mb-4">Подтверждение пред-заказа</h2>
    
    <form method="POST" action="{{ route('preorders.store') }}">
        @csrf
        
        <h4 class="mt-4">Выбранные товары:</h4>
        <ul class="list-group mb-4">
            @foreach($items as $item)
                <li class="list-group-item">
                    @if($item instanceof \App\Models\Products)
                        {{ $item->name }} (Товар)
                        <input type="hidden" name="selected_items[]" value="product_{{ $item->id }}">
                    @else
                        {{ $item->name }} (Конфигурация)
                        <input type="hidden" name="selected_items[]" value="config_{{ $item->id }}">
                    @endif
                </li>
            @endforeach
        </ul>
        
        <div class="mb-4">
            <label for="description" class="form-label">Комментарий к пред-заказу</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>
        
        <div class="d-flex justify-content-between">
            <a href="/favorites" class="btn btn-outline-danger">Назад</a>
            <button type="submit" class="btn btn-success">Подтвердитьы пред-заказ</button>
        </div>
    </form>
</div>
@endsection
@extends('layouts.Review.main')

@section('content')

@endsection
