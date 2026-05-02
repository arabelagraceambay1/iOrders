@extends('layouts.app')

@section('content')
<section class="io-auth">
    <div class="io-auth-card">
        <h1 class="io-page-title" style="font-size:1.55rem;">Welcome Back</h1>

        @if ($errors->any())
            <div class="io-alert io-alert-error" style="margin-top:1rem;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login.store') }}" method="POST" class="io-grid" style="margin-top:1rem;">
            @csrf
            <div>
                <label class="io-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="io-input">
            </div>

            <div>
                <label class="io-label">Password</label>
                <input type="password" name="password" required class="io-input">
            </div>

            <label style="display:flex;align-items:center;gap:0.45rem;font-size:0.86rem;color:#475569;">
                <input type="checkbox" name="remember" value="1">
                Remember me
            </label>

            <button type="submit" class="io-btn io-btn-primary" style="width:100%;">Login</button>
            <a href="{{ route('register') }}" class="io-btn" style="width:100%;text-align:center;">Create account</a>
        </form>
    </div>
</section>
@endsection
