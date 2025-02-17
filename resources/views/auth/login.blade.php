@extends('layouts.app')

@section('content')
    <div class="auth-container">
        <h1>Kirish</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div>
                <label for="password">Parol:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Kirish</button>
        </form>
        <p>Sizda akkaunt mavjud emasmi? <a href="{{ route('register.form') }}">Ro`yxatdan o`tish</a></p>
    </div>
@endsection
