@extends('app')

@section('title', 'Save Bite - Donate')

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

    .login-btn, .profile-btn {
        border: 2px solid #444;
        border-radius: 20px;
        padding: 8px 20px;
        font-weight: bold;
        transition: 0.3s;
    }

    .login-btn:hover, .profile-btn:hover {
        background-color: #444;
        color: white;
    }

    /* Main content */
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 50px 20px;
    }
    
    /* Donate Section */
    .donate-section {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .donate-title {
        font-family: 'Playfair Display', serif;
        font-size: 48px;
        color: #333;
        margin-bottom: 20px;
    }
    
    .donate-subtitle {
        font-size: 16px;
        color: #666;
        max-width: 500px;
        margin: 0 auto 40px;
        margin-bottom: 100px;
        line-height: 1.5;
    }
    
    /* Form Styles */
    .donate-form {
        text-align: left;
        margin-top: 40px;
    }
    
    .form-group {
        margin-bottom: 40px;
    }
    
    .form-label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }
    
    .form-hint {
        font-size: 14px;
        color: #888;
        margin-bottom: 10px;
    }
    
    .form-input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 25px;
        font-size: 16px;
        outline: none;
        transition: border-color 0.3s;
    }
    
    .form-input:focus {
        border-color: #b22;
    }
    
    .form-button {
        background-color: #b22;
        color: white;
        border: none;
        padding: 12px 40px;
        border-radius: 25px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
        float: right;
    }
    
    .form-button:hover {
        background-color: #911;
    }

    /* Footer */
    footer {
        background-color: #333;
        color: white;
        padding: 50px 10%;
    }

    .footer-content {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        gap: 30px;
    }

    .footer-logo {
        margin-bottom: 20px;
        grid-column: 1;
    }

    .logo-img {
        height: 40px; 
        display: block;
    }

    .logo-text {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        font-weight: normal;
    }

    .footer-desc {
        font-size: 14px;
        line-height: 1.6;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .footer-social {
        display: flex;
        gap: 15px;
        margin-top: 20px;
    }

    .footer-social a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        background-color: #ddd;
        border-radius: 50%;
        color: #333;
    }

    .footer-heading {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .footer-links ul {
        list-style: none;
    }

    .footer-links li {
        margin-bottom: 12px;
    }

    .instagram-feed {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .instagram-feed img {
        width: 100%; 
        height: 100px;
        object-fit: cover;
        border-radius: 5px;
    }

    .copyright {
        text-align: center;
        padding: 20px;
        color: #666;
        font-size: 14px;
        margin-top: 50px;
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
        
        .donate-title {
            font-size: 36px;
        }
        
        .footer-content {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 480px) {
        .top-bar {
            flex-direction: column;
            gap: 10px;
            padding: 10px;
        }
        
        .donate-title {
            font-size: 28px;
        }
        
        .form-button {
            width: 100%;
            float: none;
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
            <a href="{{ route('index') }}" class="logo">
                <img src="{{ asset('gambar\save bite.png') }}" alt="Save Bite Logo">
                <h1>Save Bite</h1>
            </a>
            <div class="nav-links">
                <a href="{{ route('index') }}">About Us</a>
                <a href="{{ route('review') }}">Review</a>
                <a href="{{ route('faq') }}">FAQs</a>
                <a href="{{ route('contact') }}">Contact</a>
            </div>
            @auth
                <a href="{{ route('profile') }}" class="profile-btn">PROFILE</a>
            @else
                <a href="{{ route('login') }}" class="login-btn">LOG IN</a>
            @endauth
        </div>
    </header>

    <!-- Main content container -->
    <div class="container">
        <!-- Donate Section -->
        <section class="donate-section">
            <h1 class="donate-title">DONATE</h1>
            <p class="donate-subtitle">Your generosity helps reduce food waste and nourish those in need—thank you for making a difference!</p>
            
            <!-- Donation Form -->
            <form class="donate-form" method="POST" action="{{ route('donate1') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <p class="form-hint">Enter your Full Name/Organization/Business Name</p>
                    <input type="text" name="name" class="form-input" placeholder="Enter your name" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Contact (Email/Phone)</label>
                    <p class="form-hint">Enter your telephone number to confirm your donation</p>
                    <input type="text" name="contact" class="form-input" placeholder="Enter your email/phone" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Donation Address/Location</label>
                    <p class="form-hint">Enter the place where the food can be picked up or delivered</p>
                    <input type="text" name="address" class="form-input" placeholder="Enter your Address" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Donatur Type</label>
                    <p class="form-hint">Whether an individual, restaurant, supermarket, hotel, or other business</p>
                    <input type="text" name="donatur_type" class="form-input" placeholder="Enter" required>
                </div>
                
                <a href="{{ route('donate2') }}" class="form-button">Next</a>
            </form>
        </section>
    </div>
    
    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <a href="{{ route('index') }}" class="logo">
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
                    <li><a href="{{ route('index') }}">About Us</a></li>
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
    <!-- Additional scripts can be added here if needed -->
@endsection