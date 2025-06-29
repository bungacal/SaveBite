@extends('app')

@section('title', 'Add Donation - Step 1 - Save Bite')

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

    .logout-btn {
        border: 2px solid #444;
        border-radius: 20px;
        padding: 8px 20px;
        font-weight: bold;
        transition: 0.3s;
    }

    .logout-btn:hover {
        background-color: #444;
        color: white;
    }

    /* Hero Section */
    .hero {
        text-align: center;
        padding: 80px 0;
        max-width: 800px;
        margin: 0 auto;
    }

    .hero h1 {
        font-family: 'Playfair Display', serif;
        font-weight: lighter;
        font-size: 50px;
        color: #333;
        margin-bottom: 10px;
    }

    .hero .step-indicator {
        color: #ad2727;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .hero p {
        font-size: 18px;
        color: #666;
        margin-bottom: 40px;
    }

    /* Form Styles */
    .form-section {
        max-width: 800px;
        margin: 0 auto;
        padding-bottom: 80px;
    }

    .form-group {
        margin-bottom: 30px;
    }

    .form-group label {
        display: block;
        margin-bottom: 10px;
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 25px;
        font-size: 16px;
    }

    .form-control:focus {
        outline: none;
        border-color: #c62828;
    }

    .select-wrapper {
        position: relative;
    }

    .select-wrapper select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml;utf8,<svg fill='gray' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 20px;
    }

    .next-btn {
        display: inline-block;
        margin-left: auto;
        background-color: #ad2727;
        color: white;
        border: none;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        padding: 12px 30px;
        border-radius: 25px;
        transition: all 0.3s;
    }

    .next-btn:hover {
        background-color: #922222;
        transform: translateY(-2px);
    }

    .button-container {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
    }

    .back-btn {
        background-color: #f5f5f5;
        color: #666;
        border: none;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        padding: 12px 30px;
        border-radius: 25px;
        transition: all 0.3s;
    }

    .back-btn:hover {
        background-color: #e0e0e0;
    }

    /* Error messages */
    .error-message {
        color: #c62828;
        font-size: 14px;
        margin-top: 5px;
    }

    /* Alert Messages */
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        text-align: center;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
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
        <a href="{{ route('admin.dashboard') }}" class="logo">
            <img src="{{ asset('gambar\save bite.png') }}" alt="Save Bite Logo">
            <h1>Save Bite</h1>
        </a>
        <div class="nav-links">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.reviewA') }}">Review</a>
            <a href="{{ route('faqA') }}">FAQs</a>
            <a href="{{ route('browseA') }}" class="active">Browse</a>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">LOG OUT</button>
        </form>
    </div>
</header>

<!-- Hero Section -->
<section class="hero">
    <div class="step-indicator">Step 1 of 2</div>
    <h1>Add Food Donation</h1>
    <p>Enter the donor information to get started with adding a new food donation.</p>
</section>

<!-- Form Section -->
<section class="form-section container">
    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('browseA2.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Donor Name</label>
            <input type="text" id="name" name="donor_name" class="form-control" placeholder="Enter donor's full name" value="{{ old('donor_name') }}" required>
            @error('donor_name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="address">Donor Address</label>
            <input type="text" id="address" name="donor_address" class="form-control" placeholder="Enter complete donor's address" value="{{ old('donor_address') }}" required>
            @error('donor_address')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="contact">Donor Contact</label>
            <input type="tel" id="contact" name="donor_contact" class="form-control" placeholder="+62 812-3456-7890" value="{{ old('donor_contact') }}" required>
            @error('donor_contact')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="method">Pickup Method</label>
            <div class="select-wrapper">
                <select id="method" name="pickup_method" class="form-control" required>
                    <option value="" selected disabled>Select pickup method</option>
                    <option value="delivery" {{ old('pickup_method') == 'delivery' ? 'selected' : '' }}>Delivery</option>
                    <option value="self-pickup" {{ old('pickup_method') == 'self-pickup' ? 'selected' : '' }}>Self Pickup</option>
                </select>
            </div>
            @error('pickup_method')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="button-container">
            <button type="button" class="back-btn" onclick="window.location.href='{{ route('browseA') }}'">
                <i class="fas fa-arrow-left"></i> Back to List
            </button>
            <button type="submit" class="next-btn">
                Next <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    </form>
</section>

<!-- Footer -->
<footer>
    <div class="footer-content">
        <div class="footer-logo">
            <a href="#" class="logo">
                <img src="{{ asset('gambar/save-bite.png') }}" alt="Save Bite Logo">
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
                <li><a href="{{ route('index') }}">Home</a></li>
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