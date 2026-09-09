@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="auth-header">
        <h3>Sign In to Account</h3>
        <p>Enter your credentials to access the management portal</p>
    </div>

    @if(session('success'))
        <div class="alert-auth alert-auth-success">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert-auth alert-auth-error">
            <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}
        </div>
    @endif

    <form action="{{ url('logincode') }}" method="post">
        @csrf 

        <div class="form-group">
            <label class="form-label" for="email">Email Address</label>
            <div class="input-wrapper">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" id="email" name="email" class="form-input" placeholder="admin@hotel.com" required autofocus>
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
            <i class="fa-solid fa-right-to-bracket me-2"></i> Log In
        </button>

        <div class="auth-footer">
            Don't have an account? <a href="{{ url('register') }}">Register Here!</a>
        </div>
    </form>
@endsection