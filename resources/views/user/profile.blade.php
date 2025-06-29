@extends('app')

@section('title', 'Save Bite - Profile')

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

    .profile-btn {
        border: 2px solid #444;
        border-radius: 20px;
        padding: 8px 20px;
        font-weight: bold;
        transition: 0.3s;
    }

    .profile-btn:hover {
        background-color: #444;
        color: white;
    }

    .profile-btn.active {
        background-color: #444;  
        color: #f5f5f5;             
        cursor: default;
        pointer-events: none;    
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }
    
    /* Profile Section */
    .profile-layout {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }
    
    .greeting-section {
        margin-bottom: 20px;
    }
    
    .greeting {
        font-family: 'Playfair Display', serif;
        font-size: 36px;
        color: #333;
        margin-bottom: 5px;
    }
    
    .edit-info {
        color: #666;
        cursor: pointer;
        font-size: 15px;
    }
    
    /* Personal Info Section */
    .personal-info-header {
        color: #b22;
        font-weight: 600;
        font-size: 18px;
        margin-bottom: 20px;
    }
    
    .personal-info-form {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 30px;
    }
    
    /* Form Styles */
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-label {
        display: block;
        font-weight: 600;
        margin-bottom: 10px;
        color: #333;
    }
    
    .form-input-container {
        position: relative;
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
    
    .edit-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #aaa;
        cursor: pointer;
    }
    
    .edit-icon:hover {
        color: #b22;
    }
    
    .save-btn {
        background-color: #b22;
        color: white;
        border: none;
        padding: 12px 40px;
        border-radius: 25px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
        display: block;
        width: 30%;
        text-align: center;
        margin: 0 auto;
    }
    
    .save-btn:hover {
        background-color: #911;
    }

    /* Success and Error messages */
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

    /* Log Out */
    .logout-btn {
        background-color: #444;
        color: white;
        border: none;
        padding: 12px 40px;
        border-radius: 25px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
        display: block;
        width: 29%;
        text-align: center;
        margin: 30px auto 0; 
    }

    .logout-btn:hover {
        background-color: #333;
    }

    .button-container {
        margin-top: 20px;
    }
    
    /* Responsive adjustments */
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
        
        .greeting {
            font-size: 28px;
        }

        .save-btn, .logout-btn {
            width: 80%;
        }
    }
    
    @media (max-width: 480px) {
        .top-bar {
            flex-direction: column;
            gap: 10px;
            padding: 10px;
        }
        
        .personal-info-form {
            padding: 20px 15px;
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
        <a href="{{ route('profile') }}" class="profile-btn active">PROFILE</a>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="profile-layout">
        <!-- Greeting Section -->
        <div class="greeting-section">
            <h1 class="greeting" id="userName">Hello, {{ $user->name }}!</h1>
            <p class="edit-info">Edit your personal info?</p>
        </div>
        
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

        @if($errors->any())
            <div class="alert alert-danger">
                <div>
                    <i class="fas fa-exclamation-circle"></i>
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
                <button class="close-message" onclick="this.parentElement.style.display='none'">×</button>
            </div>
        @endif
        
        <!-- Personal Info Section -->
        <div class="personal-info-section">
            <h2 class="personal-info-header">Personal Info</h2>
            
            <div class="personal-info-form">
                <form id="profileForm" action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <div class="form-input-container">
                            <input type="text" class="form-input" name="name" id="nameInput" 
                                   value="{{ old('name', $user->name) }}" required>
                            <i class="fas fa-pencil-alt edit-icon"></i>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <div class="form-input-container">
                            <input type="email" class="form-input" name="email" id="emailInput" 
                                   value="{{ old('email', $user->email) }}" required>
                            <i class="fas fa-pencil-alt edit-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Username</label>
                        <div class="form-input-container">
                            <input type="text" class="form-input" name="username" id="usernameInput" 
                                   value="{{ old('username', $user->username) }}" required>
                            <i class="fas fa-pencil-alt edit-icon"></i>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <div class="form-input-container">
                            <input type="tel" class="form-input" name="phone" id="phoneInput" 
                                   value="{{ old('phone', $user->phone) }}">
                            <i class="fas fa-pencil-alt edit-icon"></i>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Address</label>
                        <div class="form-input-container">
                            <input type="text" class="form-input" name="address" id="addressInput" 
                                   value="{{ old('address', $user->address) }}">
                            <i class="fas fa-pencil-alt edit-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Province</label>
                        <div class="form-input-container">
                            <input type="text" class="form-input" name="province" id="provinceInput" 
                                   value="{{ old('province', ucfirst(str_replace('-', ' ', $user->province))) }}" readonly>
                            <i class="fas fa-map-marker-alt edit-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">City</label>
                        <div class="form-input-container">
                            <input type="text" class="form-input" name="city" id="cityInput" 
                                   value="{{ old('city', ucfirst(str_replace('-', ' ', $user->city))) }}" readonly>
                            <i class="fas fa-map-marker-alt edit-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Register Type</label>
                        <div class="form-input-container">
                            <input type="text" class="form-input" id="registerTypeInput" 
                                   value="{{ ucfirst($user->register_as ?? 'Personal') }}" readonly>
                            <i class="fas fa-user edit-icon"></i>
                        </div>
                    </div>
                    
                    <div class="button-container">
                        <button type="submit" class="save-btn">Save Changes</button>
                    </div>
                </form>
            </div>

            <!-- Logout Button -->
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn" 
                        onclick="return confirm('Are you sure you want to logout?')">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
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
<script>
    // Add click event to edit icons
    const editIcons = document.querySelectorAll('.edit-icon');
    editIcons.forEach(icon => {
        icon.addEventListener('click', function() {
            // Get the input element
            const input = this.previousElementSibling;
            // Focus on the input
            input.focus();
            // Optional: Select all text in the input
            input.select();
        });
    });

    // Update greeting when name changes
    const nameInput = document.getElementById('nameInput');
    const userNameElement = document.getElementById('userName');
    
    nameInput.addEventListener('input', function() {
        userNameElement.textContent = `Hello, ${this.value}!`;
    });

    // Form validation
    document.getElementById('profileForm').addEventListener('submit', function(e) {
        const name = document.getElementById('nameInput').value.trim();
        const email = document.getElementById('emailInput').value.trim();
        const username = document.getElementById('usernameInput').value.trim();
        
        if (!name || !email || !username) {
            e.preventDefault();
            alert('Name, email, and username are required fields.');
            return false;
        }
        
        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            e.preventDefault();
            alert('Please enter a valid email address.');
            return false;
        }
        
        return true;
    });
</script>
@endsection