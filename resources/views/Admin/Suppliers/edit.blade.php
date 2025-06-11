@extends('layouts.admin')
@section('content')
<div class="container py-4">
    <div class="mb-4">
        <h3 class="fw-bold">Редактировать поставщика</h3>
        
        <p class="text-muted">Измените данные и сохраните обновления.</p>
        <a href="{{ route('admin.suppliers.index') }}" class="btn btn-outline-danger">
            <i class="bi bi-arrow-left"></i> Назад
        </a>
    </div>

    <form action="{{ route('admin.suppliers.update', $supplier->id) }}" method="POST" class="bg-light p-4 rounded shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Имя поставщика</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $supplier->name }}" required>
        </div>

        <div class="mb-3">
            <label for="country" class="form-label">Страна</label>
            <input type="text" class="form-control" id="country" name="country" value="{{ $supplier->country }}" required>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if ($('body').layout) {
            $('body').layout('fix');
        }
    });
</script>
@endsection