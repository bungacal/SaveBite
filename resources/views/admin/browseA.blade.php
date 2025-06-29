@extends('app')

@section('title', 'Admin Browse Food - Save Bite')

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

    /* Main Content */
    main {
        padding: 40px 10%;
    }

    .page-title {
        text-align: center;
        margin-bottom: 40px;
    }

    .page-title h1 {
        font-family: 'Playfair Display', serif;
        font-weight: lighter;
        font-size: 42px;
        color: #333;
        margin-bottom: 15px;
    }

    .page-title p {
        color: #666;
        max-width: 700px;
        margin: 0 auto;
    }

    /* Success/Error Messages */
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        text-align: center;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    /* No donations message */
    .no-donations {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .no-donations h3 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .no-donations p {
        margin-bottom: 20px;
    }

    /* Food Grid */
    .food-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .food-card {
        border: 1px solid #eee;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s, opacity 0.3s, box-shadow 0.3s;
        position: relative;
        background: white;
    }

    .food-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .food-image {
        height: 180px;
        background-size: cover;
        background-position: center;
        background-color: #f0f0f0;
    }

    .food-info {
        padding: 15px;
    }

    .food-info h3 {
        margin-bottom: 8px;
        font-size: 18px;
        color: #333;
    }

    .food-info p {
        color: #666;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .donor-name {
        font-weight: 600;
        color: #333;
    }

    .location {
        font-size: 13px;
        margin-bottom: 8px;
        color: #777;
    }

    .food-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
    }

    .portion-info {
        font-size: 12px;
        color: #888;
    }

    .expiry-date {
        font-size: 12px;
        color: #d63384;
        font-weight: 500;
    }

    .status-badge {
        display: inline-block;
        padding: 3px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: bold;
        margin-top: 5px;
    }

    .status-available {
        background-color: #d4edda;
        color: #155724;
    }

    .status-claimed {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-completed {
        background-color: #cce7ff;
        color: #004085;
    }

    .status-expired {
        background-color: #f8d7da;
        color: #721c24;
    }

    .remove-icon {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #ad2727;
        color: white;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .food-card:hover .remove-icon {
        opacity: 1;
    }

    .remove-icon:hover {
        background: #922222;
    }

    /* Add Button */
    .add-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background-color: #ad2727;
        color: white;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        z-index: 100;
        transition: all 0.3s;
    }

    .add-btn:hover {
        background-color: #922222;
        transform: scale(1.1);
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

<!-- Main Content -->
<main>
    <!-- Success/Error Messages -->
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

    <div class="page-title">
        <h1>Browse Food</h1>
        <p>Manage all food donations. Add new donations or remove existing ones.</p>
    </div>

    @if($donations && $donations->count() > 0)
        <!-- Food Grid -->
        <div class="food-grid">
            @foreach($donations as $donation)
            <div class="food-card" data-donation-id="{{ $donation->id }}">
                <div class="food-image" 
                     style="background-image: url('{{ $donation->food_photo ? Storage::url($donation->food_photo) : asset('images/makanan.jpg') }}')"></div>
                <div class="remove-icon" onclick="deleteDonation({{ $donation->id }})">
                    <i class="fas fa-minus"></i>
                </div>
                <div class="food-info">
                    <h3>{{ $donation->food_name }}</h3>
                    <p class="donor-name">{{ $donation->donor_name }}</p>
                    <p class="location">{{ $donation->short_address }}</p>
                    <div class="food-meta">
                        <span class="portion-info">{{ $donation->portion_quantity }} portions</span>
                        <span class="expiry-date">Best: {{ $donation->best_within }}</span>
                    </div>
                    <div class="status-badge status-{{ $donation->status }}">
                        {{ $donation->status_label }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <!-- No donations message -->
        <div class="no-donations">
            <h3>No Food Donations Yet</h3>
            <p>Start adding food donations by clicking the + button below.</p>
            <i class="fas fa-utensils" style="font-size: 48px; color: #ccc; margin-top: 20px;"></i>
        </div>
    @endif

    <!-- Add Button -->
    <div class="add-btn" onclick="window.location.href='{{ route('browseA2') }}'">
        <i class="fas fa-plus"></i>
    </div>
</main>

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
    // Delete donation function
    function deleteDonation(donationId) {
        if (confirm('Are you sure you want to delete this food donation?')) {
            // Create a form to delete donation
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `{{ url('/donations') }}/${donationId}`;
            
            // Add CSRF token
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);
            
            // Add method override
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);
            
            // Submit form
            document.body.appendChild(form);
            form.submit();
        }
    }

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
</script>
@endsection