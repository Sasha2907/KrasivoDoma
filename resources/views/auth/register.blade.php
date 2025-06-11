@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Регистрация</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Имя</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                       name="name" value="{{ old('name') }}" required autofocus minlength="2" maxlength="50">

                                @error('name')
                                    <span class="invalid-feedback d-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Электронная почта</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" required>

                                @error('email')
                                    <span class="invalid-feedback d-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Пароль -->
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Пароль</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="password" type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           name="password" required minlength="8">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="bi bi-eye" id="eyeIcon"></i>
                                    </button>
                                </div>

                                @error('password')
                                    <span class="invalid-feedback d-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Подтверждение пароля -->
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Подтвердите пароль</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="password-confirm" type="password" 
                                           class="form-control" name="password_confirmation" 
                                           required minlength="8">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                                        <i class="bi bi-eye" id="eyeIconConfirm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Кнопка -->
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Далее
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <small>Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Глазики -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function () {
            password.type = password.type === 'password' ? 'text' : 'password';
            eyeIcon.classList.toggle('bi-eye');
            eyeIcon.classList.toggle('bi-eye-slash');
        });

        const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
        const passwordConfirm = document.getElementById('password-confirm');
        const eyeIconConfirm = document.getElementById('eyeIconConfirm');

        togglePasswordConfirm.addEventListener('click', function () {
            passwordConfirm.type = passwordConfirm.type === 'password' ? 'text' : 'password';
            eyeIconConfirm.classList.toggle('bi-eye');
            eyeIconConfirm.classList.toggle('bi-eye-slash');
        });
    });
</script>
@endsection
