@extends('app')

@section('title', 'Add Donation - Step 2 - Save Bite')

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

    /* Upload Button */
    .upload-btn {
        position: relative;
        background-color: #ad2727;
        color: white;
        border: 1px solid #ddd;
        border-radius: 25px;
        padding: 15px 20px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: 16px;
        overflow: hidden;
        transition: all 0.3s;
    }

    .upload-btn:hover {
        background-color: #922222;
    }

    .upload-btn input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    /* Portion Controls */
    .portion-controls {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .quantity {
        font-size: 24px;
        font-weight: bold;
        min-width: 50px;
        text-align: center;
        color: #ad2727;
    }

    .qty-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: none;
        color: white;
        font-size: 18px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: all 0.3s;
    }

    .decrement, .increment {
        background-color: #ad2727;
    }

    .qty-btn:hover {
        background-color: #922222;
        transform: scale(1.1);
    }

    /* Submit Button */
    .submit-btn {
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

    .submit-btn:hover {
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

    /* File upload display */
    .file-name {
        margin-top: 10px;
        font-size: 14px;
        color: #666;
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 15px;
        display: none;
    }

    /* Error messages */
    .error-message {
        color: #c62828;
        font-size: 14px;
        margin-top: 5px;
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
        <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">LOG OUT</button>
        </form>
    </div>
</header>

<!-- Hero Section -->
<section class="hero">
    <div class="step-indicator">Step 2 of 2</div>
    <h1>Food Details</h1>
    <p>Complete the food donation by adding the food details and photo.</p>
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
    
    <form action="{{ route('browseA3.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Food Name</label>
            <input type="text" id="name" name="food_name" class="form-control" placeholder="Enter food name (e.g., Fried Rice, Pasta, etc.)" value="{{ old('food_name') }}" required>
            @error('food_name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="photo">Food Photo</label>
            <div class="upload-btn">
                <i class="fas fa-upload"></i> Choose Photo
                <input type="file" id="photo" name="food_photo" accept="image/*" required>
            </div>
            <div class="file-name" id="fileName"></div>
            @error('food_photo')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Portion Availability</label>
            <div class="portion-controls">
                <button type="button" class="qty-btn decrement">
                    <i class="fas fa-minus"></i>
                </button>
                <span class="quantity">1</span>
                <button type="button" class="qty-btn increment">
                    <i class="fas fa-plus"></i>
                </button>
                <input type="hidden" id="portion_quantity" name="portion_quantity" value="1">
                <span style="margin-left: 10px; color: #666;">portions available</span>
            </div>
            @error('portion_quantity')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="best-within">Best Within (Expiry Date)</label>
            <input type="text" id="best-within" name="best_within" class="form-control" placeholder="MM/DD/YYYY" value="{{ old('best_within') }}" required>
            <small style="color: #666; font-size: 12px;">Format: MM/DD/YYYY (e.g., 12/31/2024)</small>
            @error('best_within')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="button-container">
            <button type="button" class="back-btn" onclick="window.location.href='{{ route('browseA2') }}'">
                <i class="fas fa-arrow-left"></i> Back
            </button>
            <button type="submit" class="submit-btn">
                <i class="fas fa-check"></i> Complete Donation
            </button>
        </div>
    </form>
</section>

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

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityElement = document.querySelector('.quantity');
        const quantityInput = document.getElementById('portion_quantity');
        const decrementBtn = document.querySelector('.decrement');
        const incrementBtn = document.querySelector('.increment');
        const photoInput = document.getElementById('photo');
        const fileNameDisplay = document.getElementById('fileName');
        const dateInput = document.getElementById('best-within');

        // Quantity counter
        decrementBtn.addEventListener('click', function () {
            let quantity = parseInt(quantityElement.textContent);
            if (quantity > 1) {
                quantity = quantity - 1;
                quantityElement.textContent = quantity;
                quantityInput.value = quantity;
            }
        });

        incrementBtn.addEventListener('click', function () {
            let quantity = parseInt(quantityElement.textContent);
            quantity = quantity + 1;
            quantityElement.textContent = quantity;
            quantityInput.value = quantity;
        });

        // File upload display
        photoInput.addEventListener('change', function () {
            if (this.files.length > 0) {
                fileNameDisplay.textContent = `Selected: ${this.files[0].name}`;
                fileNameDisplay.style.display = 'block';
            } else {
                fileNameDisplay.textContent = '';
                fileNameDisplay.style.display = 'none';
            }
        });

        // Date input formatting (MM/DD/YYYY)
        dateInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 8) value = value.slice(0, 8);

            if (value.length >= 5) {
                value = value.slice(0, 2) + '/' + value.slice(2, 4) + '/' + value.slice(4);
            } else if (value.length >= 3) {
                value = value.slice(0, 2) + '/' + value.slice(2);
            }

            e.target.value = value;
        });

        // Form validation
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const nameInput = document.getElementById('name');
            const dateValue = dateInput.value;
            
            // Check if date is in correct format
            const datePattern = /^\d{2}\/\d{2}\/\d{4}$/;
            if (!datePattern.test(dateValue)) {
                e.preventDefault();
                alert('Please enter date in MM/DD/YYYY format');
                dateInput.focus();
                return false;
            }

            // Check if photo is selected
            if (!photoInput.files.length) {
                e.preventDefault();
                alert('Please select a food photo');
                return false;
            }
        });
    });
</script>
@endsection