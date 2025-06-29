@extends('app')

@section('title', 'Save Bite - Kindness in Action')

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
    
    /* Top bar*/
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

    /* Hero Section */
    .hero {
        text-align: center;
        padding: 50px 20px;
    }

    .hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: 36px;
        margin-bottom: 15px;
    }

    .hero h2 {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        margin-bottom: 30px;
        color: #555;
    }

    .tagline {
        color: #666;
        margin-bottom: 30px;
    }

    /* Stories Grid */
    .stories-section {
        padding: 0 30px 50px;
    }

    .stories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        margin-bottom: 60px;
    }

    .story {
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .story:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }

    .story img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        display: block;
    }

    .story-info {
        padding: 20px;
    }

    .story-date {
        font-size: 14px;
        color: #666;
        margin-bottom: 5px;
    }

    .story-author {
        font-size: 14px;
        color: #b73e3e;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .story-content {
        font-size: 14px;
        color: #444;
        line-height: 1.6;
        text-align: justify;
    }

    /* Empty state styling */
    .empty-reviews {
        text-align: center;
        padding: 60px 20px;
        color: #666;
        grid-column: 1 / -1;
    }

    .empty-reviews h3 {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        margin-bottom: 10px;
        color: #555;
    }

    .empty-reviews p {
        margin-bottom: 20px;
        font-size: 16px;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    .empty-reviews i {
        font-size: 48px;
        color: #ccc;
        margin-bottom: 20px;
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
    @media (max-width: 768px) {
        .stories-grid {
            grid-template-columns: 1fr;
            padding: 0 15px;
        }

        .form-row {
            flex-direction: column;
            gap: 0;
        }

        .review-form-container {
            padding: 25px;
        }

        .hero h1 {
            font-size: 28px;
        }

        .hero h2 {
            font-size: 22px;
        }

        .navbar {
            flex-wrap: wrap;
        }
        
        .nav-links {
            order: 3;
            width: 100%;
            margin-top: 15px;
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
@php
    $approvedReviews = $approvedReviews ?? collect();
@endphp
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
            <img src="{{ asset('gambar/save bite.png') }}" alt="Save Bite Logo">
            <h1>Save Bite</h1>
        </a>
        <div class="nav-links">
            <a href="{{ route('index') }}">About Us</a>
            <a href="{{ route('review') }}" class="active">Review</a>
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

<!-- Hero Section -->
<section class="hero">
    <h1>They Call It Kindness in Action</h1>
    <h2>We Call It Save Bite</h2>
    <p class="tagline">Because every kindness matters. Here's what they say!</p>
</section>

<!-- Stories Grid - Dynamic Reviews -->
<section class="stories-section">
    <div class="stories-grid">
        @forelse($approvedReviews as $review)
            <div class="story">
                @if($review->reviewer_photo)
                    <img src="{{ Storage::url($review->reviewer_photo) }}" alt="Review by {{ $review->name }}">
                @else
                    <img src="{{ asset('gambar/default-reviewer.jpg') }}" alt="Review by {{ $review->name }}">
                @endif
                <div class="story-info">
                    <div class="story-date">{{ $review->submission_date->format('F j, Y') }}</div>
                    <div class="story-author">{{ $review->name }} | {{ $review->reviewing_as }}</div>
                    <p class="story-content">{{ $review->letter, 200 }}</p>
                </div>
            </div>
        @empty
            <!-- Empty state if no approved reviews -->
            <div class="empty-reviews">
                <i class="fas fa-comments"></i>
                <h3>No Stories Yet</h3>
                <p>Be the first to share your experience with Save Bite! Your story could inspire others to join our mission of fighting hunger and reducing food waste.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination if using paginate -->
    @if(method_exists($approvedReviews, 'links'))
        <div style="display: flex; justify-content: center; margin-top: 40px;">
            {{ $approvedReviews->links() }}
        </div>
    @endif
</section>

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
            <h3 class="footer-heading">Pages</h3>
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
        
        <div class="footer-links">
            <h3 class="footer-heading">Utility Pages</h3>
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
            <h3 class="footer-heading">Follow Us On Instagram</h3>
            <div class="footer-social">
                <div class="instagram-feed">
                    <img src="{{ asset('gambar/Voluntário.jpg') }}" alt="Instagram post">
                    <img src="{{ asset('gambar/saving uneaten food.jpg') }}" alt="Instagram post">
                    <img src="{{ asset('gambar/donate.jpg') }}" alt="Instagram post">
                    <img src="{{ asset('gambar/The Felix Project.jpg') }}" alt="Instagram post">
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
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-hide alerts after 5 seconds
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
</script>
@endsection