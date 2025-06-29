<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Save Bite')</title>
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Karla:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap">
    
    <!-- Additional Styles -->
    @yield('styles')
    
    <!-- Base Styles -->
    <style>
        /* Footer common styles */
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

        .footer-heading, .footer-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .footer-links ul, .footer-list {
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
</head>
<body>
    @yield('content')
    
    @yield('footer')
    
    <!-- Scripts -->
    <script>
        // Global JavaScript functions can go here
    </script>
    
    @yield('scripts')
</body>
</html>