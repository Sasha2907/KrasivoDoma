@extends('layouts.Review.main')

@section('content')
    <!-- <div class="container mt-4">
        <h1 class="catalog-header">Добро пожаловать, {{ $user->name }}</h1>
        <p>Email: {{ $user->email }}</p>
        <a href="{{ route('profile.edit') }}">Редактировать профиль</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger mb-3">Выйти</button>
        </form>
    </div> -->
    <div class="container mt-4">
        <h1 class="catalog-header">Добро пожаловать, {{ $user->name }}</h1>
        <div class="d-flex flex-wrap gap-3 mb-4">
            <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">Редактировать профиль</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Выйти</button>
            </form>
        </div>

        <h2 class="mb-3">Мои пред-заказы</h2>
        
        @if($preorders->isEmpty())
            <div class="alert alert-info">У вас пока нет пред-заказов</div>
            
        @else
            <div class="accordion" id="preordersAccordion">
                @foreach($preorders as $preorder)
                    <div class="card mb-3">
                        <div class="card-header bg-light" id="heading{{ $preorder->id }}">
                            <button class="btn btn-link text-dark text-decoration-none w-100 text-start d-flex justify-content-between align-items-center" 
                                    type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#collapse{{ $preorder->id }}" 
                                    aria-expanded="{{ $loop->first ? 'true' : 'false' }}" 
                                    aria-controls="collapse{{ $preorder->id }}">
                                <span>
                                    Предзаказ #{{ $preorder->id }} - 
                                    {{ $preorder->created_at->format('d.m.Y H:i') }}
                                </span>
                                <span class="badge 
                                    @if($preorder->status === 'replied') bg-success
                                    @elseif($preorder->status === 'pending') bg-warning text-dark
                                    @else bg-warning text-dark @endif">
                                    @if($preorder->status === 'replied') Рассмотрен
                                    @elseif($preorder->status === 'pending') в обработке
                                    @else В обработке @endif
                                </span>
                            </button>
                        </div>

                        <div id="collapse{{ $preorder->id }}" class="collapse {{ $loop->first ? 'show' : '' }}" 
                             aria-labelledby="heading{{ $preorder->id }}" 
                             data-bs-parent="#preordersAccordion">
                            <div class="card-body">
                                <div class="mb-3">
                                    <h5>Информация о предзаказе</h5>
                                    <p><strong>Дата создания:</strong> {{ $preorder->created_at->format('d.m.Y H:i') }}</p>
                                    @if($preorder->updated_at->gt($preorder->created_at))
                                        <p><strong>Последнее обновление:</strong> {{ $preorder->updated_at->format('d.m.Y H:i') }}</p>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <h6>Комментарий к заказу:</h6>
                                    <div class="p-3 bg-light rounded">
                                        {{ $preorder->description ?? 'Без комментария' }}
                                    </div>
                                </div>

                                @if($preorder->admin_message)
                                    <div class="mb-3">
                                        <h6>Ответ администратора:</h6>
                                        <div class="p-3 bg-light rounded">
                                            {{ $preorder->admin_message }}
                                        </div>
                                    </div>
                                @endif

                                <h6 class="mt-4">Состав предзаказа:</h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Тип</th>
                                                <th>Название</th>
                                                <th>Детали</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($preorder->items as $item)
                                                <tr>
                                                    <td>
                                                        @if($item->item_type === 'App\Models\Products')
                                                            Товар
                                                        @else
                                                            Конфигурация
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $item->item->name ?? 'Элемент удалён' }}
                                                    </td>
                                                    <td>
                                                        @if($item->item_type === 'App\Models\Products')
                                                            Материал: {{ $item->item->material ?? 'не указан' }}
                                                        @else
                                                            @isset($item->item)
                                                                Размер: {{ $item->item->width }}x{{ $item->item->height }} см
                                                            @else
                                                                Конфигурация удалена
                                                            @endisset
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Пагинация -->
            <div class="mt-4 d-flex justify-content-center">
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-sm">
                {{-- Первая страница --}}
                <li class="page-item {{ $preorders->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $preorders->url(1) }}" aria-label="First">
                        <span aria-hidden="true">&laquo;&laquo;</span>
                    </a>
                </li>

                {{-- Предыдущая страница --}}
                <li class="page-item {{ $preorders->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $preorders->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                {{-- Номера страниц --}}
                @foreach(range(1, $preorders->lastPage()) as $page)
                    <li class="page-item {{ $preorders->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ $preorders->url($page) }}">{{ $page }}</a>
                    </li>
                @endforeach

                {{-- Следующая страница --}}
                <li class="page-item {{ !$preorders->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $preorders->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>

                {{-- Последняя страница --}}
                <li class="page-item {{ !$preorders->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $preorders->url($preorders->lastPage()) }}" aria-label="Last">
                        <span aria-hidden="true">&raquo;&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
        @endif
    </div>

    <style>
        
        /* Кастомные стили для пагинации */
    .pagination {
        font-size: 0.9rem;
    }
    .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    .page-link {
        color: #0d6efd;
        padding: 0.3rem 0.6rem;
    }
    .page-item.disabled .page-link {
        color: #6c757d;
    }
    .pagination-sm .page-link {
        min-width: 2rem;
        text-align: center;
    }
    </style>

    <!-- Подключение Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection