@extends('layouts.Review.main')
@section('content')
    <div class="container mt-5 mb-5">
        <!-- Фон для карточки продукта -->
        <div class="p-4 rounded shadow-lg" style="background: #f8f9fa;">
            <div class="row align-items-center">
                <!-- Левая часть: Фото -->
                <div class="col-md-6 text-center">
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded shadow-lg" alt="{{ $product->name }}">
                </div>

                <!-- Правая часть: Информация -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-lg p-4 bg-white">
                        <h2 class="fw-bold text-primary">{{ $product->name }}</h2>
                        <hr>
                        <p class="fs-5"><strong>Материал:</strong> {{ $product->material }}</p>
                        <p class="fs-5"><strong>Поставщик:</strong> {{ $supplier->name }}</p>
                        <p class="fs-5"><strong>Страна поставщика:</strong> {{ $supplier->country }}</p>

                        <!-- Кнопки управления -->
                        <div class="mt-4 d-flex gap-2">
                            <a href="{{ route('decorPodushki.index') }}" class="btn btn-outline-danger">
                                <i class="bi bi-arrow-left"></i> Назад
                            </a>
                            @can('view',auth()->user())
                                <a href="{{ route('decorPodushki.edit', $product->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i> Изменить
                                </a>
                                <form action="{{ route('decorPodushki.destroy',$product->id) }}" method="POST" onsubmit="return confirm('Вы уверены?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash"></i> Удалить
                                    </button>
                                </form>
                            @endcan

                            <form action="{{ route('favorites.toggle', $product->id) }}" method="POST">
                                @csrf
                                @if(auth()->user() && auth()->user()->favorites()->where('product_id', $product->id)->exists())
                                    <button type="submit" class="btn btn-success">✅ В избранном</button>
                                @else
                                    <button type="submit" class="btn btn-outline-primary">💖 Добавить в избранное</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
