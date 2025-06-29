<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save Bite - Near Me</title>
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
        
        /* Main content */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        
        .page-title {
            font-family: 'Playfair Display', serif;
            font-weight: bold;
            text-align: center;
            font-size: 42px;
            color: #333;
            margin-bottom: 15px;
        }
        
        .page-subtitle {
            text-align: center;
            max-width: 600px;
            margin: 0 auto 40px;
            color: #555;
        }
        
        /* Meal grid */
        .meal-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .meal-card {
            background-color: white;
            height: 370px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }
        
        .meal-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .meal-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
        
        .meal-info {
            padding: 15px;
        }
        
        .meal-title {
            font-weight: bolder;
            font-size: 18px;
            margin-bottom: 5px;
        }
        
        .meal-vendor {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }
        
        .meal-location {
            font-size: 14px;
            color: #333;
            margin-bottom: 10px;
        }
        
        .meal-distance {
            font-size: 14px;
            color: #333;
        }
        
         /* Modal */
         .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            width: 90%;
            max-width: 600px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            animation: modalopen 0.3s;
        }

        @keyframes modalopen {
            from {transform: scale(0.8); opacity: 0;}
            to {transform: scale(1); opacity: 1;}
        }

        .modal-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-section {
            margin-bottom: 20px;
        }

        .section-title {
            color: #B22222;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .donor-info p, .food-info p {
            margin-bottom: 5px;
            font-size: 15px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            background-color: #B22222;
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .quantity-display {
            margin: 0 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .request-btn {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #B22222;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .request-btn:hover {
            background-color: #8B0000;
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

        .footer-list {
            list-style: none;
        }

        .footer-list li {
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
        
        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .meal-grid {
                grid-template-columns: repeat(3, 1fr);
            }
            
            .footer-content {
                grid-template-columns: repeat(2, 1fr);
                gap: 40px;
            }
        }
        
        @media (max-width: 768px) {
            .meal-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .nav-links {
                display: none;
            }
            
            .footer-content {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 480px) {
            .meal-grid {
                grid-template-columns: 1fr;
            }
            
            .top-bar {
                flex-direction: column;
                gap: 10px;
                padding: 10px;
            }

            .modal-content {
                width: 95%;
            }
        }

        /* Back to Top Button */
        #back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background-color: #444;
            color: white;
            border-radius: 50%;
            text-align: center;
            line-height: 50px;
            font-size: 20px;
            cursor: pointer;
            display: none;
            z-index: 999;
            transition: background-color 0.3s;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        #back-to-top:hover {
            background-color: #555;
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
            <a href="{{ route('index') }}" class="logo">
                <img src="{{ asset('gambar/save bite.png') }}" alt="Save Bite Logo">
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
        <h1 class="page-title">Near Me</h1>
        <p class="page-subtitle">We consider all the drivers of change gives you the components you need to change to create a truly happens.</p>
        
        <!-- Meal Grid -->
        <div class="meal-grid">
            @forelse($foods as $food)
            <div class="meal-card" onclick="openModal({{ $food->id }})">
                @if($food->food_photo)
                    <img src="{{ asset('storage/' . $food->food_photo) }}" alt="{{ $food->food_name }}" class="meal-image">
                @else
                    <img src="{{ asset('gambar/makanan.jpg') }}" alt="Default meal image" class="meal-image">
                @endif
                <div class="meal-info">
                    <div class="meal-title">{{ $food->food_name }}</div>
                    <div class="meal-vendor">{{ $food->donor_name }}</div>
                    <div class="meal-location">Location: {{ $food->donor_address }}</div>
                    <div class="meal-distance">Available: {{ $food->portion_quantity }} portions</div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 40px;">
                <p>No meals available at the moment. Please check back later!</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Modal Pop-up -->
    @foreach($foods as $food)
    <div id="mealModal{{ $food->id }}" class="modal" onclick="closeModalOnOutsideClick(event, {{ $food->id }})">
        <div class="modal-content">
            @if($food->food_photo)
                <img src="{{ asset('storage/' . $food->food_photo) }}" alt="{{ $food->food_name }}" class="modal-img">
            @else
                <img src="{{ asset('gambar/makanan.jpg') }}" alt="Default meal image" class="modal-img">
            @endif
            <div class="modal-body">
                <div class="modal-section">
                    <div class="section-title">About Donor</div>
                    <div class="donor-info">
                        <p><strong>Name of Donor:</strong> {{ $food->donor_name }}</p>
                        <p><strong>Address:</strong> {{ $food->donor_address }}</p>
                        <p><strong>Pickup Method:</strong> {{ $food->pickup_method }}</p>
                        <p><strong>Contact:</strong> {{ $food->donor_contact }}</p>
                    </div>
                </div>

                <div class="modal-section">
                    <div class="section-title">About Food</div>
                    <div class="food-info">
                        <p><strong>Food Name:</strong> {{ $food->food_name }}</p>
                        <p><strong>Portion Available:</strong> {{ $food->portion_quantity }}</p>
                        @if($food->best_within)
                        <p><strong>Best Before:</strong> {{ $food->best_within }}</p>
                        @endif
                    </div>
                </div>

                <div class="quantity-control">
                    <button class="quantity-btn" onclick="decrementQuantity({{ $food->id }})">-</button>
                    <div class="quantity-display" id="quantity{{ $food->id }}">1</div>
                    <button class="quantity-btn" onclick="incrementQuantity({{ $food->id }}, {{ $food->portion_quantity }})">+</button>
                </div>

                <form action="{{ route('request.food') }}" method="POST" style="width: 100%;">
                    @csrf
                    <input type="hidden" name="food_id" value="{{ $food->id }}">
                    <input type="hidden" name="quantity" id="hiddenQuantity{{ $food->id }}" value="1">
                    <button type="submit" class="request-btn">Request Food</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <a href="{{ route('index') }}" class="logo">
                    <img src="{{ asset('gambar/save bite.png') }}" alt="Save Bite Logo" class="logo-img">
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
                    <li><a href="{{ route('meal') }}">Meal</a></li>
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
                <div class="instagram-feed">
                    <img src="{{ asset('gambar\Voluntário.jpg') }}" alt="Instagram post">
                    <img src="{{ asset('gambar\saving uneaten food.jpg') }}" alt="Instagram post">
                    <img src="{{ asset('gambar\donate.jpg') }}" alt="Instagram post">
                    <img src="{{ asset('gambar\The Felix Project.jpg') }}" alt="Instagram post">
                </div>
            </div>
        </div>
        
        <div class="copyright">
            Copyright © 2023 Hashtag Developer. All Rights Reserved
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#top" id="back-to-top" title="Back to Top"><i class="fas fa-arrow-up"></i></a>

    <!-- JavaScript for functionality -->
    <script>
        // Store quantities for each food item
        let quantities = {};
        
        // Initialize quantities
        @foreach($foods as $food)
        quantities[{{ $food->id }}] = 1;
        @endforeach

        // Back to Top button
        window.onscroll = function() {scrollFunction()};
        
        function scrollFunction() {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                document.getElementById("back-to-top").style.display = "block";
            } else {
                document.getElementById("back-to-top").style.display = "none";
            }
        }
        
        // Modal functions
        function openModal(foodId) {
            document.getElementById("mealModal" + foodId).style.display = "flex";
            document.body.style.overflow = "hidden";
        }
        
        function closeModal(foodId) {
            document.getElementById("mealModal" + foodId).style.display = "none";
            document.body.style.overflow = "auto";
        }
        
        function closeModalOnOutsideClick(event, foodId) {
            if (event.target === document.getElementById("mealModal" + foodId)) {
                closeModal(foodId);
            }
        }
        
        // Quantity control functions
        function updateQuantityDisplay(foodId) {
            document.getElementById("quantity" + foodId).textContent = quantities[foodId];
            document.getElementById("hiddenQuantity" + foodId).value = quantities[foodId];
        }
        
        function incrementQuantity(foodId, maxQuantity) {
            if (quantities[foodId] < maxQuantity) {
                quantities[foodId]++;
                updateQuantityDisplay(foodId);
            }
        }
        
        function decrementQuantity(foodId) {
            if (quantities[foodId] > 1) {
                quantities[foodId]--;
                updateQuantityDisplay(foodId);
            }
        }
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Close modal with ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                @foreach($foods as $food)
                closeModal({{ $food->id }});
                @endforeach
            }
        });
    </script>
</body>
</html>