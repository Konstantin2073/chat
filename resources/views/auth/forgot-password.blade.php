@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="card shadow-lg" style="width: 400px;">
        <div class="card-body p-4">
            <h2 class="text-center mb-4">Forgot Password</h2>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email"
                           class="form-control" placeholder="Enter your email" required>
                </div>

                <button type="submit" class="btn btn-warning w-100">Send Reset Link</button>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}">Back to login</a>
            </div>
        </div>
    </div>
</div>
@endsection
