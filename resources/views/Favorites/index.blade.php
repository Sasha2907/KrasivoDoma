@extends('layouts.Review.main')

@section('content')
<!-- <div class="container mt-4 mb-5">
    <h2 class="mb-4">Предзаказ из избранного и конфигураций</h2>

    {{-- Форма фильтрации --}}
    <form method="GET" action="{{ route('favorites.index') }}" class="mb-4">
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Поиск по названию"
                       value="{{ request('search') }}">
            </div>

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

            <div class="col-md-3">
                <select name="country" class="form-select">
                    <option value="all">Все страны</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->country }}" {{ request('country') == $country->country ? 'selected' : '' }}>
                            {{ $country->country }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-primary w-100">Фильтровать</button>
            </div>
        </div>
    </form>

    {{-- Уведомление --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Форма предзаказа --}}
    <form method="POST" action="{{ route('preorders.confirm') }}">
        @csrf

        {{-- Избранные товары --}}
        <h4 class="mt-4">Избранные товары</h4>
        <div class="row">
            @forelse($favorites as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 60) }}</p>
                            <p><strong>Материал:</strong> {{ $product->material }}</p>

                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="favorites[]" value="{{ $product->id }}" id="fav-{{ $product->id }}">
                                <label class="form-check-label" for="fav-{{ $product->id }}">Добавить в заявку</label>
                            </div>

                            <a href="{{ route('shtory.show', $product->id) }}" class="btn btn-sm btn-primary">Подробнее</a>

                            <form action="{{ route('favorites.destroy', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">❌ Удалить</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p>По вашему запросу ничего не найдено.</p>
            @endforelse
        </div>

        {{-- Конфигурации --}}
        <h4 class="mt-4">Мои конфигурации</h4>
        @php
            $productTypeNames = [
                'curtains' => 'шторы',
                'tulle' => 'тюль',
                'roman' => 'римская штора',
            ];
        @endphp
        @forelse($configs as $config)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $config->name }} ({{ $productTypeNames[$config->product_type] ?? $config->product_type }})</h5>
                    <p><strong>Размер:</strong> {{ $config->width }} x {{ $config->height }} см</p>
                    <p><strong>Ткань:</strong> {{ $config->fabric->name }}</p>
                    @if($config->sewingType)
                        <p><strong>Пошив:</strong> {{ $config->sewingType->name }}</p>
                    @endif
                    

                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="configs[]" value="{{ $config->id }}" id="config-{{ $config->id }}">
                        <label class="form-check-label" for="config-{{ $config->id }}">Добавить в заявку</label>
                    </div>

                    <form action="{{ route('constructor.destroy', $config->id) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">🗑 Удалить конфигурацию</button>
                    </form>
                </div>
            </div>
        @empty
            <p>У вас нет сохранённых конфигураций.</p>
        @endforelse

        {{-- Комментарий к заявке --}}
        <div class="mb-4 mt-4">
            <label for="description" class="form-label">Комментарий к заказу</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">📩 Отправить заявку</button>
    </form>
