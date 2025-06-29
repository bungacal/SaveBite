@extends('app')
@section('title', 'Save Bite - Sign In')

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
        line-height: 1.6;
        color: #333;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
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
        border: 1px solid #444;
        border-radius: 20px;
        padding: 8px 20px;
        font-weight: bold;
        transition: 0.3s;
    }

    .login-btn:hover {
        background-color: #444;
        color: white;
    }

    .login-btn.active {
        background-color: #444;  
        color: #f5f5f5;             
        cursor: default;
        pointer-events: none;    
    }
    
    /* Main content */
    .main-content {
        flex: 1;
        position: relative;
        overflow: hidden;
    }
    
    /* Background Image */
    .bg-image {
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 50%;
        object-fit: cover;
        z-index: -1;
    }
    
    /* Sign In Section */
    .signin-section {
        padding: 50px 20px;
        text-align: center;
    }
    
    .signin-title {
        font-family: 'Playfair Display', serif;
        font-size: 40px;
        color: #333;
        margin-bottom: 15px;
    }
    
    .signin-subtitle {
        font-size: 16px;
        color: #666;
        max-width: 500px;
        margin: 0 auto 40px;
        line-height: 1.5;
    }
    
    /* Form Styles */
    .signin-form-container {
        background-color: white;
        max-width: 460px;
        margin: 0 auto;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }
    
    .form-group {
        margin-bottom: 25px;
        text-align: left;
    }
    
    .form-label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #333;
    }
    
    .form-input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 16px;
        outline: none;
        transition: border-color 0.3s;
    }

    .form-input:focus {
        border-color: #b22;
    }
    
    .signin-button {
        background-color: #b22;
        color: white;
        border: none;
        width: 100%;
        padding: 12px;
        border-radius: 30px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 10px;
    }
    
    .signin-button:hover {
        background-color: #911;
    }
    
    .signup-link {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
        color: #333;
    }
    
    .signup-link a {
        color: #b22;
        font-weight: 600;
    }
    
    .signup-link a:hover {
        text-decoration: underline;
    }

    /* Error message styling */
    .error-message {
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
        border: 1px solid #f5c6cb;
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
    
    /* Responsive adjustments */
    @media (max-width: 1024px) {
        .footer-content {
            grid-template-columns: repeat(2, 1fr);
            gap: 40px;
        }
    }
    
    @media (max-width: 768px) {
        .navbar {
            flex-wrap: wrap;
        }
        
        .nav-links {
            order: 3;
            width: 100%;
            margin-top: 15px;
            justify-content: center;
        }
        
        .signin-form-container {
            padding: 30px 20px;
        }
        
        .signin-title {
            font-size: 32px;
        }
    }
    
    @media (max-width: 480px) {
        .top-bar {
            flex-direction: column;
            gap: 10px;
            padding: 10px;
        }
        
        .signin-form-container {
            padding: 25px 15px;
        }
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
        <a href="{{ route('login') }}" class="login-btn active">LOG IN</a>
    </div>
</header>

<!-- Main content with background image -->
<main class="main-content">
    <img src="{{ asset('gambar\Charity Drive.jpg') }}" alt="Food donation background" class="bg-image">
    
    <!-- Sign In Section -->
    <section class="signin-section">
        <h1 class="signin-title">Sign In to your Account</h1>
        <p class="signin-subtitle">Those who receive kindness today may become the ones who spread it tomorrow.</p>
        
        <!-- Sign In Form -->
        <div class="signin-form-container">
            <!-- Error messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
            <!-- Form action points to Laravel login route with POST method -->
            <form class="signin-form" action="{{ route('login') }}" method="POST"> 
                @csrf
                <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-input" 
                           placeholder="Enter your username" value="{{ old('username') }}" required>
                </div>
            
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-input" 
                           placeholder="Enter your password" required>
                </div>
            
                <button type="submit" class="signin-button">LOG IN</button>
            
                <div class="signup-link">
                    Don't have any account? <a href="{{ route('sign') }}">Sign up here</a>
                </div>
            </form>
        </div>
    </section>
</main>
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
    // Optional: Add any additional JavaScript for form validation or UX enhancement
    document.addEventListener('DOMContentLoaded', function() {
        // Focus on username field when page loads
        const usernameField = document.getElementById('username');
        if (usernameField) {
            usernameField.focus();
        }

        // Add some form validation feedback
        const form = document.querySelector('.signin-form');
        const inputs = form.querySelectorAll('.form-input');
        
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim() === '') {
                    this.style.borderColor = '#dc3545';
                } else {
                    this.style.borderColor = '#28a745';
                }
            });
        });
    });
</script>
@endsection