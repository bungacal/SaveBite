@extends('app')
@section('title', 'Save Bite - Create Account')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Karla:wght@400;500;600;700&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Karla', sans-serif;
    }
    
    body {
        background-color: #f8f8f8;
        color: #333;
        line-height: 1.6;
    }
    
    a {
        text-decoration: none;
        color: inherit;
    }
    
    /* Top bar */
    .top-bar {
        background-color: #444;
        color: white;
        padding: 8px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .contact-info {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .social-icons {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    /* Header and Navigation */
    header {
        background-color: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 30px;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .logo img {
        height: 40px;
    }

    .logo h1 {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        font-weight: bold;
        color: #5a5858;
    }

    .nav-links {
        display: flex;
        gap: 10px;
        margin-right: 60px;
        margin-left: auto;
    }

    .nav-links a {
        color: #555;
        font-weight: 500;
        padding: 8px 16px;
        border-radius: 20px;
        transition: 0.3s;
    }

    .nav-links a.active {
        background-color: #e8e8d9;
    }

    .nav-links a:hover:not(.active) {
        background-color: #f5f5f5;
    }

    .login-btn {
        border: 2px solid #444;
        border-radius: 20px;
        padding: 8px 20px;
        font-weight: bold;
        transition: 0.3s;
    }

    .login-btn:hover {
        background-color: #444;
        color: white;
    }
    
    /* Main Content */
    .main-content {
        max-width: 800px;
        margin: 0 auto;
        padding: 50px 20px;
    }
    
    .page-title {
        text-align: center;
        font-size: 42px;
        margin-bottom: 15px;
        color: #4d4b4b;
        font-weight: normal;
        font-family: 'Playfair Display', serif; 
    }
    
    .page-subtitle {
        text-align: center;
        color: #666;
        margin-bottom: 40px;
    }
    
    /* Form */
    .signup-form {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 25px;
        font-size: 16px;
    }
    
    .btn-primary {
        display: inline-block;
        margin-left: auto;
        background-color: white;
        color: #a53535;
        border: none;
        font-size: 16px;
        font-weight: 900;
        cursor: pointer;
        padding: 10px 20px;
    }

    .button-container {
        width: 100%;
        display: flex;
        justify-content: flex-end; 
        margin-top: 20px;
    }
    
    .alert {
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
    }
    
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
</style>
@endsection

@section('content')
<!-- Top bar with contact info and social media -->
<div class="top-bar">
    <div class="contact-info">
        <a href="tel:(62)123-4567-897"><i class="fas fa-phone"></i> (62) 123-4567-897</a>
        <a href="mailto:savebite@gmail.com"><i class="fas fa-envelope"></i> savebite@gmail.com</a>
    </div>
    <div class="social-icons">
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-github"></i></a>
    </div>
</div>

<!-- Header & Navigation -->
<header>
    <div class="navbar">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('gambar\save bite.png') }}" alt="Save Bite Logo">
            <h1>Save Bite</h1>
        </a>
        <div class="nav-links">
            <a href="{{ route('home') }}">About Us</a>
            <a href="{{ route('review') }}">Review</a>
            <a href="{{ route('faq') }}">FAQs</a>
            <a href="{{ route('contact') }}">Contact</a>
        </div>
        <a href="{{ route('login') }}" class="login-btn">LOG IN</a>
    </div>
</header>

<!-- Main Content -->
<div class="main-content">
    <h1 class="page-title">Create your Account</h1>
    <p class="page-subtitle">Those who receive kindness today may become the ones who spread it tomorrow.</p>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('sign.post') }}" method="POST" id="registration-form-1">
        @csrf
        <div class="signup-form">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" 
                       placeholder="Enter your name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" 
                       placeholder="Enter your email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" class="form-control" 
                       placeholder="xxxx-xxxx-xxxx" value="{{ old('phone') }}" required>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" 
                       placeholder="Enter your username" value="{{ old('username') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" 
                       placeholder="Enter your password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" 
                       class="form-control" placeholder="Confirm your password" required>
            </div>
            
            <div class="button-container">
                <button type="submit" class="btn-primary">Next</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('footer')
<!-- Footer -->
<footer>
    <div class="footer-content">
        <div class="footer-logo">
            <a href="#" class="logo">
                <img src="{{ asset('gambar/save bite.png') }}" alt="Save Bite Logo">
                <span class="logo-text">Save Bite</span>
            </a>
            <p class="footer-desc">
                With Save Bite, every surplus meal becomes a chance to fight hunger, reduce waste, and bring hope to those in need.
            </p>
            <div class="footer-social">
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-github"></i></a>
            </div>
        </div>
        
        <div class="footer-links">
            <h3 class="footer-title">Pages</h3>
            <ul class="footer-list">
                <li><a href="{{ route('home') }}">About Us</a></li>
                <li><a href="{{ route('nearme') }}">Near Me</a></li>
                <li><a href="{{ route('browse') }}">Browse Food</a></li>
                <li><a href="{{ route('donate') }}">Donate</a></li>
                <li><a href="{{ route('faq') }}">FAQs</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
                <li><a href="{{ route('review') }}">Review</a></li>
            </ul>
        </div>
        
        <div class="footer-links ul">
            <h3 class="footer-title">Utility Pages</h3>
            <ul class="footer-list">
                <li><a href="#">Start Here</a></li>
                <li><a href="#">Styleguide</a></li>
                <li><a href="#">Password Protected</a></li>
                <li><a href="#">404 Not Found</a></li>
                <li><a href="#">Licenses</a></li>
                <li><a href="#">Changelog</a></li>
                <li><a href="#">View More</a></li>
            </ul>
        </div>
        
        <div class="footer-instagram">
            <h3 class="footer-title">Follow Us On Instagram</h3>
            <div class="footer-social">
                <div class="instagram-feed">
                    <img src="{{ asset('gambar\Voluntário.jpg') }}" alt="Instagram post">
                    <img src="{{ asset('gambar\saving uneaten food.jpg') }}" alt="Instagram post">
                    <img src="{{ asset('gambar\donate.jpg') }}" alt="Instagram post">
                    <img src="{{ asset('gambar\The Felix Project.jpg') }}" alt="Instagram post">
                </div>
            </div>
        </div>
    </div>
    
    <div class="copyright">
        Copyright © 2023 Hashtag Developer. All Rights Reserved
    </div>
</footer>
@endsection

@section('scripts')
<script>
    document.getElementById("registration-form-1").addEventListener("submit", function(event) {
        // Get password values
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("password_confirmation").value;

        // Check if passwords match
        if (password !== confirmPassword) {
            event.preventDefault(); // Stop form submission
            alert("Passwords do not match. Please try again.");
        }

        // Form will submit normally if passwords match
    });
</script>
@endsection