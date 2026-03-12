@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="card shadow-lg" style="width: 400px;">
        <div class="card-body p-4">
            <h2 class="text-center mb-4">Login Chat</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email"
                        class="form-control" 
                        placeholder="Enter your email" 
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password"
                        class="form-control" 
                        placeholder="Enter your password" 
                        required
                        minlength="6"
                    >
                </div>

                <button type="submit" class="btn btn-primary w-100">Login Chat</button>
            </form>

            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('register') }}">Register</a>
                <a href="{{ route('password.request') }}">Forgot password?</a>
            </div>
        </div>
    </div>
</div>
@endsection
