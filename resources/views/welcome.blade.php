<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apollo Capital</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Poppins:wght@400;600&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Global Styles */
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        h1, h2, h3 {
            font-family: 'Montserrat', sans-serif;
            color: #111;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
        }

        /* Navbar */
        .navbar {
            background-color: #333;
            padding: 20px;
            text-align: right;
        }

        .navbar a {
            color: white;
            margin-left: 15px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
        }

        .navbar a:hover {
            color: #f0c14b;
        }

        /* Hero Section */
        .hero {
            background-image: url('supercar.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 150px 20px;
            position: relative;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 24px;
            font-family: 'Playfair Display', serif;
            margin-bottom: 40px;
        }

        .hero-buttons .btn {
            padding: 15px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 18px;
            margin: 0 10px;
            display: inline-block;
        }

        .btn.primary {
            background-color: #f0c14b;
            color: black;
        }

        .btn.secondary {
            background-color: transparent;
            border: 2px solid #f0c14b;
            color: #f0c14b;
        }

        /* About Section */
        .about {
            padding: 80px 20px;
            text-align: center;
            background: #f7f7f7;
        }

        .about h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .about p {
            font-size: 18px;
            max-width: 800px;
            margin: 0 auto;
        }

        /* Features Section */
        .features {
            padding: 80px 20px;
            background: #fff;
            text-align: center;
        }

        .features h2 {
            font-size: 36px;
            margin-bottom: 50px;
        }

        .feature-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .feature {
            max-width: 300px;
            padding: 20px;
            background: #f7f7f7;
            border-radius: 10px;
        }

        .feature h3 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .feature p {
            font-size: 16px;
        }

        /* Testimonials Section */
        .testimonials {
            padding: 80px 20px;
            background: #f0c14b;
            color: #333;
            text-align: center;
        }

        .testimonials h2 {
            font-size: 36px;
            margin-bottom: 50px;
        }

        .testimonial-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .testimonial {
            max-width: 400px;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }

        .testimonial p {
            font-size: 18px;
        }

        /* Footer Section */
        footer {
            background-color: #333;
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        footer h3 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        footer p {
            font-size: 16px;
            margin: 5px 0;
        }

        .social-icons a {
            margin: 0 10px;
        }

        .social-icons img {
            width: 30px;
            height: 30px;
            filter: invert(100%);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .feature-grid, .testimonial-grid {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    {{--
                    <a href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                    --}}
                @endauth
            </div>
        @endif
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Apollo Capital</h1>
            <p>Drive Your Dream, Effortlessly</p>
            <div class="hero-buttons">
                <a href="{{ route('login') }}" class="btn primary">Log in</a>
                
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about">
        <h2>About Apollo Capital</h2>
        <p>Apollo Capital is dedicated to making your dream of owning a supercar a reality. We offer bespoke financing solutions tailored to your unique needs, ensuring a seamless and luxurious experience from start to finish. With flexible loan options and competitive rates, your dream ride is just a few clicks away.</p>
    </section>

    <!-- Features Section -->
    <section class="features">
        <h2>Why Choose Us?</h2>
        <div class="feature-grid">
            <div class="feature">
                <h3>Tailored Financing Plans</h3>
                <p>Our plans are designed to fit your financial profile, giving you maximum flexibility.</p>
            </div>
            <div class="feature">
                <h3>Low Interest Rates</h3>
                <p>Enjoy some of the lowest rates in the market, tailored to supercar enthusiasts.</p>
            </div>
            <div class="feature">
                <h3>Quick and Easy Approval</h3>
                <p>Get approved faster with our streamlined application process.</p>
            </div>
            <div class="feature">
                <h3>Expert Support</h3>
                <p>Our financial experts are here to guide you through every step.</p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <h2>What Our Customers Say</h2>
        <div class="testimonial-grid">
            <div class="testimonial">
                <p>"Apollo Capital made my dream of owning a Lamborghini Huracan come true. The process was effortless and the team was fantastic!"</p>
                <p><strong>- John Doe</strong></p>
            </div>
            <div class="testimonial">
                <p>"Excellent service! They helped me find the perfect financing plan for my McLaren 720S."</p>
                <p><strong>- Jane Smith</strong></p>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <div class="footer-content">
            <h3>Apollo Capital</h3>
            <p>123 Luxury Road, Metropolis, 10001</p>
            <p>Phone: 1800-123-4567 | Email: info@apollocapital.com</p>
           
       
