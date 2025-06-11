@extends('layouts.Review.main')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow-lg rounded-4">
        <div class="card-body p-4">
            <h2 class="card-title text-center mb-4">Оставьте ваш отзыв</h2>

            <form action="{{ route('review.store') }}" method="post">
                @csrf

                <div class="mb-4">
                    <label for="content" class="form-label fs-5">Ваш отзыв</label>
                    <textarea class="form-control rounded-3" id="content" name="content" rows="6"
                        placeholder="Поделитесь своим мнением о нашем сервисе, что понравилось или что бы вы хотели улучшить..." required></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/review" class="btn btn-outline-danger">Назад</a>
                    <button type="submit" class="btn btn-primary">Отправить отзыв</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection