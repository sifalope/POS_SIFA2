@extends('layouts.app')

@section('title', 'Login POS')

@section('content')

<style>
    body {
        background-color: #fdf2f8; /* Background pink soft sesuai gambar */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
    }

    .login-container {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .login-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        width: 100%;
        max-width: 380px;
        overflow: hidden;
    }

    /* Header Atas Kotak Login */
    .login-header {
        background-color: #f9fafb;
        padding: 16px;
        text-align: center;
        border-bottom: 1px solid #f3f4f6;
    }

    .login-header h2 {
        margin: 0;
        font-size: 22px;
        color: #1f2937;
        font-weight: 600;
    }

    /* Body Form Login */
    .login-body {
        padding: 25px 30px 30px 30px;
        text-align: center;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        color: #374151;
        font-size: 15px;
        font-weight: 500;
        margin-bottom: 8px;
    }

    /* Field Input Biru/Muda */
    .form-control-custom {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #dbeafe;
        background-color: #eff6ff; /* Warna latar kebiruan sesuai gambar */
        border-radius: 8px;
        font-size: 14px;
        color: #1f2937;
        box-sizing: border-box;
        outline: none;
        transition: border-color 0.2s;
    }

    .form-control-custom:focus {
        border-color: #93c5fd;
        background-color: #ffffff;
    }

    /* Tombol Submit Pink */
    .btn-submit {
        background-color: #f472b6; /* Warna tombol pink */
        color: #ffffff;
        border: none;
        padding: 10px 28px;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s ease;
        margin-top: 5px;
    }

    .btn-submit:hover {
        background-color: #ec4899;
    }

    .error-text {
        color: #ef4444;
        font-size: 12px;
        margin-top: 4px;
        text-align: left;
    }
</style>

<div class="login-container">
    <div class="login-card">
        
        <div class="login-header">
            <h2>SA Cosmetics</h2>
        </div>

        <div class="login-body">
            <form action="{{ route('auth') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-control-custom" 
                        value="{{ old('email') }}" 
                        placeholder="email@example.com"
                        required 
                        autofocus
                    >
                    @error('email')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-control-custom" 
                        placeholder="••••••••"
                        required
                    >
                    @error('password')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">
                    Submit
                </button>
            </form>
        </div>

    </div>
</div>

@endsection