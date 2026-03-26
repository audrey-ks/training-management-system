<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — ECA CONSEILS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            background: 
            linear-gradient(135deg, #7B7D7F 50%, #004882 80%);
            display: flex; 
            align-items: center; 
            justify-content: center;
            font-family: 'Times new roman', sans-serif;
        }
        .login-card {
            background: #7B7D7F; 
            border-radius: 20px; 
            width: 100%; 
            align-items: center;
            max-width: 420px;
            padding: 2.5rem; 
            box-shadow: 0 25px 50px rgba(0,0,0,.3);
        }
        .login-card:hover{
            transform: translateY(-10px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .login-logo {
           
            border-radius: 16px; 
            display: flex; 
            align-items: center;
            justify-content: center; 
            font-size: 1.8rem; 
            color: #fff; 
            margin: 0 auto 1.25rem;
        }
        .login-logo img { 
            height: 100%; 
            width: auto; 
            align-items: center;
            border-radius: inherit; 
        }
        .mb-1 {
            color: #fff;
            font-size: x-large ;
        }
        .mb-3 {
            color: #fff;
            font-size: large;
        }
        .mb-4 {
           color: #fff;
            font-size: large; 
        }
        .form-control:focus { 
            border-color: #7B7D7F; 
            box-shadow: ; 
        }
        .btn-login { 
            background: #004882; 
            border: none; 
            padding: .75rem; 
            font-weight: 600; 
            border-radius: 10px; 
        }
        .btn-login:hover {
             background: #004882; 
            }
        .demo-box { 
            background: #004882; 
            border-radius: 10px; 
            padding: 1rem; 
            font-size: .82rem; }
        .demo-row { 
            display: flex; 
            justify-content: space-between; 
            padding: .2rem 0; 
        }
        .demo-label { 
            color: #004882; 
            font-weight: 600; 
        }
    </style>
</head>
<body>
<div class="login-card">
    <div class="login-logo">
        <img src="<?php echo e(asset('eca.png')); ?>" alt="ECA" onerror="this.parentElement.innerHTML='<i class=\"fa-solid fa-graduation-cap\"></i>
    </div>
    <h4 class="text-center fw-700 larger mb-1">ECA CONSEILS</h4>
    <p class="text-center text-muted small mb-4">Admin Login Required</p>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger py-2 small">
            <i class="fa-solid fa-triangle-exclamation me-1"></i>
            <?php echo e($errors->first()); ?>

        </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success py-2 small"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <form action="<?php echo e(route('login.post')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label class="form-label fw-600 small">Email Address</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fa-regular fa-envelope text-muted"></i></span>
                <input type="email" name="email" class="form-control border-start-0 ps-0"
                    placeholder="you@example.com" value="<?php echo e(old('email')); ?>" required autofocus>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label fw-600 small">Password</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-lock text-muted"></i></span>
                <input type="password" name="password" id="pw" class="form-control border-start-0 ps-0"
                    placeholder="••••••••" required>
                <button class="btn btn-light border" type="button" onclick="togglePw()">
                    <i class="fa-regular fa-eye" id="pw-icon"></i>
                </button>
            </div>
        </div>

        <div class="mb-4 d-flex align-items-center justify-content-between">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label small" for="remember">Remember me</label>
            </div>
        </div>


        <button type="submit" class="btn btn-primary btn-login w-100 text-white">
            <i class="fa-solid fa-right-to-bracket me-2"></i>Sign In
        </button>
    </form>

    
</div>
<script>
function togglePw() {
    const p = document.getElementById('pw');
    const i = document.getElementById('pw-icon');
    p.type = p.type === 'password' ? 'text' : 'password';
    i.className = p.type === 'password' ? 'fa-regular fa-eye' : 'fa-regular fa-eye-slash';
}
</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\tms\resources\views/auth/login.blade.php ENDPATH**/ ?>