@extends('app')

@section('title', 'Admin FAQs - Save Bite')

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
        font-size: 20px;
        margin-bottom: 15px;
    }

    .h2 {
        color: #555;
        font-size: 20px;
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
        position: relative;
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

    /* Admin Actions */
    .faq-actions {
        position: absolute;
        top: 15px;
        right: 80px;
        display: flex;
        gap: 10px;
        opacity: 0;
        transition: opacity 0.2s;
    }

    .faq-item:hover .faq-actions {
        opacity: 1;
    }

    .btn-edit, .btn-delete {
        padding: 5px 10px;
        border: none;
        border-radius: 15px;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-edit {
        background-color: #ffc107;
        color: #212529;
    }

    .btn-edit:hover {
        background-color: #e0a800;
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background-color: #c82333;
    }
    
    /* Floating button */
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
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .floating-btn button:hover {
        background-color: #9a1c29;
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    }

    .floating-btn button:active {
        transform: scale(0.95);
    }

    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 2000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
        animation: fadeIn 0.3s;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        width: 90%;
        max-width: 600px;
        animation: slideIn 0.3s;
    }

    .close-modal {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        transition: color 0.3s;
    }

    .close-modal:hover {
        color: #333;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 25px;
        font-size: 16px;
    }

    .form-group textarea {
        min-height: 150px;
        resize: vertical;
        border-radius: 15px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 20px;
    }   

    .cancel-btn {
        background-color: #f0f0f0;
        color: #333;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .submit-modal-btn {
        background-color: #c23d3d;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .cancel-btn:hover {
        background-color: #e0e0e0;
    }

    .submit-modal-btn:hover {
        background-color: #a53535;
    }

    .no-faqs {
        text-align: center;
        padding: 40px 20px;
        color: #666;
        font-size: 18px;
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

    @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity: 1;}
    }

    @keyframes slideIn {
        from {transform: translateY(-50px); opacity: 0;}
        to {transform: translateY(0); opacity: 1;}
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
            <a href="{{ route('faqA') }}" class="active">FAQs</a>
            <a href="{{ route('browseA') }}">Browse</a>
        </div>
        <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">LOG OUT</button>
        </form>
    </div>
</header>

<!-- Hero section with title and image -->
<section class="hero-section">
    <div class="hero-image">
        <img src="{{ asset('gambar\give.jpg') }}" alt="Volunteers distributing food">
    </div>
    <div class="hero-content">
        <h1 class="hero-title">Welcome to <br>our FAQ</br>page!</h1>
        <p class="h1">Here, we have compiled the most frequently asked questions<br> along with their answers to help you find information quickly.</br></p>
        <p class="h2">If you have any questions, you are also welcome to ask them <br>on this page.</br></p>
    </div>
</section>

<!-- FAQ accordion section -->
<section class="faq-section">
    @php
        // Remove sample data - now using real data from controller
    @endphp

    @forelse($faqs as $faq)
    <div class="faq-item" data-faq-id="{{ $faq->id }}">
        <div class="faq-actions">
            <button class="btn-edit" onclick="editFaq({{ $faq->id }}, '{{ addslashes($faq->question) }}', '{{ addslashes($faq->answer) }}')">
                <i class="fas fa-edit"></i> Edit
            </button>
            <button class="btn-delete" onclick="deleteFaq({{ $faq->id }})">
                <i class="fas fa-trash"></i> Delete
            </button>
            @if($faq->is_active)
                <button class="btn-edit" onclick="toggleActive({{ $faq->id }})" style="background-color: #28a745;">
                    <i class="fas fa-eye"></i> Active
                </button>
            @else
                <button class="btn-edit" onclick="toggleActive({{ $faq->id }})" style="background-color: #6c757d;">
                    <i class="fas fa-eye-slash"></i> Inactive
                </button>
            @endif
        </div>
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
    @empty
    <div class="no-faqs">
        <p>No FAQs found. Click the + button to add your first FAQ.</p>
    </div>
    @endforelse
</section>

<!-- Floating Plus Button -->
<div class="floating-btn">
    <button id="open-form-btn"><i class="fas fa-plus"></i></button>
</div>

<!-- Add/Edit FAQ Modal -->
<div id="addQuestionModal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h2 id="modal-title">Add New FAQ</h2>
        <form id="faqForm" action="{{ route('faqA.store') }}" method="POST">
            @csrf
            <input type="hidden" id="faq-id" name="faq_id" value="">
            <input type="hidden" id="form-method" name="_method" value="">
            
            <div class="form-group">
                <label for="newQuestion">Question:</label>
                <input type="text" id="newQuestion" name="question" placeholder="Enter your question here" required>
            </div>
            <div class="form-group">
                <label for="newAnswer">Answer:</label>
                <textarea id="newAnswer" name="answer" placeholder="Enter your answer here" required></textarea>
            </div>
            <div class="form-actions">
                <button type="button" class="cancel-btn">Cancel</button>
                <button type="submit" class="submit-modal-btn">Submit</button>
            </div>
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
                <li><a href="{{ route('home') }}">Home</a></li>
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
// FAQ accordion functionality
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
});

// Modal functionality
document.addEventListener('DOMContentLoaded', function() {
    const floatingBtn = document.querySelector('.floating-btn');
    const modal = document.getElementById('addQuestionModal');
    const closeModal = document.querySelector('.close-modal');
    const cancelBtn = document.querySelector('.cancel-btn');
    const faqForm = document.getElementById('faqForm');

    // Open modal for new FAQ
    floatingBtn.addEventListener('click', () => {
        resetForm();
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    });

    // Close modal functions
    function closeModalFunc() {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
        resetForm();
    }

    closeModal.addEventListener('click', closeModalFunc);
    cancelBtn.addEventListener('click', closeModalFunc);

    // Close when clicking outside modal
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            closeModalFunc();
        }
    });

    function resetForm() {
        document.getElementById('modal-title').textContent = 'Add New FAQ';
        document.getElementById('faq-id').value = '';
        faqForm.reset();
    }
});

// Edit FAQ function
function editFaq(id, question, answer) {
    document.getElementById('modal-title').textContent = 'Edit FAQ';
    document.getElementById('faq-id').value = id;
    document.getElementById('form-method').value = 'PUT';
    document.getElementById('newQuestion').value = question;
    document.getElementById('newAnswer').value = answer;
    
    // Update form action for edit
    const form = document.getElementById('faqForm');
    form.action = `{{ url('/faqA') }}/${id}`;
    
    // Show modal
    document.getElementById('addQuestionModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

// Delete FAQ function
function deleteFaq(id) {
    if (confirm('Are you sure you want to delete this FAQ?')) {
        // Create a form to delete FAQ
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `{{ url('/faqA') }}/${id}`;
        
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

// Toggle FAQ active status
function toggleActive(id) {
    // Create a form to toggle FAQ status
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `{{ url('/faqA') }}/${id}/toggle`;
    
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
    methodInput.value = 'PATCH';
    form.appendChild(methodInput);
    
    // Submit form
    document.body.appendChild(form);
    form.submit();
}

    function resetForm() {
        document.getElementById('modal-title').textContent = 'Add New FAQ';
        document.getElementById('faq-id').value = '';
        document.getElementById('form-method').value = '';
        document.getElementById('faqForm').action = '{{ route("faqA.store") }}';
        faqForm.reset();
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