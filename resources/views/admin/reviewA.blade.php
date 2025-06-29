@extends('app')

@section('title', 'Admin Reviews - Save Bite')

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
    .stories-grid {
        padding: 0 30px 50px;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        min-height: 600px;
    }

    .story {
        border-radius: 5px;
        overflow: hidden;
        margin-bottom: 30px;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: transform 0.2s;
    }

    .story:hover {
        transform: translateY(-2px);
    }

    .story img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        display: block;
    }

    .story-content-wrapper {
        padding: 15px;
    }

    .story-date {
        font-size: 14px;
        color: #666;
    }

    .story-author {
        font-size: 14px;
        color: #666;
        margin-top: 5px;
    }

    .story-content {
        font-size: 14px;
        color: #444;
        margin-top: 10px;
        line-height: 1.5;
        text-align: justify;
    }

    /* Admin Actions */
    .story-actions {
        padding: 10px 15px;
        border-top: 1px solid #eee;
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }

    .btn-approve, .btn-reject, .btn-delete {
        padding: 5px 12px;
        border: none;
        border-radius: 15px;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-approve {
        background-color: #28a745;
        color: white;
    }

    .btn-approve:hover {
        background-color: #218838;
    }

    .btn-reject {
        background-color: #ffc107;
        color: #212529;
    }

    .btn-reject:hover {
        background-color: #e0a800;
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background-color: #c82333;
    }

    .status-badge {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: bold;
        margin-left: 10px;
    }

    .status-approved {
        background-color: #d4edda;
        color: #155724;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-rejected {
        background-color: #f8d7da;
        color: #721c24;
    }

    /* Floating Plus Button */
    .floating-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
    }

    .floating-btn button {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: #b02a37;
        color: white;
        border: none;
        font-size: 24px;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .floating-btn button:hover {
        background-color: #9a1c29;
        transform: scale(1.05);
    }       

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 2000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        overflow-y: auto;
    }

    .modal-content {
        background-color: white;
        margin: 5% auto;
        padding: 30px;
        border-radius: 8px;
        width: 90%;
        max-width: 600px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    .close-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .modal h2 {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        margin-bottom: 20px;
        text-align: center;
    }

    /* Form Styles */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 25px;
        font-size: 16px;
    }

    .upload-btn {
        display: inline-block;
        background-color: #b02a37;
        color: white;
        padding: 10px 20px;
        border-radius: 25px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .upload-btn input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .submit-btn {
        background-color: #b02a37;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 25px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        float: right;
        transition: background-color 0.3s;
    }

    .submit-btn:hover {
        background-color: #9a1c29;
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

    /* Filter Section */
    .filter-section {
        padding: 20px 30px;
        background: white;
        margin-bottom: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .filter-controls {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .filter-controls select {
        padding: 8px 15px;
        border: 1px solid #ddd;
        border-radius: 20px;
        background: white;
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
            <a href="{{ route('admin.reviewA') }}" class="active">Review</a>
            <a href="{{ route('faqA') }}">FAQs</a>
            <a href="{{ route('browseA') }}">Browse</a>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">LOG OUT</button>
        </form>
    </div>
</header>

<!-- Hero Section -->
<section class="hero">
    <h1>They Call It Kindness in Action</h1>
    <h2>We Call It Save Bite</h2>
    <p class="tagline">Because every kindness matters. Here's what they say!</p>
</section>

<!-- Filter Section -->
<div class="filter-section">
    <div class="filter-controls">
        <label for="status-filter">Filter by Status:</label>
        <select id="status-filter" onchange="filterReviews()">
            <option value="all">All Reviews</option>
            <option value="approved">Approved</option>
            <option value="pending">Pending</option>
            <option value="rejected">Rejected</option>
        </select>
        
        <label for="role-filter">Filter by Role:</label>
        <select id="role-filter" onchange="filterReviews()">
            <option value="all">All Roles</option>
            <option value="Food Donor">Food Donor</option>
            <option value="Food Receiver">Food Receiver</option>
        </select>
    </div>
</div>

<!-- Stories Grid -->
<div class="stories-grid">
    @forelse($reviews as $review)
    <div class="story" data-status="{{ $review->is_approved ? 'approved' : 'pending' }}" data-role="{{ $review->reviewing_as }}">
        @if($review->reviewer_photo)
            <img src="{{ Storage::url($review->reviewer_photo) }}" alt="Reviewer Photo">
        @else
            <img src="{{ asset('images/default-reviewer.jpg') }}" alt="Default Reviewer Photo">
        @endif
        
        <div class="story-content-wrapper">
            <div class="story-date">{{ $review->submission_date->format('F j, Y') }}</div>
            <div class="story-author">
                {{ $review->name }} | {{ $review->reviewing_as }}
                <span class="status-badge status-{{ $review->is_approved ? 'approved' : 'pending' }}">
                    {{ $review->is_approved ? 'Approved' : 'Pending' }}
                </span>
            </div>
            <p class="story-content">{{ Str::limit($review->letter, 200) }}</p>
        </div>
        
        <div class="story-actions">
            @if(!$review->is_approved)
                <form action="{{ route('admin.reviewA.approve', $review->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn-approve">
                        <i class="fas fa-check"></i> Approve
                    </button>
                </form>
            @endif
            
            <form action="{{ route('admin.reviewA.destroy', $review->id) }}" method="POST" style="display: inline;" 
                onsubmit="return confirm('Are you sure you want to delete this review?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-4 text-center py-8">
        <p class="text-gray-500 text-lg">No reviews found.</p>
    </div>
    @endforelse
</div>

<!-- Floating Plus Button -->
<div class="floating-btn">
    <button id="open-form-btn"><i class="fas fa-plus"></i></button>
</div>

<!-- Review Form Modal -->
<div id="review-form-modal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Add New Review</h2>
    
        <form action="{{ route('admin.reviewA.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="reviewer-name">Reviewer Name</label>
                <input type="text" id="reviewer-name" name="name" placeholder="Enter reviewer name" required>
            </div>

            <div class="form-group">
                <label for="reviewer-photo">Reviewer Photo</label>
                <div class="upload-btn">
                    <i class="fas fa-upload"></i> Upload
                    <input type="file" id="reviewer-photo" name="reviewer_photo" accept="image/*">
                </div>
            </div>

            <div class="form-group">
                <label for="reviewing-as">Reviewing As</label>
                <select id="reviewing-as" name="reviewing_as" required>
                    <option value="" disabled selected>Select role</option>
                    <option value="Food Donor">Food Donor</option>
                    <option value="Food Receiver">Food Receiver</option>
                </select>
            </div>

            <div class="form-group">
                <label for="submission-date">Submission Date</label>
                <input type="date" id="submission-date" name="submission_date" value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label for="reviewer-letter">Review Letter</label>
                <textarea id="reviewer-letter" name="letter" rows="5" placeholder="Share the experience here..." required></textarea>
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="is_approved" value="1" checked> Auto-approve this review
                </label>
            </div>

            <button type="submit" class="submit-btn">Submit</button>
        </form>
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
                <li><a href="{{ route('dashboard') }}">Home</a></li>
                <li><a href="{{ route('nearme') }}">Near Me</a></li>
                <li><a href="{{ route('browse') }}">Browse Food</a></li>
                <li><a href="{{ route('donate') }}">Donate</a></li>
                <li><a href="{{ route('faq') }}">FAQs</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
                <li><a href="{{ route('review') }}">Review</a></li>
            </ul>
        </div>
        
        <div class="footer-links">
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
// JavaScript for modal functionality
document.addEventListener('DOMContentLoaded', function() {
    const openBtn = document.getElementById('open-form-btn');
    const modal = document.getElementById('review-form-modal');
    const closeBtn = document.querySelector('.close-btn');

    // Open modal when plus button is clicked
    openBtn.addEventListener('click', function() {
        modal.style.display = 'block';
    });

    // Close modal when X is clicked
    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    // Close modal when clicking outside the modal content
    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });
});

// Filter functionality
function filterReviews() {
    const statusFilter = document.getElementById('status-filter').value;
    const roleFilter = document.getElementById('role-filter').value;
    const stories = document.querySelectorAll('.story');
    
    stories.forEach(story => {
        const status = story.getAttribute('data-status');
        const role = story.getAttribute('data-role');
        
        let showStory = true;
        
        if (statusFilter !== 'all' && status !== statusFilter) {
            showStory = false;
        }
        
        if (roleFilter !== 'all' && role !== roleFilter) {
            showStory = false;
        }
        
        story.style.display = showStory ? 'block' : 'none';
    });
}

// Show success/error messages
@if(session('success'))
    alert('{{ session('success') }}');
@endif

@if(session('error'))
    alert('{{ session('error') }}');
@endif
</script>
@endsection