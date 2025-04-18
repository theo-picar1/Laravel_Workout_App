@extends('layouts.app')

@section('content')
<div x-data="{ active: 'none' }" class="content">
    <div x-show="active === 'none'" x-transition class="welcome-container">
        <div class="app-title">
            <div>
                <img src="{{ asset('images/app-logo.png') }}">
                <h1>FORGED</h1>
            </div>
            <p>Break new limits with your body</p>
        </div>
        <div class="authentication-buttons">
            <h3>Get started</h3>
            <button @click="active = 'login'">Login</button>
            <button @click="active = 'register'" class="register-button">Register</button>
        </div>
    </div>
    
    {{-- Transition animation reference: ChatGPT --}}
    {{-- Login modal --}}
    <div x-show="active === 'login'" x-transition:enter="transition transform ease-out duration-500"
         x-transition:enter-start="translate-x-full opacity-0"
         x-transition:enter-end="translate-x-0 opacity-100"
         x-transition:leave="transition transform ease-in duration-300"
         x-transition:leave-start="translate-x-0 opacity-100"
         x-transition:leave-end="translate-x-full opacity-0"
         class="fill-out-section">
         <div class="back-container">
            <img src="{{ asset('images/back-icon.png') }}">
            <p @click="active = 'none'">Back</p>
         </div>
        @include('auth.login')
    </div>

    {{-- Register modal --}}
    <div x-show="active === 'register'" x-transition:enter="transition transform ease-out duration-500"
         x-transition:enter-start="translate-x-full opacity-0"
         x-transition:enter-end="translate-x-0 opacity-100"
         x-transition:leave="transition transform ease-in duration-300"
         x-transition:leave-start="translate-x-0 opacity-100"
         x-transition:leave-end="translate-x-full opacity-0"
         class="fill-out-section">
         <div class="back-container">
            <img src="{{ asset('images/back-icon.png') }}">
            <p @click="active = 'none'">Back</p>
         </div>
        @include('auth.register')
    </div>

</div>
@endsection
