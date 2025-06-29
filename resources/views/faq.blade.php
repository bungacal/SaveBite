@extends('app')

@section('title', 'Save Bite - FAQs')

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
    
    /* Hero section */
    .hero-section {
        display: flex;
        align-items: center;
        padding: 40px;
        background-color: #f8f8f8;
        margin-bottom: 40px;
    }
    
    .hero-image {
        flex: 1;
        max-width: 60%;
        max-height: 100%;
        margin-left: 120px;
    }
    
    .hero-image img {
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .hero-content {
        flex: 1;
        padding: 0 40px;
    }
    
    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 90px;
        font-weight: normal;
        color: #c23d3d;
        margin-bottom: 40px;
        line-height: 1.2;
    }
    
    .h1 {
        color: #343333;
        font-size: 60 px;
        margin-bottom: 15px;
    }

    .h2 {
        color: #555;
        font-size: 60 px;
        margin-bottom: 15px;
    }
    
    /* FAQ section */
    .faq-section {
        max-width: 1400px;
        margin: 0 auto 60px;
        padding: 0 20px;
    }
    
    .faq-item {
        margin-bottom: 15px;
        border-radius: 8px;
        background-color: #f0f0f5;
        overflow: hidden;
    }
    
    .faq-question {
        padding: 20px;
        background-color: #f0f0f5;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 500;
        color: #444;
    }
    
    .faq-question:hover {
        background-color: #e8e8f0;
    }
    
    .faq-answer {
        padding: 0 20px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease, padding 0.3s ease;
    }
    
    .faq-item.active .faq-answer {
        padding: 0 20px 20px;
        max-height: 500px;
    }
    
    .faq-toggle {
        transition: transform 0.3s ease;
    }
    
    .faq-item.active .faq-toggle {
        transform: rotate(180deg);
    }
    
    /* Question form section */
    .question-section {
        max-width: 1400px;
        margin: 0 auto 60px;
        padding: 0 20px;
    }
    
    .question-title {
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
    }
    
    .question-form textarea {
        width: 100%;
        height: 120px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        resize: none;
        margin-bottom: 20px;
        font-size: 16px;
        transition: border-color 0.3s;
    }

    .question-form textarea:focus {
        outline: none;
        border-color: #c23d3d;
    }
    
    .submit-button {
        background-color: #c23d3d;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        float: right;
        transition: background-color 0.3s;
    }
    
    .submit-button:hover {
        background-color: #a33333;
    }

    .submit-button:disabled {
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
        clear: both;
    }

    /* Empty state for FAQs */
    .empty-faqs {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .empty-faqs h3 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .empty-faqs p {
        margin-bottom: 20px;
    }

    .empty-faqs i {
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
        .hero-section {
            flex-direction: column;
            text-align: center;
        }

        .hero-image {
            margin-left: 0;
            margin-bottom: 20px;
            max-width: 100%;
        }

        .hero-title {
            font-size: 50px;
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
            <a href="{{ route('faq') }}" class="active">FAQs</a>
            <a href="{{ route('contact') }}">Contact</a>
        </div>
        @auth
            <a href="{{ route('profile') }}" class="profile-btn">PROFILE</a>
        @else
            <a href="{{ route('login') }}" class="login-btn">LOG IN</a>
        @endauth
    </div>
</header>

<!-- Hero section with title and image -->
<section class="hero-section">
    <div class="hero-image">
        <img src="{{ asset('gambar/give.jpg') }}" alt="Volunteers distributing food">
    </div>
    <div class="hero-content">
        <h1 class="hero-title">Welcome to <br>our FAQ</br>page!</h1>
        <p class="h1">Here, we have compiled the most frequently asked questions<br> along with their answers to help you find information quickly.</br></p>
        <p class="h2">If you have any questions, you are also welcome to ask them <br>on this page.</br></p>
    </div>
</section>

<!-- FAQ accordion section -->
<section class="faq-section">
    @if(isset($faqs) && $faqs->count() > 0)
        @foreach($faqs as $faq)
        <div class="faq-item">
            <div class="faq-question">
                {{ $faq->question }}
                <span class="faq-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </span>
            </div>
            <div class="faq-answer">
                <p>{{ $faq->answer }}</p>
            </div>
        </div>
        @endforeach
    @else
        <!-- Default FAQs if no data from database -->
        <div class="faq-item">
            <div class="faq-question">
                How to donate on this Website?
                <span class="faq-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </span>
            </div>
            <div class="faq-answer">
                <p>You can donate food by clicking on the "Donate" button in the navigation menu. Follow the simple steps to list your surplus food for donation. Make sure to provide accurate details about the food, including quantity, type, and expiry dates.</p>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                Are There Any Restrictions on the Types of Food That Can Be Donated?
                <span class="faq-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </span>
            </div>
            <div class="faq-answer">
                <p>Yes, there are some restrictions on the food that can be donated. We accept non-perishable food items that are not expired, perishable items that are still fresh, and prepared foods that have been properly stored. We do not accept food that has been partially consumed, homemade items without proper ingredient labels, or any food that poses a health risk.</p>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                How do I know my donation is safe?
                <span class="faq-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </span>
            </div>
            <div class="faq-answer">
                <p>All food donations go through a verification process. We ensure that food is within safe consumption dates and meets our quality standards. Our platform tracks each donation and works with verified partners to maintain food safety throughout the distribution process.</p>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                How to Ensure That Donated Food Reaches the Right Recipients?
                <span class="faq-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </span>
            </div>
            <div class="faq-answer">
                <p>Our platform ensures that donated food reaches the right recipients through a verification process. Each food donation is tracked from the donor to the recipient. We work with verified partners like food banks, shelters, and community centers to ensure proper distribution. You can also track your donation through your account dashboard.</p>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                Terms and Conditions Apply
                <span class="faq-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </span>
            </div>
            <div class="faq-answer">
                <p>By using our platform, you agree to our Terms and Conditions. These include rules regarding food safety standards, donation processes, delivery, and liability limitations. Please review our full Terms and Conditions page for detailed information. All users must adhere to these guidelines to ensure safe and effective food sharing.</p>
            </div>
        </div>
    @endif
</section>

<!-- Question form section -->
<section class="question-section">
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

    <h2 class="question-title">Do you have any questions?</h2>
    <form class="question-form" action="{{ route('faq.question') }}" method="POST" id="questionForm">
        @csrf
        <textarea name="question" placeholder="Type your question here..." required>{{ old('question') }}</textarea>
        @error('question')
            <div class="error-message">{{ $message }}</div>
        @enderror
        
        <button type="submit" class="submit-button" id="submitQuestionBtn">
            <span id="submitQuestionText">Submit</span>
            <span id="submitQuestionLoading" style="display: none;">
                <i class="fas fa-spinner fa-spin"></i> Sending...
            </span>
        </button>
    </form>
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
    // JavaScript for FAQ accordion functionality
    document.addEventListener('DOMContentLoaded', function() {
        const faqItems = document.querySelectorAll('.faq-item');
        
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            
            question.addEventListener('click', () => {
                // Close all other items
                faqItems.forEach(otherItem => {
                    if (otherItem !== item && otherItem.classList.contains('active')) {
                        otherItem.classList.remove('active');
                    }
                });
                
                // Toggle current item
                item.classList.toggle('active');
            });
        });

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

    // Form submission with loading state
    document.getElementById('questionForm').addEventListener('submit', function() {
        const submitBtn = document.getElementById('submitQuestionBtn');
        const submitText = document.getElementById('submitQuestionText');
        const submitLoading = document.getElementById('submitQuestionLoading');
        
        submitBtn.disabled = true;
        submitText.style.display = 'none';
        submitLoading.style.display = 'inline';
    });
</script>
@endsection