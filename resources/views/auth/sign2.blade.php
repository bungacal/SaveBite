@extends('app')

@section('title', 'Save Bite - Complete Registration')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Karla:wght@400;500;600;700&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap">
<style>
    /* Reset and base styles */
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
        
    /* Main content */
    .main-content {
        max-width: 800px;
        margin: 40px auto;
        padding: 0 20px;
    }
        
    .page-title {
        text-align: center;
        font-size: 42px;
        margin-bottom: 15px;
        font-weight: normal;
        font-family: 'Playfair Display', serif; 
        color: #4d4b4b;
    }
        
    .page-subtitle {
        text-align: center;
        margin-bottom: 40px;
        color: #666;
    }
        
    /* Registration form */
    .registration-form {
        background-color: #fff;
        border-radius: 10px;
        padding: 40px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
        
    .form-group {
        margin-bottom: 20px;
    }
        
    .form-label {
        display: block;
        margin-bottom: 10px;
        font-weight: 500;
    }
        
    .form-input, .form-select {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 25px;
        font-size: 16px;
        outline: none;
        transition: all 0.3s ease;
    }
        
    .form-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 16px;
    }
        
    .form-input:focus, .form-select:focus {
        border-color: #c23d3d;
        box-shadow: 0 4px 12px rgba(194, 61, 61, 0.15);
        transform: translateY(-2px);
    }
        
    .submit-button {
        width: 100%;
        background-color: #c23d3d;
        color: #fff;
        border: none;
        border-radius: 25px;
        padding: 15px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 20px;
    }
        
    .submit-button:hover {
        background-color: #a13232;
    }

    .submit-button:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    /* Character counter */
    .char-count {
        font-size: 12px;
        margin-top: 5px;
        display: block;
    }

    /* Error and success messages */
    .alert {
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        font-size: 14px;
    }
    
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
        
    /* Responsive design */
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
        
        .registration-form {
            padding: 30px 20px;
        }
        
        .page-title {
            font-size: 32px;
        }
    }
    
    @media (max-width: 480px) {
        .top-bar {
            flex-direction: column;
            gap: 10px;
            padding: 10px;
        }
        
        .registration-form {
            padding: 25px 15px;
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
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('gambar\save bite.png') }}" alt="Save Bite Logo">
            <h1>Save Bite</h1>
        </a>
        <div class="nav-links">
            <a href="{{ route('home') }}">About Us</a>
            <a href="{{ route('review') }}">Review</a>
            <a href="{{ route('faq') }}">FAQs</a>
            <a href="{{ route('contact') }}">Contact</a>
        </div>
        <a href="{{ route('login') }}" class="login-btn">LOG IN</a>
    </div>
</header>

<!-- Main content -->
<main class="main-content">
    <h1 class="page-title">Complete your Registration</h1>
    <p class="page-subtitle">Those who receive kindness today may become the ones who spread it tomorrow.</p>
    
    <div class="registration-form">
        <!-- Error and success messages -->
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form id="register-form" action="{{ route('sign2.post') }}" method="POST"> 
            @csrf
            <div class="form-group">
                <label for="register" class="form-label">Register as</label>
                <select id="register" name="register" class="form-select" required>
                    <option value="" disabled selected>Select an option</option>
                    <option value="personal" {{ old('register') == 'personal' ? 'selected' : '' }}>Personal</option>
                    <option value="organization" {{ old('register') == 'organization' ? 'selected' : '' }}>Organization</option>
                    <option value="company" {{ old('register') == 'company' ? 'selected' : '' }}>Company</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="province" class="form-label">Province</label>
                <select id="province" name="province" class="form-select" required>
                    <option value="" disabled selected>Select province</option>
                    <option value="east-java" {{ old('province') == 'east-java' ? 'selected' : '' }}>East Java</option>
                    <option value="west-java" {{ old('province') == 'west-java' ? 'selected' : '' }}>West Java</option>
                    <option value="central-java" {{ old('province') == 'central-java' ? 'selected' : '' }}>Central Java</option>
                    <option value="jakarta" {{ old('province') == 'jakarta' ? 'selected' : '' }}>Jakarta</option>
                    <option value="bali" {{ old('province') == 'bali' ? 'selected' : '' }}>Bali</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="city" class="form-label">City</label>
                <select id="city" name="city" class="form-select" required>
                    <option value="" disabled selected>Select city</option>
                    <!-- Options will be populated dynamically via JavaScript -->
                </select>
            </div>
            
            <div class="form-group">
                <label for="subdistrict" class="form-label">Subdistrict</label>
                <select id="subdistrict" name="subdistrict" class="form-select" required>
                    <option value="" disabled selected>Select subdistrict</option>
                    <!-- Options will be populated dynamically via JavaScript -->
                </select>
            </div>
            
            <div class="form-group">
                <label for="postcode" class="form-label">Post Code</label>
                <input type="text" id="postcode" name="postcode" class="form-input" 
                       placeholder="Enter your post code" value="{{ old('postcode') }}" 
                       required pattern="[0-9]{5}" maxlength="5">
            </div>
            
            <div class="form-group">
                <label for="address" class="form-label">Address</label>
                <input type="text" id="address" name="address" class="form-input" 
                       placeholder="Enter your detailed address" value="{{ old('address') }}" 
                       required minlength="10" maxlength="500">
            </div>
            
            <button type="submit" class="submit-button">Complete Registration</button>
        </form>
    </div>
</main>
@endsection

@section('footer')
<!-- Footer -->
<footer>
    <div class="footer-content">
        <div class="footer-logo">
            <a href="{{ route('home') }}" class="logo">
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
                <li><a href="{{ route('home') }}">About Us</a></li>
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
    // Dynamic city selection based on province
    document.getElementById('province').addEventListener('change', function() {
        const citySelect = document.getElementById('city');
        const selectedProvince = this.value;
        
        // Clear existing options
        citySelect.innerHTML = '<option value="" disabled selected>Select city</option>';
        
        // Define cities for each province
        const cities = {
            'east-java': [
                { value: 'surabaya', text: 'Surabaya' },
                { value: 'malang', text: 'Malang' },
                { value: 'sidoarjo', text: 'Sidoarjo' },
                { value: 'gresik', text: 'Gresik' },
                { value: 'mojokerto', text: 'Mojokerto' },
                { value: 'pasuruan', text: 'Pasuruan' }
            ],
            'west-java': [
                { value: 'bandung', text: 'Bandung' },
                { value: 'bogor', text: 'Bogor' },
                { value: 'bekasi', text: 'Bekasi' },
                { value: 'depok', text: 'Depok' },
                { value: 'tangerang', text: 'Tangerang' }
            ],
            'central-java': [
                { value: 'semarang', text: 'Semarang' },
                { value: 'yogyakarta', text: 'Yogyakarta' },
                { value: 'solo', text: 'Solo' },
                { value: 'magelang', text: 'Magelang' }
            ],
            'jakarta': [
                { value: 'jakarta-pusat', text: 'Jakarta Pusat' },
                { value: 'jakarta-utara', text: 'Jakarta Utara' },
                { value: 'jakarta-selatan', text: 'Jakarta Selatan' },
                { value: 'jakarta-barat', text: 'Jakarta Barat' },
                { value: 'jakarta-timur', text: 'Jakarta Timur' }
            ],
            'bali': [
                { value: 'denpasar', text: 'Denpasar' },
                { value: 'ubud', text: 'Ubud' },
                { value: 'sanur', text: 'Sanur' },
                { value: 'canggu', text: 'Canggu' }
            ]
        };
        
        // Populate cities based on selected province
        if (cities[selectedProvince]) {
            cities[selectedProvince].forEach(city => {
                const option = document.createElement('option');
                option.value = city.value;
                option.textContent = city.text;
                citySelect.appendChild(option);
            });
        }
        
        // Reset subdistrict when province changes
        document.getElementById('subdistrict').innerHTML = '<option value="" disabled selected>Select subdistrict</option>';
    });
    
    // Dynamic subdistrict selection based on city
    document.getElementById('city').addEventListener('change', function() {
        const subdistrictSelect = document.getElementById('subdistrict');
        const selectedCity = this.value;
        
        // Clear existing options
        subdistrictSelect.innerHTML = '<option value="" disabled selected>Select subdistrict</option>';
        
        // Define subdistricts for each city (example for Surabaya)
        const subdistricts = {
            'surabaya': [
                { value: 'tegalsari', text: 'Tegalsari' },
                { value: 'gubeng', text: 'Gubeng' },
                { value: 'rungkut', text: 'Rungkut' },
                { value: 'wonokromo', text: 'Wonokromo' },
                { value: 'bulak', text: 'Bulak' },
                { value: 'kenjeran', text: 'Kenjeran' }
            ],
            'malang': [
                { value: 'klojen', text: 'Klojen' },
                { value: 'blimbing', text: 'Blimbing' },
                { value: 'lowokwaru', text: 'Lowokwaru' },
                { value: 'sukun', text: 'Sukun' }
            ],
            'bandung': [
                { value: 'bandung-wetan', text: 'Bandung Wetan' },
                { value: 'coblong', text: 'Coblong' },
                { value: 'sumur-bandung', text: 'Sumur Bandung' }
            ],
            'jakarta-pusat': [
                { value: 'menteng', text: 'Menteng' },
                { value: 'tanah-abang', text: 'Tanah Abang' },
                { value: 'gambir', text: 'Gambir' }
            ]
            // Add more cities and their subdistricts as needed
        };
        
        // Populate subdistricts based on selected city
        if (subdistricts[selectedCity]) {
            subdistricts[selectedCity].forEach(subdistrict => {
                const option = document.createElement('option');
                option.value = subdistrict.value;
                option.textContent = subdistrict.text;
                subdistrictSelect.appendChild(option);
            });
        }
    });
    
    // Form validation
    document.getElementById('register-form').addEventListener('submit', function(event) {
        const postcode = document.getElementById('postcode').value;
        const address = document.getElementById('address').value;
        
        // Validate postcode format (5 digits)
        if (!/^\d{5}$/.test(postcode)) {
            event.preventDefault();
            alert('Post code must be exactly 5 digits');
            return;
        }

        // Validate address length
        if (address.trim().length < 10) {
            event.preventDefault();
            alert('Please provide a more detailed address (minimum 10 characters)');
            return;
        }

        // Check if all required fields are filled
        const requiredFields = ['register', 'province', 'city', 'subdistrict', 'postcode', 'address'];
        for (let field of requiredFields) {
            const element = document.getElementById(field);
            if (!element.value.trim()) {
                event.preventDefault();
                alert(`Please fill in the ${field.replace('-', ' ')} field`);
                element.focus();
                return;
            }
        }
        
        // Show loading state
        const submitButton = event.target.querySelector('.submit-button');
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Account...';
        
        // Form will submit normally if all validation passed
    });

    // Real-time validation feedback
    document.getElementById('postcode').addEventListener('input', function() {
        const value = this.value;
        if (value.length > 0) {
            if (!/^\d+$/.test(value)) {
                this.style.borderColor = '#dc3545';
                this.title = 'Only numbers are allowed';
            } else if (value.length === 5) {
                this.style.borderColor = '#28a745';
                this.title = 'Valid postcode';
            } else {
                this.style.borderColor = '#ffc107';
                this.title = `Enter ${5 - value.length} more digit${5 - value.length !== 1 ? 's' : ''}`;
            }
        } else {
            this.style.borderColor = '#ddd';
            this.title = '';
        }
    });

    // Character counter for address
    const addressField = document.getElementById('address');
    const charCount = document.createElement('small');
    charCount.className = 'form-text char-count';
    charCount.style.color = '#666';
    addressField.parentNode.appendChild(charCount);

    function updateCharCount() {
        const length = addressField.value.length;
        charCount.textContent = `${length} characters (minimum 10 required)`;
        
        if (length < 10) {
            charCount.style.color = '#dc3545';
            addressField.style.borderColor = '#dc3545';
        } else if (length >= 10 && length <= 500) {
            charCount.style.color = '#28a745';
            addressField.style.borderColor = '#28a745';
        } else {
            charCount.style.color = '#ffc107';
            addressField.style.borderColor = '#ffc107';
        }
    }

    addressField.addEventListener('input', updateCharCount);
    addressField.addEventListener('blur', updateCharCount);

    // Initialize character count
    updateCharCount();

    // Add smooth transitions for form elements
    document.querySelectorAll('.form-input, .form-select').forEach(element => {
        element.addEventListener('focus', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 4px 12px rgba(194, 61, 61, 0.15)';
        });

        element.addEventListener('blur', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
        });
    });

    // Restore form values on page load (in case of validation errors)
    document.addEventListener('DOMContentLoaded', function() {
        const oldProvince = '{{ old("province") }}';
        const oldCity = '{{ old("city") }}';
        const oldSubdistrict = '{{ old("subdistrict") }}';
        const oldRegister = '{{ old("register") }}';

        if (oldProvince) {
            // Trigger province change to populate cities
            document.getElementById('province').dispatchEvent(new Event('change'));
            
            setTimeout(() => {
                if (oldCity) {
                    document.getElementById('city').value = oldCity;
                    document.getElementById('city').dispatchEvent(new Event('change'));
                    
                    setTimeout(() => {
                        if (oldSubdistrict) {
                            document.getElementById('subdistrict').value = oldSubdistrict;
                        }
                    }, 100);
                }
            }, 100);
        }
    });
</script>
@endsection