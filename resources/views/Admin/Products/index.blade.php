@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="mb-4 mt-4 catalog-header">
            <img src="/images/logoCircle.png" alt="Логотип" class="catalog-logo">
            <p class="catalog-title">Товары</p>
        </div>
        <a href="{{ route('admin.products.exportPDF') }}" class="btn btn-danger mb-3">Экспорт в PDF</a>
        <a href="{{route('admin.products.create')}}" class="btn btn-primary mb-3">Создать</a>

        <!-- Форма поиска, сортировки и фильтрации -->
        <form action="{{ route('admin.products.index') }}" method="GET" class="mb-4">
            <div class="row">
                <!-- Поле поиска -->
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Поиск по названию товара"
                           value="{{ request('search') }}">
                </div>

                <!-- Сортировка по алфавиту -->
                <div class="col-md-2">
                    <select name="sort_name" class="form-select">
                        <option value="asc" {{ request('sort_name') == 'asc' ? 'selected' : '' }}>А-Я</option>
                        <option value="desc" {{ request('sort_name') == 'desc' ? 'selected' : '' }}>Я-А</option>
                    </select>
                </div>

                <!-- Фильтр по категории -->
                <div class="col-md-3">
                    <select name="category" class="form-select">
                        <option value="all">Все категории</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Фильтр по стране поставщика -->
                <div class="col-md-3">
                    <select name="supplier_country" class="form-select">
                        <option value="all">Все страны</option>
                        @foreach($countries as $country)
                            <option value="{{ $country }}" {{ request('supplier_country') == $country ? 'selected' : '' }}>
                                {{ $country }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Кнопка Применить -->
                <div class="col-md-12 mt-2">
                    <button type="submit" class="btn btn-primary">Применить</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-danger">Сбросить</a>
                </div>
            </div>
        </form>

        <!-- Список товаров -->
        <div class="d-flex flex-row flex-wrap mb-3">
            @foreach($products as $product)
                <div class="card m-3 w-20" style="width: 18rem;">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5><br>
                        <strong>Тип:</strong>
                        {{ $product->category->name ?? 'Не указано' }}<br>
                        <strong>Поставщик:</strong>
                {{ $product->supplier->country ?? 'Неизвестно' }}<br>
                        <a href="{{route('admin.products.show',$product->id)}}" class="btn btn-primary mb-1">Подробнее</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
@endsection
