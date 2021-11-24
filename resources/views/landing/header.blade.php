<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('land/css/style.css') }}">
  </head>
  <body>
    <header class="header">
      <a href="{{ route('index') }}" class="logo"><img src="{{ asset('land/images/logo.png') }}" alt=""></a>
      <nav class="navbar">
        <a href="#home">home</a>
        <a href="#about">about</a>
        <a href="#makanan">makanan</a>
        <a href="#minuman">minuman</a>
      </nav>
      
      <div class="icons">
        {{-- <div class="fas fa-search" id="search-btn"></div> --}}
        @if(!Auth::check())
          <a href="{{ route('login') }}">
            <div class="fas fa-sign-in-alt"></div>
          </a>
        @else
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <div class="fas fa-sign-out-alt"></div>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        @endif
        <div class="fas fa-shopping-cart" id="cart-btn"></div>
        <div class="fas fa-bars" id="menu-btn"></div>
      </div>
      
      {{-- <div class="search-form">
        <input type="search" id="search-box" placeholder="search here...">
        <label for="search-box" class="fas fa-search"></label>
      </div> --}}

      <div class="cart-items-container">
        <div class="cart-item">
          <span class="fas fa-times"></span>
          <img src="{{ asset('land/images/cart-item-1.png') }}" alt="">
          <div class="content">
            <h3>cart item 01</h3>
            <div class="price">$15.99/-</div>
          </div>
        </div>
        <div class="cart-item">
          <span class="fas fa-times"></span>
          <img src="{{ asset('land/images/cart-item-2.png') }}" alt="">
          <div class="content">
            <h3>cart item 02</h3>
            <div class="price">$15.99/-</div>
          </div>
        </div>
        <div class="cart-item">
          <span class="fas fa-times"></span>
          <img src="{{ asset('land/images/cart-item-3.png') }}" alt="">
          <div class="content">
            <h3>cart item 03</h3>
            <div class="price">$15.99/-</div>
          </div>
        </div>
        <div class="cart-item">
          <span class="fas fa-times"></span>
          <img src="{{ asset('land/images/cart-item-4.png') }}" alt="">
          <div class="content">
            <h3>cart item 04</h3>
            <div class="price">$15.99/-</div>
          </div>
        </div>
        <a href="#" class="btn">checkout now</a>
      </div>
    </header>