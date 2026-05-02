@extends('layouts.app')

@section('content')
<section class="io-auth">
    <div class="io-auth-card">
        <h1 class="io-page-title" style="font-size:1.55rem;">Create Account</h1>

        <form action="{{ route('register.store') }}" method="POST" class="io-grid" style="margin-top:1rem;">
            @csrf

            <div>
                <label class="io-label">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="io-input">
            </div>

            <div>
                <label class="io-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="io-input">
            </div>

            <div>
                <label class="io-label">Password</label>
                <input type="password" name="password" required class="io-input">
            </div>

            <div>
                <label class="io-label">Confirm Password</label>
                <input type="password" name="password_confirmation" required class="io-input">
            </div>

            <button type="submit" class="io-btn io-btn-primary" style="width:100%;">Register</button>
            <a href="{{ route('login') }}" class="io-btn" style="width:100%;text-align:center;">Back to login</a>
        </form>
    </div>
</section>
@endsection
