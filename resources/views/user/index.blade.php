@extends('app')

@section('title', 'Save Bite - A Place to Share')

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

    .login-btn, .profile-btn:hover {
        background-color: #444;
        color: white;
    }

    /* Hero Section */
    .hero {
        height: 100vh;
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                          url('{{ asset("gambar/These Volunteer.jpg") }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        position: relative;
    }

    .hero-content {
        max-width: 800px;
        z-index: 1;
        padding: 0 20px;
    }

    .hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: 64px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .hero p {
        font-size: 18px;
        margin-bottom: 40px;
    }

    .cta-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
    }

    .btn {
        padding: 12px 30px;
        border-radius: 30px;
        font-weight: bold;
        font-size: 16px;
        transition: 0.3s;
        cursor: pointer;
        display: inline-block;
    }

    .btn-primary {
        background-color: rgb(156, 44, 44);
        color: white;
        border: none;
    }

    .btn-primary:hover {
        background-color: #b22;
    }

    .btn-secondary {
        background-color: transparent;
        color: white;
        border: 2px solid white;
    }

    .btn-secondary:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    /* Stats Section */
    .stats-section {
        padding: 80px 0;
        text-align: center;
        background-color: #ffffff;
    }
    
    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 36px;
        margin-bottom: 60px;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .stats-container {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        gap: 40px;
        margin-top: 40px;
    }
    
    .stat-box {
        flex: 1;
        min-width: 250px;
        padding: 20px;
        text-align: center;
    }
    
    .stat-number {
        font-size: 60px;
        font-weight: bolder;
        color: #b22;
        margin-bottom: 0;
        line-height: 1.1;
        font-family: 'Karla', serif;
        opacity: 0;
    }
    
    .stat-text {
        font-size: 18px;
        color: #666;
        margin-top: 0;
        margin-bottom: 40px;
        line-height: 1.2;
        font-weight: bolder;
    }
    
    .stat-highlight {
        font-size: 14px;
        font-weight: bold;
        text-transform: uppercase;
        color: #333;
        line-height: 1.4;
    }

    .highlighted {
        background-color: #f7bebe;
        color: #333;
        padding: 5px 10px;
        border-radius: 4px;
    }
    
    /* Animation for stats counting */
    @keyframes countUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .animate-count {
        display: inline-block;
        animation: countUp 1s ease-out forwards;
    }
    
    /* About Section */
    .about-section {
        padding: 80px 0;
        background-color: #f9f9f9;
    }
    
    .about-container {
        display: flex;
        gap: 40px;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .about-images {
        flex: 1;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }
    
    .about-images img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .about-content {
        flex: 1;
        padding: 20px;
    }
    
    .about-title {
        font-family: 'Playfair Display', serif;
        font-size: 36px;
        margin-bottom: 20px;
        text-align: center;
    }
    
    .about-text {
        margin-bottom: 20px;
        line-height: 1.8;
        text-align: justify;
    }

    /* Testimonials Section */
    .testimonials-section {
        padding: 80px 0;
        text-align: center;
    }

    .testimonials-subtitle {
        font-family: 'Playfair Display', serif;
        font-size: 32px;
        margin-bottom: 20px;
    }

    .testimonials-tagline {
        font-size: 18px;
        color: #666;
        margin-top: 50px;
        margin-bottom: 5px;
        text-align: left;
    }

    .testimonials-grid {
        display: flex;
        overflow-x: auto;
        gap: 30px;
        padding: 20px 0;
        scroll-snap-type: x mandatory;
    }

    .testimonial-card {
        min-width: 300px;
        max-width: 300px;
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        scroll-snap-align: start;
    }

    .testimonial-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .testimonial-content {
        padding: 20px;
    }

    .testimonial-date {
        font-size: 14px;
        color: #666;
        text-align: left;
    }

    .testimonial-author {
        font-size: 14px;
        color: #666;
        margin-bottom: 20px;
        text-align: left;
    }

    .testimonial-text {
        font-size: 14px;
        line-height: 1.6;
        text-align: justify;
    }

    /* Alert styles for authentication messages */
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-success {
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
    }

    .alert-danger {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .about-container {
            flex-direction: column;
        }
        
        .about-images {
            order: 2;
        }
        
        .about-content {
            order: 1;
            margin-bottom: 40px;
        }
        
        .footer-content {
            grid-template-columns: 1fr 1fr;
        }
    }
    
    @media (max-width: 767px) {
        .contact-info {
            display: none;
        }
        
        .hero h1 {
            font-size: 40px;
        }
        
        .cta-buttons {
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }
        
        .stats-container {
            flex-direction: column;
            align-items: center;
        }
        
        .stat-box {
            width: 100%;
        }
        
        .footer-content {
            grid-template-columns: 1fr;
        }
        
        .navbar {
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            padding: 15px;
        }
        
        .logo {
            margin-bottom: 10px;
        }
        
        .nav-links {
            order: 3;
            justify-content: center;
            width: 100%;
            margin-top: 15px;
            flex-wrap: wrap;
        }
    }
</style>
@endsection

@section('content')
<!-- Authentication check notification (optional) -->
@if(session('login_success'))
    <div class="alert alert-success">
        {{ session('login_success') }}
    </div>
@endif

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
            <a href="{{ route('index') }}" class="active">About Us</a>
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

<!-- Hero section -->
<section class="hero" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('gambar/These Volunteer.jpg') }}');">
    <div class="hero-content">
        <h1>A Place to Share</h1>
        <p>We make a living from what we get, but we make a life from what we give.</p>
        <div class="cta-buttons">
            <a href="{{ route('donate') }}" class="btn btn-primary">Donate</a>
            <a href="{{ route('browse') }}" class="btn btn-secondary">Browse Food</a>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <h2 class="section-title">WHAT IS HAPPENING</h2>
        
        <div class="stats-container">
            <div class="stat-box">
                <div class="stat-number">0.0</div>
                <div class="stat-text">million tons</div>
                <div class="stat-highlight">
                    <span class="highlighted">FOOD WASTE</span> IN INDONESIA PER YEAR
                </div>
            </div>
            
            <div class="stat-box">
                <div class="stat-number">0.0</div>
                <div class="stat-text">&nbsp;</div>
                <div class="stat-text"></div>
                <div class="stat-highlight">
                    INDONESIA'S <span class="highlighted">GLOBAL HUNGER INDEX</span> (GHI)
                </div>
            </div>
            
            <div class="stat-box">
                <div class="stat-number">0.0%</div>
                <div class="stat-text">of the population</div>
                <div class="stat-highlight">
                    <span class="highlighted">MALNOURISHED</span> INDONESIAN SOCIETY
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section">
    <div class="container">
        <div class="about-container">
            <div class="about-images">
                <img src="{{ asset('gambar/Woman carrying.jpg') }}" alt="Fresh produce image">
                <img src="{{ asset('gambar/Bangkok float market.jpg') }}" alt="Floating market image">
            </div>
            <div class="about-content">
                <h2 class="about-title">Bits of Save Bite</h2>
                <p class="about-text">
                    Save Bite is a compassionate platform dedicated to fighting hunger and reducing food waste by distributing free meals to those in need. Through a network of generous donors, restaurants, and volunteers, Save Bite rescues surplus food and ensures it reaches individuals and families facing food insecurity.
                </p>
                <p class="about-text">
                    Whether you're a business with extra food or an individual looking to make a difference, you can contribute by donating meals, resources, or time. Together, we can create a world where food is shared, not wasted—one meal at a time. Join Save Bite and be a part of the change today!
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section">
    <div class="container">
        <h2 class="testimonials-subtitle">They Call It Kindness in Action</h2>
        <h3 class="testimonials-subtitle">We Call It Save Bite</h3>
        <p class="testimonials-tagline">Here's what they say</p>
        
        <div class="testimonials-grid">
            @forelse($approvedReviews as $review)
                <div class="testimonial-card">
                    @if($review->reviewer_photo)
                        <img src="{{ Storage::url($review->reviewer_photo) }}" class="testimonial-image" alt="{{ $review->name }}">
                    @else
                        <img src="{{ asset('gambar/default-reviewer.jpg') }}" class="testimonial-image" alt="{{ $review->name }}">
                    @endif
                    <div class="testimonial-content">
                        <div class="testimonial-date">{{ $review->submission_date->format('F j, Y') }}</div>
                        <div class="testimonial-author">{{ $review->name }} | {{ $review->reviewing_as }}</div>
                        <p class="testimonial-text">{{ Str::limit($review->letter, 200) }}</p>
                    </div>
                </div>
            @empty
                <!-- Fallback testimonials jika belum ada review yang disetujui -->
                <div class="testimonial-card">
                    <img src="{{ asset('gambar/download (1).jpg') }}" class="testimonial-image" alt="Elderly woman">
                    <div class="testimonial-content">
                        <div class="testimonial-date">March 6, 2024</div>
                        <div class="testimonial-author">Someone's Name | Food Receiver</div>
                        <p class="testimonial-text">It's not just food—it's dignity, care and connection. The people who donate through Save Bite make my life better in ways they truly care.</p>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <img src="{{ asset('gambar/small shop.jpg') }}" class="testimonial-image" alt="Small shop owner">
                    <div class="testimonial-content">
                        <div class="testimonial-date">March 14, 2024</div>
                        <div class="testimonial-author">Someone's Name | Food Receiver</div>
                        <p class="testimonial-text">When it feels like there's no way, struggling to eat and afford to care for my children, I found this app, it changed everything. The food helps, but also a renewed sense of dignity.</p>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <img src="{{ asset('gambar/Chefs Enjoy Cooking.jpg') }}" class="testimonial-image" alt="Chef">
                    <div class="testimonial-content">
                        <div class="testimonial-date">April 14, 2024</div>
                        <div class="testimonial-author">Someone's Name | Food Donor</div>
                        <p class="testimonial-text">Save Bite made it so easy for me to give back to the community. I'm grateful that my excess food can help those who really need it instead of going to waste.</p>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <img src="{{ asset('gambar/Asia - Cambodia.jpg') }}" class="testimonial-image" alt="Group of children">
                    <div class="testimonial-content">
                        <div class="testimonial-date">April 21, 2024</div>
                        <div class="testimonial-author">Someone's Name | Food Donor</div>
                        <p class="testimonial-text">As restaurant owners, we've seen our ordinarily discarded surplus transform lives. It makes us feel good knowing that our contributions can help families who need it.</p>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <img src="{{ asset('gambar/restaurant.jpg') }}" class="testimonial-image" alt="Restaurant staff">
                    <div class="testimonial-content">
                        <div class="testimonial-date">June 29, 2024</div>
                        <div class="testimonial-author">Someone's Name | Food Receiver</div>
                        <p class="testimonial-text">Partnering with Save Bite has been an extraordinary experience. It doesn't just provide food—it brings connection, care and hope. Save Bite has helped provide proper meals to those in need.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
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
<script>
    // Fungsi untuk toggle user dropdown
    function toggleUserDropdown() {
        document.getElementById("userDropdown").classList.toggle("show");
    }
    
    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.user-btn') && !event.target.closest('.user-btn')) {
            var dropdowns = document.getElementsByClassName("user-dropdown");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }

    // Fungsi untuk menganimasi penghitungan angka
    function animateValue(element, start, end, duration, isPercentage = false) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const value = start + progress * (end - start);
            
            if (isPercentage) {
                element.innerHTML = value.toFixed(1) + '%';
            } else {
                element.innerHTML = value.toFixed(1);
            }
            
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }

    // Fungsi untuk memeriksa apakah elemen terlihat di viewport
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    // Fungsi utama untuk menginisialisasi animasi
    function initStatAnimation() {
        // Dapatkan semua elemen statistik
        const statNumbers = document.querySelectorAll('.stat-number');
        
        // Tetapkan nilai target untuk masing-masing statistik
        const targetValues = [20.9, 16.9, 7.2];
        const isPercentage = [false, false, true];
        
        // Tandai apakah animasi sudah dijalankan
        let animated = false;
        
        // Fungsi untuk memulai animasi jika elemen terlihat
        function checkAndAnimate() {
            // Periksa apakah elemen statistik pertama terlihat di viewport dan belum dianimasikan
            if (!animated && statNumbers.length > 0 && isElementInViewport(statNumbers[0])) {
                animated = true;
                
                // Animasikan setiap statistik
                statNumbers.forEach((element, index) => {
                    // Tambahkan kelas untuk animasi muncul
                    element.classList.add('animate-count');
                    
                    // Mulai animasi penghitungan
                    animateValue(element, 0, targetValues[index], 2000, isPercentage[index]);
                });
            }
        }
        
        // Periksa saat halaman dimuat
        checkAndAnimate();
        
        // Periksa saat halaman di-scroll
        window.addEventListener('scroll', checkAndAnimate);
    }

    // Jalankan setelah DOM sepenuhnya dimuat
    document.addEventListener('DOMContentLoaded', initStatAnimation);
</script>
@endsection