</div> -->
<div class="container mt-4 mb-5">
<div class="catalog-header">
            <img src="/Images/logoCircle.png" alt="Логотип" class="catalog-logo">
            <h2 class="catalog-title">Избранное</h2>
        </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
        </div>
    @endif
    {{-- Основная форма для выбора товаров --}}
    <form method="POST" action="{{ route('preorders.confirm') }}" id="preorderForm">
        @csrf

        {{-- Избранные товары --}}
        <h4 class="mt-4">Избранные товары</h4>
        <div class="row">
            @forelse($favorites as $favorite)
                <div class="col-md-4 mb-4" id="favorite-{{ $favorite->id }}">
                    <div class="card">
                        <img src="{{ asset('storage/' . $favorite->image) }}" class="card-img-top" alt="{{ $favorite->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $favorite->name }}</h5>
                            <p class="card-text">{{ Str::limit($favorite->description, 60) }}</p>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           name="selected_items[]" 
                                           value="product_{{ $favorite->id }}" 
                                           id="product_{{ $favorite->id }}">
                                    <label class="form-check-label" for="product_{{ $favorite->id }}">
                                        Выбрать
                                    </label>
                                </div>
                                
                                <button type="button" class="btn btn-sm btn-danger delete-favorite" 
                                        data-id="{{ $favorite->id }}">Удалить</button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>Нет избранных товаров</p>
            @endforelse
        </div>

        {{-- Конфигурации --}}
        <h4 class="mt-4">Мои конфигурации</h4>
        @forelse($configs as $config)
            <div class="card mb-3" id="config-{{ $config->id }}">
                <div class="card-body">
                    <h5>{{ $config->name }} ({{ $productTypeNames[$config->product_type] ?? $config->product_type }})</h5>
                    <p><strong>Размер:</strong> {{ $config->width }} x {{ $config->height }} см</p>
                    <p><strong>Ткань:</strong> {{ $config->fabric->name }}</p>
                    @if($config->sewingType)
                        <p><strong>Пошив:</strong> {{ $config->sewingType->name }}</p>
                    @endif
                    

                    <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" 
                                           name="selected_items[]" 
                                           value="config_{{ $config->id }}" 
                                           id="config_{{ $config->id }}">
                                    <label class="form-check-label" for="config_{{ $config->id }}">
                                        Выбрать
                                    </label>
                    </div>

                    <button type="button" class="btn btn-sm btn-danger delete-config" data-id="{{ $config->id }}">Удалить</button>
                </div>
            </div>
        @empty
            <p>У вас нет сохранённых конфигураций.</p>
        @endforelse

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Оформить пред-заказ</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>

setTimeout(function () {
        let alert = document.getElementById('success-alert');
        if (alert) {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 4000); // 4 секунды
function showAlert(message) {
    Swal.fire({
        icon: 'warning',
        title: 'Внимание',
        text: message,
        confirmButtonText: 'ОК',
    });
}

    document.addEventListener('DOMContentLoaded', function() {
    // Обработчик для основной формы
    document.getElementById('preorderForm').addEventListener('submit', function(e) {
        // Проверка, что выбраны элементы
        const checkedItems = document.querySelectorAll('input[name="selected_items[]"]:checked');
        if (checkedItems.length === 0) {
            e.preventDefault();
            
            showAlert("Пожалуйста, выберите хотя бы один товар или конфигурацию");  
            return;
        }
        
        // Можно добавить индикатор загрузки
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Обработка...';
    });

    // Остальной код для удаления элементов...
});
document.addEventListener('DOMContentLoaded', function() {
    // Общая функция для удаления элемента
    async function deleteItem(url, elementId) {
    const result = await Swal.fire({
        title: 'Вы уверены?',
        text: "Это действие нельзя отменить!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Удалить',
        cancelButtonText: 'Отмена'
    });

    if (!result.isConfirmed) return;

    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                _method: 'DELETE'
            })
        });

        const data = await response.json();

        if (data.success) {
            const element = document.getElementById(elementId);
            if (element) {
                element.style.transition = 'opacity 0.3s';
                element.style.opacity = '0';
                setTimeout(() => element.remove(), 300);
            }

            await Swal.fire({
                title: 'Удалено!',
                text: 'Элемент успешно удалён.',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            });
        } else {
            await Swal.fire({
                title: 'Ошибка!',
                text: data.message || 'Неизвестная ошибка при удалении.',
                icon: 'error'
            });
        }
    } catch (error) {
        console.error('Ошибка:', error);
        await Swal.fire({
            title: 'Системная ошибка',
            text: 'Произошла ошибка при удалении.',
            icon: 'error'
        });
    }
}

    // Обработчики для избранного
    document.querySelectorAll('.delete-favorite').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            deleteItem(`/favorites/${id}`, `favorite-${id}`);
        });
    });

    // Обработчики для конфигураций
    document.querySelectorAll('.delete-config').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            deleteItem(`/constructor/${id}`, `config-${id}`);
        });
    });
});
</script>

@endsection