@extends('app')

@section('title', 'Save Bite - Admin Dashboard')

@section('styles')
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

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }
    
    .main-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .hero {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: 40px;
        color: #333;
        margin-bottom: 15px;
    }
    
    .hero p {
        color: #555;
        margin-bottom: 30px;
    }
    
    .stats-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 30px;
        margin-bottom: 40px;
    }
    
    .stat-card {
        background-color: #dedbdb;
        border-radius: 20px;
        padding: 30px;
        text-align: center;
        min-width: 250px;
    }
    
    .stat-title {
        font-size: 20px;
        font-weight: bolder;
        color: #555;
        margin-bottom: 20px;
    }
    
    .stat-value {
        font-size: 50px;
        font-weight: bolder;
        color: #b33;
    }
    
    .table-container {
        background-color: white;
        border-radius: 5px;
        padding: 20px;
        margin-bottom: 40px;
    }
    
    .table-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    
    .show-entries {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .entries-select {
        padding: 5px 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }
    
    .search-box {
        padding: 5px 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
        width: 200px;
    }
    
    .user-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .user-table th {
        padding: 15px;
        text-align: left;
        background-color: #b33;
        color: white;
    }
    
    .user-table td {
        padding: 15px;
        border-top: 1px solid #ddd;
    }
    
    .detail-btn {
        background-color: #b33;
        color: white;
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .eye-icon {
        width: 16px;
        height: 10px;
        border: 2px solid white;
        border-radius: 75% 75% 0 0;
        position: relative;
        transform: rotate(180deg);
    }
    
    .eye-icon:before {
        content: '';
        position: absolute;
        width: 6px;
        height: 6px;
        background: white;
        border-radius: 50%;
        top: 2px;
        left: 3px;
    }
    
    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }
    
    .pagination-item {
        padding: 5px 10px;
        border: 1px solid #ddd;
        border-radius: 3px;
        cursor: pointer;
    }
    
    .pagination-item.active {
        background-color: #f0f0f0;
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
    @if(session('success'))
        <div id="deletion-notification" style="background-color: #4CAF50; color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px; text-align: center;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Hero Section -->
    <div class="hero">
        <h1>A Place to Share</h1>
        <p>We make a living from what we get, but we make a life from what we give.</p>
    </div>
    
    <!-- Statistics -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-title">NUMBER OF DONORS</div>
            <div class="stat-value">{{ $donorsCount ?? '1000' }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-title">NUMBER OF RECEIVER</div>
            <div class="stat-value">{{ $receiversCount ?? '1500' }}</div>
        </div>
    </div>
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-title">NUMBER OF FOOD DISTRIBUTED</div>
            <div class="stat-value">{{ $foodDistributedCount ?? '2420' }}</div>
        </div>
    </div>
    
    <!-- User Table -->
    <div class="table-container">
        <div class="table-header">
            <div class="show-entries">
                <span>Show</span>
                <select class="entries-select" id="entriesSelect">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span>Entries</span>
            </div>
            <div>
                <span>USER LIST</span>
            </div>
            <div>
                <input type="text" class="search-box" placeholder="Search" id="searchBox">
            </div>
        </div>
        
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->formatted_phone }}</td>
                    <td>{{ $user->formatted_address }}</td>
                    <td>
                        <button class="detail-btn" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}">
                            <div class="eye-icon"></div>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px;">
                        @if(request('search'))
                            No users found matching "{{ request('search') }}"
                        @else
                            No users found
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
            @if(isset($users) && method_exists($users, 'links'))
                <div style="margin-top: 20px;">
                    {{ $users->appends(request()->query())->links() }}
                </div>
            @endif
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
    document.addEventListener('DOMContentLoaded', function() {
        // Get all detail buttons with eye icons
        const detailButtons = document.querySelectorAll('.detail-btn');

        // Add click event listener to each button
        detailButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');
                const userName = this.getAttribute('data-user-name');
        
                // Redirect to the user detail page with user ID as a parameter
                window.location.href = `{{ url('admin/users') }}/${userId}`;
            });
        });

        // Hide success notification after 5 seconds
        const notification = document.getElementById('deletion-notification');
        if (notification) {
            setTimeout(function() {
                notification.style.display = 'none';
            }, 5000);
        }

        // Search functionality with debounce
        const searchBox = document.getElementById('searchBox');
        let searchTimeout;

        searchBox.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                document.getElementById('filterForm').submit();
            }, 500); // Wait 500ms after user stops typing
        });

        // Real-time statistics update (optional)
        function updateStatistics() {
            fetch('{{ route('admin.statistics') }}')
                .then(response => response.json())
                .then(data => {
                    // Update statistics if elements exist
                    const donorsElement = document.querySelector('.stat-value:nth-child(1)');
                    const receiversElement = document.querySelector('.stat-value:nth-child(2)');
                    const foodElement = document.querySelector('.stat-value:nth-child(3)');
                    
                    if (donorsElement) donorsElement.textContent = data.donors_count;
                    if (receiversElement) receiversElement.textContent = data.receivers_count;
                    if (foodElement) foodElement.textContent = data.food_distributed_count;
                })
                .catch(error => console.log('Error updating statistics:', error));
        }

        // Update statistics every 30 seconds (optional)
        setInterval(updateStatistics, 30000);
    });
</script>
@endsection