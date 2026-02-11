<?php
/**
 * Real-World Example: Complete Login Page
 * 
 * A production-ready login page with:
 * - Form validation
 * - Error handling
 * - Remember me functionality
 * - Social login options
 * - Responsive design
 */

if (!isset($themantic)) {
    die('Themantic not initialized');
}

// Handle form submission (demo)
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Demo validation
    if (empty($email) || empty($password)) {
        $error = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        // Demo: Check credentials (in real app, check against database)
        if ($email === 'demo@example.com' && $password === 'demo123') {
            $success = 'Login successful! Redirecting...';
            // In real app: Set session, redirect to dashboard
        } else {
            $error = 'Invalid email or password.';
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Themantic Example</title>
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 2em;
        }
        .login-box {
            background: white;
            border-radius: 8px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        .login-header {
            text-align: center;
            padding: 2em 2em 1em;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 8px 8px 0 0;
        }
        .login-header h1 {
            color: white;
            margin: 0;
        }
        .login-header p {
            margin: 0.5em 0 0;
            opacity: 0.9;
        }
        .login-content {
            padding: 2em;
        }
        .login-footer {
            text-align: center;
            padding: 1em 2em 2em;
            color: #666;
        }
        .social-login {
            margin-top: 1.5em;
        }
        .forgot-password {
            text-align: right;
            margin-top: 0.5em;
        }
        .forgot-password a {
            color: #667eea;
            text-decoration: none;
        }
        .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        
        <div class="login-box">
            <!-- Header -->
            <div class="login-header">
                <h1 class="ui header">
                    <i class="lock icon"></i>
                    Welcome Back
                </h1>
                <p>Sign in to continue to your account</p>
            </div>

            <!-- Content -->
            <div class="login-content">
                
                <?php if ($error): ?>
                    <?php
                    echo $themantic->render('message', [
                        'type' => 'error',
                        'header' => 'Login Failed',
                        'content' => $error,
                        'icon' => 'exclamation triangle',
                        'dismissible' => true
                    ]);
                    ?>
                <?php endif; ?>

                <?php if ($success): ?>
                    <?php
                    echo $themantic->render('message', [
                        'type' => 'success',
                        'header' => 'Success!',
                        'content' => $success,
                        'icon' => 'check circle'
                    ]);
                    ?>
                    <script>
                    setTimeout(function() {
                        window.location.href = '/dashboard';
                    }, 2000);
                    </script>
                <?php endif; ?>

                <!-- Login Form -->
                <form class="ui large form" method="POST" id="login-form">
                    
                    <!-- Email Field -->
                    <div class="field">
                        <label>Email Address</label>
                        <div class="ui left icon input">
                            <i class="mail icon"></i>
                            <input 
                                type="email" 
                                name="email" 
                                placeholder="your@email.com"
                                value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                                required
                                autofocus
                            >
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="field">
                        <label>Password</label>
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input 
                                type="password" 
                                name="password" 
                                placeholder="Enter your password"
                                required
                                minlength="6"
                            >
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="field">
                        <div class="ui checkbox">
                            <input type="checkbox" name="remember" tabindex="0">
                            <label>Remember me for 30 days</label>
                        </div>
                    </div>

                    <!-- Forgot Password -->
                    <div class="forgot-password">
                        <a href="/forgot-password">Forgot your password?</a>
                    </div>

                    <!-- Submit Button -->
                    <div style="margin-top: 1.5em;">
                        <?php
                        echo $themantic->render('button', [
                            'text' => 'Sign In',
                            'type' => 'submit',
                            'color' => 'violet',
                            'fluid' => true,
                            'size' => 'large',
                            'id' => 'submit-btn'
                        ]);
                        ?>
                    </div>

                </form>

                <!-- Social Login -->
                <div class="social-login">
                    <div class="ui horizontal divider">Or sign in with</div>
                    
                    <div class="ui two column grid">
                        <div class="column">
                            <?php
                            echo $themantic->render('button', [
                                'text' => 'Facebook',
                                'icon' => 'facebook',
                                'color' => 'facebook',
                                'fluid' => true,
                                'onClick' => 'socialLogin("facebook")'
                            ]);
                            ?>
                        </div>
                        <div class="column">
                            <?php
                            echo $themantic->render('button', [
                                'text' => 'Google',
                                'icon' => 'google',
                                'color' => 'google plus',
                                'fluid' => true,
                                'onClick' => 'socialLogin("google")'
                            ]);
                            ?>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer -->
            <div class="login-footer">
                Don't have an account? 
                <a href="/register" style="color: #667eea; font-weight: bold;">Sign up now</a>
            </div>
        </div>

        <!-- Demo Credentials Info -->
        <div class="ui info message" style="margin-top: 1em;">
            <div class="header">Demo Credentials</div>
            <p>
                <strong>Email:</strong> demo@example.com<br>
                <strong>Password:</strong> demo123
            </p>
        </div>

    </div>

    <script>
    // Form validation
    document.getElementById('login-form').addEventListener('submit', function(e) {
        var form = this;
        var submitBtn = document.getElementById('submit-btn');
        
        if (!form.checkValidity()) {
            e.preventDefault();
            form.reportValidity();
            return false;
        }
        
        // Show loading state
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
    });

    // Social login handler (demo)
    function socialLogin(provider) {
        alert('Social login with ' + provider + ' would happen here');
        // In real app: redirect to OAuth provider
    }

    // Initialize checkbox
    $('.ui.checkbox').checkbox();

    // Dismiss messages
    $('.message .close').on('click', function() {
        $(this).closest('.message').transition('fade');
    });

    // Client-side validation
    $('#login-form input[type="email"]').on('blur', function() {
        var email = $(this).val();
        var field = $(this).closest('.field');
        
        if (email && !isValidEmail(email)) {
            field.addClass('error');
        } else {
            field.removeClass('error');
        }
    });

    function isValidEmail(email) {
        var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    // Show password toggle (optional enhancement)
    $('<i class="eye link icon" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>')
        .appendTo('.ui.input:has(input[type="password"])')
        .on('click', function() {
            var input = $(this).siblings('input');
            var icon = $(this);
            
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                icon.removeClass('eye').addClass('eye slash');
            } else {
                input.attr('type', 'password');
                icon.removeClass('eye slash').addClass('eye');
            }
        });
    </script>
</body>
</html>
