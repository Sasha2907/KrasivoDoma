@extends('layouts.admin')
@section('content')
<div class="container py-4">
    <div class="mb-4">
        <h3 class="fw-bold">Добавить нового поставщика</h3>
        
        <p class="text-muted">Пожалуйста, заполните данные для нового поставщика.</p>
        <a href="{{ route('admin.suppliers.index') }}" class="btn btn-outline-danger">
            <i class="bi bi-arrow-left"></i> Назад
        </a>
    </div>

    <form action="{{ route('admin.suppliers.store') }}" method="POST" class="bg-light p-4 rounded shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Имя поставщика</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Введите имя поставщика" required>
        </div>

        <div class="mb-3">
            <label for="country" class="form-label">Страна</label>
            <input type="text" class="form-control" id="country" name="country" placeholder="Введите страну поставщика" required>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">Добавить</button>
        </div>
    </form>
</div>

@endsection
