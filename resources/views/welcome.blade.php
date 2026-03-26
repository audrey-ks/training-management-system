<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome — ECA CONSEILS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Times New Roman', -apple-system, BlinkMacSystemFont, sans-serif;
            margin: 0;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            background-blend-mode: overlay;
            opacity: 0.4;
            z-index: -1;
            animation: fadeIn 1s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(1.1); }
            to { opacity: 1; transform: scale(1); }
        }
        .welcome-card {
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 4rem 3rem;
            text-align: center;
            max-width: 500px;
            width: 100%;
            
            animation: fadeInUp 1s ease-out 0.3s both;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .welcome-logo {
            width: 120px;
            height: auto;
            margin: 0 auto 1.5rem;
            border-radius: 16px;
            
            padding: 1rem;
        }
        .welcome-title {
            color: #004882;
            font-size: clamp(2.2rem, 5vw, 3.5rem);
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .welcome-subtitle {
            color: #ffffff;
            font-size: clamp(1.1rem, 3vw, 1.4rem);
            margin-bottom: 2.5rem;
            opacity: 0.95;
        }
        .signin-btn {
            background: #004882;
            border: none;
            color: white;
            padding: 1.2rem 3rem;
            font-size: clamp(1.1rem, 2.5vw, 1.4rem);
            font-weight: 600;
            border-radius: 12px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
            box-shadow: 0 10px 30px rgba(0, 72, 130, 0.4);
            font-family: inherit;
        }
        .signin-btn:hover {
            background: #003d6b;
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 72, 130, 0.6);
            color: white;
            text-decoration: none;
        }
        @media (max-width: 576px) {
            .welcome-card {
                padding: 2.5rem 2rem;
                margin: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="welcome-card">
        <img src="{{ asset('eca.png') }}" alt="ECA CONSEILS" class="welcome-logo" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'; this.nextElementSibling.nextElementSibling.style.marginTop='0';">
        <div style="display: none; font-size: 4rem; margin-bottom: 1.5rem;">
            <i class="fa-solid fa-graduation-cap"></i>
        </div>
        <h1 class="welcome-title">ECA CONSEILS</h1>
        <p class="welcome-subtitle">Welcome to our Training Management System</p>
        <a href="{{ route('login') }}" class="signin-btn">
            <i class="fa-solid fa-right-to-bracket me-3"></i>
            SIGN IN
        </a>
    </div>
</body>
</html>

