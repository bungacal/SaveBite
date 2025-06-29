@extends('app')

@section('title', 'Save Bite - Browse Food')

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
    
    /* Browse Banner */
    .browse-banner {
        width: 100%;
        margin: 20px 0;
        position: relative;
        overflow: hidden;
        border-radius: 10px;
    }
    
    .browse-banner img {
        width: 100%;
        display: block;
        height: 190px;
        object-fit: cover;
    }
    
    .browse-banner-text {
        font-family: 'Playfair Display', serif;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #333;
        font-size: 48px;
        font-weight: bold;
        text-align: center;
        text-transform: uppercase;
        background-color: rgba(255, 255, 255, 0.7);
        padding: 10px 30px;
        border-radius: 5px;
    }
    
    /* Main content */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .section-title {
        font-family: 'Playfair Display', serif;
        font-weight: bold;
        text-align: center;
        margin: 40px 0 20px;
        font-size: 36px;
        color: #333;
    }
    
    .see-all {
        display: inline-block;
        background-color: #b73e3e;
        color: white;
        padding: 5px 15px;
        border-radius: 5px;
        margin-bottom: 15px;
        font-weight: bold;
        font-size: 14px;
    }
    
    /* Food cards */
    .food-container {
        position: relative;
        padding: 0 40px;
        margin-bottom: 40px;
    }
    
    .food-row {
        display: flex;
        gap: 20px;
        overflow-x: auto;
        scrollbar-width: none;  /* Firefox */
        padding: 10px 0;
    }
    
    .food-row::-webkit-scrollbar {
        display: none;  /* Chrome, Safari */
    }
    
    .food-card {
        flex: 0 0 auto;
        width: 250px;
        background-color: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        cursor: pointer;
    }

    .food-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }
    
    .food-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
        background-color: #f0f0f0;
    }
    
    .food-details {
        padding: 15px;
    }
    
    .food-title {
        font-weight: bold;
        font-size: 18px;
        margin-bottom: 5px;
        color: #333;
    }
    
    .food-author, .food-location, .food-distance {
        font-size: 14px;
        color: #666;
        margin-bottom: 5px;
    }

    .food-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
        font-size: 12px;
    }

    .portion-info {
        color: #888;
    }

    .expiry-date {
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
    
    /* Navigation arrows */
    .nav-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
        background-color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        cursor: pointer;
        z-index: 10;
        transition: all 0.3s;
    }

    .nav-arrow:hover {
        background-color: #f0f0f0;
        transform: translateY(-50%) scale(1.1);
    }
    
    .arrow-left {
        left: 0;
    }
    
    .arrow-right {
        right: 0;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .empty-state h3 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .empty-state p {
        margin-bottom: 20px;
    }

    .empty-state i {
        font-size: 48px;
        color: #ccc;
        margin-top: 20px;
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
        .navbar {
            flex-wrap: wrap;
        }
        
        .nav-links {
            order: 3;
            width: 100%;
            margin-top: 15px;
            justify-content: center;
        }
        
        .food-container {
            padding: 0 20px;
        }
        
        .browse-banner-text {
            font-size: 32px;
            padding: 5px 20px;
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
    <!-- Browse banner -->
    <div class="browse-banner">
        <img src="{{ asset('gambar/confetti.jpg') }}" alt="Food collage" style="background-color: navy;">
        <div class="browse-banner-text">BROWSE</div>
    </div>
    
    @if(isset($donations) && $donations->count() > 0)
        <!-- Available Donations section -->
        <h2 class="section-title">Near Me</h2>
        
        <div class="food-container">
            <a href="{{ route('nearme') }}" class="see-all">See All</a>
            
            <!-- Navigation arrows -->
            <div class="nav-arrow arrow-left">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </div>
            <div class="nav-arrow arrow-right">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </div>
            
            <!-- Food cards row -->
            <div class="food-row">
                @foreach($donations as $donation)
                <div class="food-card" onclick="claimDonation({{ $donation->id }})">
                    <img src="{{ $donation->food_photo ? Storage::url($donation->food_photo) : asset('images/makanan.jpg') }}" 
                         alt="{{ $donation->food_name }}" class="food-image">
                    <div class="food-details">
                        <div class="food-title">{{ $donation->food_name }}</div>
                        <div class="food-author">{{ $donation->donor_name }}</div>
                        <div class="food-location">{{ $donation->short_address }}</div>
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
        </div>

        <!-- Recent Donations section -->
        <h2 class="section-title">Meal</h2>
        
        <div class="food-container">
            <a href="{{ route('meal') }}" class="see-all">See All</a>
            
            <!-- Navigation arrows -->
            <div class="nav-arrow arrow-left">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </div>
            <div class="nav-arrow arrow-right">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </div>
            
            <!-- Food cards row -->
            <div class="food-row">
                @foreach($donations->take(6) as $donation)
                <div class="food-card" onclick="claimDonation({{ $donation->id }})">
                    <img src="{{ $donation->food_photo ? Storage::url($donation->food_photo) : asset('images/makanan.jpg') }}" 
                         alt="{{ $donation->food_name }}" class="food-image">
                    <div class="food-details">
                        <div class="food-title">{{ $donation->food_name }}</div>
                        <div class="food-author">{{ $donation->donor_name }}</div>
                        <div class="food-location">{{ $donation->short_address }}</div>
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
        </div>
    @else
        <!-- Empty state -->
        <div class="empty-state">
            <h3>No Food Donations Available</h3>
            <p>There are currently no food donations available in your area.</p>
            <p>Check back later or consider <a href="{{ route('donate') }}" style="color: #b73e3e; font-weight: bold;">donating food</a> yourself!</p>
            <i class="fas fa-utensils"></i>
        </div>
    @endif
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
        Copyright © {{ date('Y') }} Hashtag Developer. All Rights Reserved
    </div>
</footer>
@endsection

@section('scripts')
<script>
    // JavaScript for Navigation arrows functionality
    document.addEventListener('DOMContentLoaded', function() {
        const foodRows = document.querySelectorAll('.food-row');
        const leftArrows = document.querySelectorAll('.arrow-left');
        const rightArrows = document.querySelectorAll('.arrow-right');
        
        for (let i = 0; i < foodRows.length; i++) {
            const row = foodRows[i];
            const leftArrow = leftArrows[i];
            const rightArrow = rightArrows[i];
            
            if (leftArrow) {
                leftArrow.addEventListener('click', function() {
                    row.scrollBy({ left: -270, behavior: 'smooth' });
                });
            }
            
            if (rightArrow) {
                rightArrow.addEventListener('click', function() {
                    row.scrollBy({ left: 270, behavior: 'smooth' });
                });
            }
        }
    });

    // Function to handle donation claiming
    function claimDonation(donationId) {
    @auth
        if (confirm('Do you want to claim this food donation?')) {
            fetch(`/donation/${donationId}/claim`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Donation claimed successfully!');
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                alert('Network error. Please try again.');
            });
        }
    @else
        alert('Please login first to claim food donations.');
        window.location.href = '{{ route("login") }}';
    @endauth

    }
</script>
@endsection