@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="mb-4 mt-4 catalog-header">
            <img src="/Images/logoCircle.png" alt="Логотип" class="catalog-logo">
            <p class="catalog-title">Поставщики</p>
        </div>
        <a href="{{route('admin.suppliers.create')}}" class="btn btn-primary mb-3">Добавить поставщика</a>

        <!-- Форма поиска и сортировки -->
        <form action="{{ route('admin.suppliers.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Поиск по названию поставщика"
                       value="{{ request('search') }}">

                <select name="sort" class="form-select">
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>А-Я</option>
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Я-А</option>
                </select>

                <button type="submit" class="btn btn-primary">Применить</button>
            </div>
        </form>

        <!-- Список поставщиков -->
        @foreach($suppliers as $supplier)
            <div class="card mb-3">
                <div class="card-header">
                    <p>Название поставщика: {{$supplier->name}}</p>
                </div>
                <div class="card-body">
                    <p>Страна поставщика: {{$supplier->country}}</p>
                    <a href="{{route('admin.suppliers.edit',$supplier->id)}}" class="btn btn-outline-primary">Изменить поставщика</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection

