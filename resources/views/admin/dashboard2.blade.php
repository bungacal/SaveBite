@extends('app')

@section('title', 'Save Bite - User Detail')

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
    
    .main-content {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
    }
    
    h1 {
        font-family: 'Playfair Display', serif;
        font-size: 42px;
        margin-bottom: 30px;
        color: #222;
        font-weight: bold;
    }
    
    .stats-container {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        flex: 1;
        padding: 20px;
        background-color: white;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    
    .stat-label {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 15px;
    }
    
    .stat-number {
        font-size: 60px;
        font-weight: bold;
        color: #b33;
    }
    
    .user-detail-container {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        margin-bottom: 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    
    .user-detail-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 8px;
    }
    
    .user-detail-table td {
        padding: 12px 10px;
        vertical-align: middle;
    }
    
    .label-cell {
        width: 150px;
        background-color: #888;
        color: white;
        font-weight: bold;
        margin-right: 50px;
        border-right: 8px solid white;
    }
    
    .actions {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
    
    .close-btn, .delete-btn {
        padding: 12px 30px;
        border: none;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }
    
    .close-btn {
        background-color: #b33;
    }
    
    .delete-btn {
        background-color: #b33;
    }
    
    .close-btn:hover, .delete-btn:hover {
        opacity: 0.9;
    }
    
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
            <a href="{{ route('admin.dashboard') }}" class="active">Dashboard</a>
            <a href="{{ route('admin.reviewA') }}">Review</a>
            <a href="{{ route('faqA') }}">FAQs</a>
            <a href="{{ route('browseA') }}">Browse</a>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">LOG OUT</button>
        </form>
    </div>
</header>

<!-- Main Content -->
<div class="main-content">
    <h1>{{ $user->name }}</h1>
    
    <!-- Statistics -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-label">Donate</div>
            <div class="stat-number">{{ isset($user->donations) ? $user->donations->count() : 0 }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Receive</div>
            <div class="stat-number">{{ isset($user->receivedDonations) ? $user->receivedDonations->count() : 0 }}</div>
        </div>
    </div>
    
    <!-- User Details -->
    <div class="user-detail-container">
        <table class="user-detail-table">
            <tr>
                <td class="label-cell">ID</td>
                <td>{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <td class="label-cell">Name</td>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <td class="label-cell">Email</td>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <td class="label-cell">Username</td>
                <td>{{ $user->username ?? 'Not provided' }}</td>
            </tr>
            <tr>
                <td class="label-cell">Contact</td>
                <td>{{ $user->phone ?? 'Not provided' }}</td>
            </tr>
            <tr>
                <td class="label-cell">Address</td>
                <td>{{ $user->address ?? 'Not provided' }}</td>
            </tr>
            <tr>
                <td class="label-cell">Province</td>
                <td>{{ $user->province ? ucfirst(str_replace('-', ' ', $user->province)) : 'Not provided' }}</td>
            </tr>
            <tr>
                <td class="label-cell">City</td>
                <td>{{ $user->city ? ucfirst(str_replace('-', ' ', $user->city)) : 'Not provided' }}</td>
            </tr>
            @if(isset($user->organization_name) && $user->organization_name)
            <tr>
                <td class="label-cell">Organization</td>
                <td>{{ $user->organization_name }}</td>
            </tr>
            @endif
            <tr>
                <td class="label-cell">Register As</td>
                <td>{{ ucfirst($user->register_as ?? 'Personal') }}</td>
            </tr>
            <tr>
                <td class="label-cell">Joined</td>
                <td>{{ $user->created_at->format('d F Y') }}</td>
            </tr>
        </table>
        
        <div class="actions">
            <a href="{{ route('admin.dashboard') }}" class="close-btn">Close</a>
            <form method="POST" action="{{ route('admin.users.delete', $user->id) }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete user {{ $user->name }}?')">Delete</button>
            </form>
        </div>
    </div>
</div>

<!-- Footer -->
<footer>
    <div class="footer-content">
        <div class="footer-logo">
            <a href="{{ route('admin.dashboard') }}" class="logo">
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
        Copyright © {{ date('Y') }} Hashtag Developer. All Rights Reserved
    </div>
</footer>
@endsection

@section('scripts')
<script>
    // Auto hide success messages
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.display = 'none';
            }, 5000);
        });
    });
</script>
@endsection