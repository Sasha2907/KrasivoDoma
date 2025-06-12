@extends('layouts.admin')

@section('content')
<div class="container">
<div class="container">
<div class="mb-4 mt-4 catalog-header">
            <img src="/images/logoCircle.png" alt="Логотип" class="catalog-logo">
            <p class="catalog-title">Пред-заказы</p>
        </div>

    <form method="GET" class="row mb-4 g-2">
    <div class="col-md-4">
        <input type="text" name="email" class="form-control" placeholder="Поиск по email" value="{{ request('email') }}">
    </div>

    <div class="col-md-3">
        <select name="status" class="form-select">
            <option value="">Все статусы</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Ожидает</option>
            <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>Ответ отправлен</option>
        </select>
    </div>

    <div class="col-md-3">
        <select name="sort" class="form-select">
            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Сначала новые</option>
            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Сначала старые</option>
        </select>
    </div>

    <div class="col-md-2">
        <button class="btn btn-primary w-100">Фильтровать</button>
    </div>
</form>
    @foreach($preorders as $preorder)
        <div class="card mb-4">
            <div class="card-body">
                <h5>Заявка от: {{ $preorder->user->name ?? 'Пользователь удалён' }} ({{ $preorder->user->email ?? 'N/A' }})</h5>
                <p><strong>Описание:</strong> {{ $preorder->description ?? 'Не указано' }}</p>
                @php
                    $statusMap = [
                        'pending' => 'Ожидает рассмотрения',
                        'approved' => 'Одобрено',
                        'replied' => 'Ответ отправлен',
                    ];
                @endphp
                <p><strong>Статус:</strong> {{ $statusMap[$preorder->status] ?? $preorder->status }}</p>
                <h6>Выбранные позиции:</h6>
               
                <div class="row">
                    @foreach($preorder->items as $item)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                @if ($item->item_type === \App\Models\Products::class && $item->item)
                                    <img src="{{ $item->item->image ? asset('storage/' . $item->item->image) : asset('images/no-image.jpg') }}" 
                                         class="card-img-top" 
                                         alt="{{ $item->item->name ?? 'Без названия' }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->item->name ?? 'Товар удалён' }}</h5><br>
                                        <p>Материал: {{ $item->item->material ?? '-' }}</p>
                                        <p>Цена: {{ $item->item->price ?? '0' }} BYN</p>
                                    </div>
                                @elseif ($item->item_type === \App\Models\Configuration::class && $item->item)
                                    <div class="card-body">
                                        <h5 class="card-title">Конфигурация: {{ $item->item->name ?? 'Конфигурация удалена' }}</h5>
                                        @php
                                            $typeMap = [
                                                'curtains' => 'Штора',
                                                'tulle' => 'Тюль',
                                                'roman' => 'Римская штора',
                                                'coverlet' => 'Покрывало',
                                            ];
                                        @endphp
                                        <p>Тип: {{ $typeMap[$item->item->product_type] ?? $item->item->product_type }}</p>
                                        <p>Размер: {{ $item->item->width ?? '0' }}x{{ $item->item->height ?? '0' }} см</p>
                                        <p>Ткань: {{ $item->item->fabric->name ?? '-' }}</p>
                                        @if($item->item->sewingType)
                                            <p>Пошив: {{ $item->item->sewingType->name }}</p>
                                        @endif
                                    </div>
                                @else
                                    <div class="card-body">
                                        <p class="text-danger">Элемент был удалён</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Управление заявкой --}}
                <div class="mt-3">
                    @if($preorder->status === 'pending')
                        <button class="btn btn-warning" data-bs-toggle="collapse" data-bs-target="#replyForm{{ $preorder->id }}">
                            ✉ Ответить пользователю
                        </button>

                        <div class="collapse mt-3" id="replyForm{{ $preorder->id }}">
                            <form action="{{ route('admin.preorders.reply', $preorder) }}" method="POST">
                                @csrf
                                <div class="mb-2">
                                    <textarea name="admin_message" class="form-control" rows="3" placeholder="Сообщение пользователю..." required></textarea>
                                </div>
                                <button class="btn btn-primary mb-2">Отправить</button>
                            </form>
                        </div>
                    @elseif($preorder->status === 'replied')
                        <p><strong>Ответ администратора:</strong> {{ $preorder->admin_message }}</p>
                    @endif
                    <form action="{{ route('admin.preorders.destroy', $preorder) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить эту заявку?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger ">🗑 Удалить</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $preorders->appends(request()->query())->links() }}
    </div>
</div>
@endsection