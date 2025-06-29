<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Save Bite - A Place to Share</title>
    
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
            cursor: pointer;
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
            border: none;
        }

        .btn-primary {
            background-color: rgb(156, 44, 44);
            color: white;
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

        /* Empty state styling */
        .no-reviews {
            text-align: center;
            padding: 40px 20px;
            color: #666;
        }

        .no-reviews i {
            font-size: 48px;
            color: #ccc;
            margin-bottom: 20px;
        }

        .no-reviews h3 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            margin-bottom: 10px;
            color: #555;
        }

        .no-reviews p {
            font-size: 16px;
            max-width: 400px;
            margin: 0 auto;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 30px;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            text-align: center;
            position: relative;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            right: 15px;
            top: 10px;
            cursor: pointer;
        }

        .close:hover {
            color: black;
        }

        .modal h2 {
            color: #b22;
            margin-bottom: 20px;
            font-family: 'Playfair Display', serif;
        }

        .modal p {
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .modal-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .modal-btn {
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            transition: 0.3s;
        }

        .modal-btn-primary {
            background-color: #b22;
            color: white;
        }

        .modal-btn-primary:hover {
            background-color: #a11;
        }

        .modal-btn-secondary {
            background-color: #f5f5f5;
            color: #333;
        }

        .modal-btn-secondary:hover {
            background-color: #eee;
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

        .footer-title {
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
</head>
<body>
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
                <img src="{{ asset('gambar/save bite.png') }}" alt="Save Bite Logo">
                <h1>Save Bite</h1>
            </a>
            <div class="nav-links">
                <a href="#about" class="active">About Us</a>
                <a href="#" onclick="showLoginModal()">Review</a>
                <a href="#" onclick="showLoginModal()">FAQs</a>
                <a href="#" onclick="showLoginModal()">Contact</a>
            </div>
            <a href="{{ route('login') }}" class="login-btn">LOG IN</a>
        </div>
    </header>

    <!-- Hero section -->
    <section class="hero" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('gambar/These Volunteer.jpg') }}');">
        <div class="hero-content">
            <h1>A Place to Share</h1>
            <p>We make a living from what we get, but we make a life from what we give.</p>
            <div class="cta-buttons">
                <button class="btn btn-primary" onclick="showLoginModal()">Donate</button>
                <button class="btn btn-secondary" onclick="showLoginModal()">Browse Food</button>
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
    <section class="about-section" id="about">
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

    <!-- Testimonials Section - UPDATED dengan Dynamic Reviews -->
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
                    <!-- Fallback jika belum ada review yang disetujui -->
                    <div class="no-reviews">
                        <i class="fas fa-comments"></i>
                        <h3>Coming Soon</h3>
                        <p>We're gathering amazing stories from our community. Check back soon to see how Save Bite is making a difference!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Login Required Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2><i class="fas fa-lock"></i> Login Required</h2>
            <p>To access this feature and join our community of food sharers, please log in to your account.</p>
            <p>Don't have an account yet? <strong>Join Save Bite today</strong> and help us fight hunger together!</p>
            <div class="modal-buttons">
                <button class="modal-btn modal-btn-primary" onclick="window.location.href='{{ route('login') }}'">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
                <button class="modal-btn modal-btn-secondary" onclick="window.location.href='{{ route('sign') }}'">
                    <i class="fas fa-user-plus"></i> Register
                </button>
            </div>
        </div>
    </div>

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
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#" onclick="showLoginModal()">Near Me</a></li>
                    <li><a href="#" onclick="showLoginModal()">Browse Food</a></li>
                    <li><a href="#" onclick="showLoginModal()">Donate</a></li>
                    <li><a href="#" onclick="showLoginModal()">FAQs</a></li>
                    <li><a href="#" onclick="showLoginModal()">Contact</a></li>
                    <li><a href="#" onclick="showLoginModal()">Review</a></li>
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
                        <img src="{{ asset('gambar/Voluntário.jpg') }}" alt="Instagram post">
                        <img src="{{ asset('gambar/saving uneaten food.jpg') }}" alt="Instagram post">
                        <img src="{{ asset('gambar/donate.jpg') }}" alt="Instagram post">
                        <img src="{{ asset('gambar/The Felix Project.jpg') }}" alt="Instagram post">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="copyright">
            Copyright © 2023 Hashtag Developer. All Rights Reserved
        </div>
    </footer>

    <script>
        // Modal functionality
        function showLoginModal() {
            document.getElementById('loginModal').style.display = 'block';
        }

        // Close modal when clicking X
        document.querySelector('.close').onclick = function() {
            document.getElementById('loginModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('loginModal');
            if (event.target === modal) {
                modal.style.display = 'none';
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
            const statNumbers = document.querySelectorAll('.stat-number');
            const targetValues = [20.9, 16.9, 7.2];
            const isPercentage = [false, false, true];
            
            let animated = false;
            
            function checkAndAnimate() {
                if (!animated && statNumbers.length > 0 && isElementInViewport(statNumbers[0])) {
                    animated = true;
                    
                    statNumbers.forEach((element, index) => {
                        element.classList.add('animate-count');
                        animateValue(element, 0, targetValues[index], 2000, isPercentage[index]);
                    });
                }
            }
            
            checkAndAnimate();
            window.addEventListener('scroll', checkAndAnimate);
        }

        // Jalankan setelah DOM sepenuhnya dimuat
        document.addEventListener('DOMContentLoaded', initStatAnimation);
    </script>
</body>
</html>