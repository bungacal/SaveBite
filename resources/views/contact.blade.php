@extends('app')

@section('title', 'Save Bite - Contact Us')

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

    /* Contact Section */
    .contact-section {
        padding: 50px 30px;
        text-align: center;
    }

    .contact-title {
        font-family: 'Playfair Display', serif;
        font-size: 42px;
        margin-bottom: 15px;
        font-weight: 500;
    }

    .contact-subtitle {
        max-width: 600px;
        margin: 0 auto 40px;
        color: #666;
    }

    .contact-form-container {
        max-width: 700px;
        margin: 0 auto;
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .form-row {
        display: flex;
        margin-bottom: 20px;
        gap: 20px;
    }

    .form-group {
        flex: 1;
        text-align: left;
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
        border-radius: 30px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        outline: none;
        border-color: #b22;
    }

    textarea.form-control {
        height: 150px;
        resize: none;
        border-radius: 15px;
    }

    .btn-submit {
        background-color: rgb(156, 44, 44);
        color: white;
        border: none;
        padding: 12px 0;
        border-radius: 30px;
        font-weight: 500;
        cursor: pointer;
        width: 100%;
        transition: 0.3s;
    }

    .btn-submit:hover {
        background-color: #b22;
    }

    .btn-submit:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    /* Alert Messages */
    .alert {
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .alert-success {
        background-color: #e8f5e9;
        color: #2e7d32;
        border: 1px solid #c8e6c9;
    }

    .alert-danger {
        background-color: #ffebee;
        color: #c62828;
        border: 1px solid #ffcdd2;
    }

    .close-message {
        background: none;
        border: none;
        color: inherit;
        cursor: pointer;
        font-size: 18px;
    }

    .error-message {
        color: #c62828;
        font-size: 12px;
        margin-top: 5px;
    }

    /* Contact Details */
    .contact-details {
        display: flex;
        justify-content: space-between;
        margin: 60px auto;
        max-width: 900px;
        text-align: left;
    }

    .contact-details-item {
        flex: 1;
        margin: 0 15px;
    }

    .contact-details-item h3 {
        margin-bottom: 15px;
        font-weight: 600;
        font-size: 18px;
    }

    .contact-phone {
        color: rgb(156, 44, 44);
        font-weight: 600;
        font-size: 16px;
        display: block;
        margin-top: 5px;
    }

    .contact-hours p, .contact-address p {
        margin-bottom: 5px;
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

    /* Responsive */
    @media (max-width: 991px) {
        .contact-details {
            flex-direction: column;
        }
        
        .contact-details-item {
            margin-bottom: 30px;
        }
        
        .footer-content {
            grid-template-columns: 1fr 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .form-row {
            flex-direction: column;
            gap: 0;
        }
        
        .contact-info, .nav-links {
            display: none;
        }
        
        .top-bar {
            justify-content: center;
        }
        
        .navbar {
            flex-direction: column;
            padding: 20px 15px;
        }
        
        .navbar .logo {
            margin-bottom: 15px;
        }
        
        .footer-content {
            grid-template-columns: 1fr;
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
            <a href="{{ route('contact') }}" class="active">Contact</a>
        </div>
        @auth
            <a href="{{ route('profile') }}" class="profile-btn">PROFILE</a>
        @else
            <a href="{{ route('login') }}" class="login-btn">LOG IN</a>
        @endauth
    </div>
</header>

<!-- Contact Section -->
<section class="contact-section">
    <h1 class="contact-title">Contact Us</h1>
    <p class="contact-subtitle">We consider all the drivers of change gives you the components you need to change to create a truly happens.</p>
    
    <div class="contact-form-container">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                <div>
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
                <button class="close-message" onclick="this.parentElement.style.display='none'">×</button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <div>
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
                <button class="close-message" onclick="this.parentElement.style.display='none'">×</button>
            </div>
        @endif

        <form action="{{ route('contact.send') }}" method="POST" id="contactForm">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" 
                           placeholder="Enter your name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" 
                           placeholder="Enter email address" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" class="form-control" 
                       placeholder="Write a subject" value="{{ old('subject') }}" required>
                @error('subject')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" class="form-control" 
                          placeholder="Write your message" required>{{ old('message') }}</textarea>
                @error('message')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn-submit" id="submitBtn">
                <span id="submitText">Send</span>
                <span id="submitLoading" style="display: none;">
                    <i class="fas fa-spinner fa-spin"></i> Sending...
                </span>
            </button>
        </form>
    </div>
    
    <div class="contact-details">
        <div class="contact-details-item">
            <h3>Call Us:</h3>
            <a href="tel:+6212345678997" class="contact-phone">+62-123-4567-897</a>
        </div>
        
        <div class="contact-details-item contact-hours">
            <h3>Hours:</h3>
            <p>Mon-Fri: 11am - 8pm</p>
            <p>Sat, Sun: 9am - 10pm</p>
        </div>
        
        <div class="contact-details-item contact-address">
            <h3>Our Location:</h3>
            <p>Jl. Panglima Polim No. 13,</p>
            <p>Kec. Kebayoran Baru,</p>
            <p>Kota Jakarta Selatan</p>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="footer-content">
        <div class="footer-logo">
            <a href="{{ route('index') }}" class="logo">
                <img src="{{ asset('gambar\save bite.png') }}" alt="Save Bite Logo">
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
        Copyright © {{ date('Y') }} Hashtag Developer. All Rights Reserved
    </div>
</footer>
@endsection

@section('scripts')
<script>
    // Auto-hide alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.remove();
                }, 300);
            }, 5000);
        });
    });

    // Form submission with loading state
    document.getElementById('contactForm').addEventListener('submit', function() {
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const submitLoading = document.getElementById('submitLoading');
        
        submitBtn.disabled = true;
        submitText.style.display = 'none';
        submitLoading.style.display = 'inline';
    });
</script>
@endsection