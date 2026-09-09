@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <div class="auth-header">
        <h3>Create an Account</h3>
        <p>Register as a staff member or guest to manage bookings</p>
    </div>

    @if(session('error'))
        <div class="alert-auth alert-auth-error">
            <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}
        </div>
    @endif

    <form action="{{ url('registercode') }}" method="post">
        @csrf 

        <div class="form-group">
            <label class="form-label" for="name">Full Name</label>
            <div class="input-wrapper">
                <i class="fa-solid fa-user"></i>
                <input type="text" id="name" name="name" class="form-input" placeholder="John Doe" required autofocus>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="email">Email Address</label>
            <div class="input-wrapper">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" id="email" name="email" class="form-input" placeholder="john@example.com" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <div class="input-wrapper">
                <i class="fa-solid fa-lock"></i>
                <input type="password" id="password" name="password" class="form-input" placeholder="••••••••" required>
            </div>
        </div>

        <button type="submit" class="btn-auth">
            <i class="fa-solid fa-user-plus me-2"></i> Register Account
        </button>

        <div class="auth-footer">
            Already registered? <a href="{{ url('login') }}">Login Here!</a>
        </div>
    </form>
@endsection