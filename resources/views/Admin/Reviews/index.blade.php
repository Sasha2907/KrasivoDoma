@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="mb-4 mt-4 catalog-header">
            <img src="/images/logoCircle.png" alt="Логотип" class="catalog-logo">
            <p class="catalog-title">Отзывы</p>
        </div>
        <form method="GET" action="{{ route('admin.review.index') }}" class="mb-4">
            <label for="date_filter" class="form-label">Показать отзывы за:</label>
            <select name="date_filter" id="date_filter" class="form-select w-auto d-inline-block">
                <option value="">-- Все отзывы --</option>
                <option value="week" {{ request('date_filter') == 'week' ? 'selected' : '' }}>Последнюю неделю</option>
                <option value="month" {{ request('date_filter') == 'month' ? 'selected' : '' }}>Последний месяц</option>
                <option value="year" {{ request('date_filter') == 'year' ? 'selected' : '' }}>Последний год</option>
            </select>
            <button type="submit" class="btn btn-primary  ms-2">Применить</button>
        </form>
        @foreach($reviews as $review)
            @foreach($users as $user)

                <form action="{{route('admin.review.destroy',$review->id)}}" method="post">
                    @if($review->user_id == $user->id)
                        <div class="card mb-3">
                            <div class="card-header">
                                {{$user->name}}
                            </div>
                            <div class="card-body ps-3">
                            <p class="text-muted">{{ $review->created_at->format('d.m.Y H:i') }}</p>
                                <p class="card-text">{{$review->content}}</p>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">Удалить</button>
                            </div>
                        </div>
                    @endif
                </form>
            @endforeach

        @endforeach
    </div>

@endsection
