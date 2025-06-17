@extends('layouts.admin')

@section('content')
<div class="container py-4">
        <a href="{{ route('fabrics.index') }}" class="btn btn-outline-danger mb-3">
            <i class="bi bi-arrow-left"></i> Назад
        </a>
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Редактировать ткань</h4>
        </div>

        <div class="card-body">
            <form method="POST" autocomplete="off" action="{{ route('fabrics.update', $fabric) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Название ткани</label>
                    <input type="text" name="name" value="{{ $fabric->name }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Тип</label>
                    <select name="type" class="form-select" required>
                        <option value="curtain" {{ $fabric->type == 'curtain' ? 'selected' : '' }}>Шторы</option>
                        <option value="tulle" {{ $fabric->type == 'tulle' ? 'selected' : '' }}>Тюль</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">Изображение (не обязательно)</label>
                    <input type="file" name="image" class="form-control">
                    <div class="mt-2">
                        <small class="text-muted">Текущее изображение:</small><br>
                        <img src="{{ asset($fabric->image) }}" class="img-thumbnail" width="150">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Изображение для первью (не обязательно)</label>
                    <input type="file" name="overlay" class="form-control">
                    <div class="mt-2">
                        <small class="text-muted">Текущее изображение:</small><br>
                        <img src="{{ asset($fabric->overlay) }}" class="img-thumbnail" width="150">
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
