@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <h3 class="fw-bold">Добавить ткань</h3>
        <p class="text-muted">Заполните форму ниже, чтобы добавить новую ткань в каталог.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('fabrics.index') }}" class="btn btn-outline-danger mb-3">
        <i class="bi bi-arrow-left"></i> Назад
    </a>

    <form method="POST" action="{{ route('fabrics.store') }}" enctype="multipart/form-data" class="bg-light p-4 rounded shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Название ткани</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Например: Бархат" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Тип</label>
            <select name="type" id="type" class="form-select" required>
                <option value="curtain">Шторы</option>
                <option value="tulle">Тюль</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Цена (BYN)</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control" placeholder="" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Изображение</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="overlay" class="form-label">Изображение для конструктора</label>
            <input type="file" name="overlay" id="overlay" class="form-control" required>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">Добавить</button>
        </div>
    </form>
</div>
@endsection
