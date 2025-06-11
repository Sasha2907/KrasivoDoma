@extends('layouts.admin')

@section('content')
<div class="container">
<div class="mb-4 mt-4 catalog-header">
            <img src="/Images/logoCircle.png" alt="Логотип" class="catalog-logo">
            <p class="catalog-title">Ткани</p>
        </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('fabrics.create') }}" class="btn btn-primary mb-3">Добавить новую ткань</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Изображение</th>
                <th>Название</th>
                <th>Тип</th>
                <th>Цена</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fabrics as $fabric)
                <tr>
                    <td><img src="{{ asset($fabric->image) }}" alt="{{ $fabric->name }}" width="80"></td>
                    <td>{{ $fabric->name }}</td>
                    <td>{{ $fabric->type === 'curtain' ? 'Шторы' : 'Тюль' }}</td>
                    <td>{{ $fabric->price }}</td>
                    <td>
                        <a href="{{ route('fabrics.edit', $fabric) }}" class="btn btn-sm btn-warning">Редактировать</a>
                        <form action="{{ route('fabrics.destroy', $fabric) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Удалить эту ткань?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
