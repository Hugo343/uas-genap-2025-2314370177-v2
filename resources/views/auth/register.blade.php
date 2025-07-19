@extends('layouts.app')

@section('content')
<style>
    .auth-page {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: calc(100vh - 80px);
        padding: 40px 0;
        position: relative;
    }
    
    .auth-page::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: 
            radial-gradient(circle at 25% 25%, rgba(99, 102, 241, 0.05) 0%, transparent 50%),
            radial-gradient(circle at 75% 75%, rgba(168, 85, 247, 0.05) 0%, transparent 50%);
        pointer-events: none;
    }
    
    .auth-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
        min-height: 600px;
    }
    
    .auth-hero {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 40px 0;
    }
    
    .auth-hero h1 {
        font-size: 3.5rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 20px;
        line-height: 1.1;
        background: linear-gradient(135deg, #1e293b 0%, #8b5cf6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .auth-hero p {
        font-size: 1.25rem;
        color: #64748b;
        margin-bottom: 30px;
        line-height: 1.6;
    }
    
    .auth-benefits {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin-top: 40px;
    }
    
    .benefit-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 20px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }
    
    .benefit-item:hover {
        transform: translateX(8px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    .benefit-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
        flex-shrink: 0;
    }
    
    .benefit-content h3 {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
    }
    
    .benefit-content p {
        font-size: 14px;
        color: #64748b;
        margin: 0;
        line-height: 1.4;
    }
    
    .auth-form-container {
        background: white;
        border-radius: 24px;
        padding: 50px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
        position: relative;
        overflow: hidden;
    }
    
    .auth-form-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #8b5cf6, #ec4899, #f59e0b);
    }
    
    .auth-form-header {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .auth-form-header h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
    }
    
    .auth-form-header p {
        color: #64748b;
        font-size: 16px;
    }
    
    .form-group {
        margin-bottom: 24px;
        position: relative;
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #374151;
        font-size: 14px;
        transition: color 0.3s ease;
    }
    
    .form-input {
        width: 100%;
        padding: 16px 20px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: #f8fafc;
        box-sizing: border-box;
        font-family: inherit;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #8b5cf6;
        background: white;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        transform: translateY(-1px);
    }
    
    .form-input.is-invalid {
        border-color: #ef4444;
        background: #fef2f2;
    }
    
    .form-input.is-invalid:focus {
        border-color: #ef4444;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }
    
    .invalid-feedback {
        color: #ef4444;
        font-size: 13px;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
        animation: slideDown 0.3s ease-out;
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .password-strength {
        margin-top: 12px;
        padding: 12px;
        background: #f8fafc;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        display: none;
    }
    
    .strength-bar {
        height: 6px;
        background: #e2e8f0;
        border-radius: 3px;
        margin: 8px 0;
        overflow: hidden;
    }
    
    .strength-fill {
        height: 100%;
        width: 0%;
        transition: all 0.3s ease;
        border-radius: 3px;
    }
    
    .strength-weak { background: linear-gradient(90deg, #ef4444, #f87171); width: 25%; }
    .strength-fair { background: linear-gradient(90deg, #f59e0b, #fbbf24); width: 50%; }
    .strength-good { background: linear-gradient(90deg, #10b981, #34d399); width: 75%; }
    .strength-strong { background: linear-gradient(90deg, #059669, #10b981); width: 100%; }
    
    .strength-text {
        font-size: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .password-match {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 16px;
        opacity: 0;
        transition: all 0.3s ease;
    }
    
    .password-match.show {
        opacity: 1;
    }
    
    .password-match.match {
        color: #10b981;
    }
    
    .password-match.no-match {
        color: #ef4444;
    }
    
    .btn-primary {
        width: 100%;
        padding: 16px 24px;
        background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
        border: none;
        border-radius: 12px;
        color: white;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        margin-bottom: 20px;
        font-family: inherit;
    }
    
    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(139, 92, 246, 0.4);
    }
    
    .btn-primary:hover::before {
        left: 100%;
    }
    
    .btn-primary:active {
        transform: translateY(0);
    }
    
    .btn-primary.loading {
        pointer-events: none;
        opacity: 0.8;
    }
    
    .btn-primary.loading .btn-text {
        opacity: 0;
    }
    
    .btn-primary.loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin-left: -10px;
        margin-top: -10px;
        border: 2px solid transparent;
        border-top: 2px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .auth-links {
        text-align: center;
        margin-top: 24px;
    }
    
    .login-link {
        padding-top: 20px;
        border-top: 1px solid #e2e8f0;
        color: #64748b;
        font-size: 14px;
    }
    
    .login-link a {
        color: #8b5cf6;
        text-decoration: none;
        font-weight: 600;
        margin-left: 4px;
        transition: color 0.3s ease;
    }
    
    .login-link a:hover {
        color: #7c3aed;
        text-decoration: underline;
    }
    
    @media (max-width: 1024px) {
        .auth-container {
            grid-template-columns: 1fr;
            gap: 40px;
            text-align: center;
        }
        
        .auth-hero {
            order: 2;
        }
        
        .auth-form-container {
            order: 1;
            padding: 40px 30px;
        }
        
        .auth-hero h1 {
            font-size: 2.5rem;
        }
    }
    
    @media (max-width: 768px) {
        .auth-page {
            padding: 20px 0;
        }
        
        .auth-container {
            padding: 0 15px;
            gap: 30px;
        }
        
        .auth-form-container {
            padding: 30px 20px;
            border-radius: 16px;
        }
        
        .auth-hero h1 {
            font-size: 2rem;
        }
        
        .auth-benefits {
            gap: 15px;
        }
        
        .benefit-item {
            padding: 16px;
        }
    }
    
    .auth-page .container-fluid,
    .auth-page .container {
        padding: 0;
        margin: 0;
        max-width: none;
    }
</style>

<div class="auth-page">
    <div class="auth-container">
        <!-- Hero Section -->
        <div class="auth-hero">
            <h1>Join Our Store</h1>
            <p>Create your account and start enjoying exclusive benefits, personalized recommendations, and seamless shopping experience.</p>
            
            <div class="auth-benefits">
                <div class="benefit-item">
                    <div class="benefit-icon">🎁</div>
                    <div class="benefit-content">
                        <h3>Exclusive Offers</h3>
                        <p>Get access to member-only deals and early access to sales</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">📦</div>
                    <div class="benefit-content">
                        <h3>Order Tracking</h3>
                        <p>Track your orders in real-time and manage your purchase history</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">💝</div>
                    <div class="benefit-content">
                        <h3>Wishlist & Favorites</h3>
                        <p>Save your favorite items and get notified when they go on sale</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Section -->
        <div class="auth-form-container">
            <div class="auth-form-header">
                <h2>{{ __('Create Account') }}</h2>
                <p>Fill in your information to get started</p>
            </div>
            
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf
                
                <div class="form-group">
                    <label for="name" class="form-label">{{ __('Full Name') }}</label>
                    <input id="name" type="text" class="form-input @error('name') is-invalid @enderror" 
                           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus 
                           placeholder="Enter your full name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <span>⚠️</span>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-input @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" required autocomplete="email" 
                           placeholder="Enter your email address">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <span>⚠️</span>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-input @error('password') is-invalid @enderror" 
                           name="password" required autocomplete="new-password" 
                           placeholder="Create a strong password">
                    <div class="password-strength" id="passwordStrength">
                        <div class="strength-bar">
                            <div class="strength-fill" id="strengthFill"></div>
                        </div>
                        <div class="strength-text" id="strengthText"></div>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <span>⚠️</span>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                    <div style="position: relative;">
                        <input id="password-confirm" type="password" class="form-input" 
                               name="password_confirmation" required autocomplete="new-password" 
                               placeholder="Confirm your password">
                        <div class="password-match" id="passwordMatch">
                            <span id="matchIcon"></span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-primary" id="registerBtn">
                    <span class="btn-text">{{ __('Create My Account') }}</span>
                </button>
                
                <div class="auth-links">
                    <div class="login-link">
                        {{ __('Already have an account?') }}
                        <a href="{{ route('login') }}">{{ __('Sign in here') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');
    const registerBtn = document.getElementById('registerBtn');
    const inputs = document.querySelectorAll('.form-input');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password-confirm');
    const passwordStrength = document.getElementById('passwordStrength');
    const strengthFill = document.getElementById('strengthFill');
    const strengthText = document.getElementById('strengthText');
    const passwordMatch = document.getElementById('passwordMatch');
    const matchIcon = document.getElementById('matchIcon');
    
    // Enhanced input interactions
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
            this.style.transform = 'translateY(-1px)';
        });
        
        input.addEventListener('blur', function() {
            if (this.value === '') {
                this.parentElement.classList.remove('focused');
            }
            this.style.transform = 'translateY(0)';
        });
        
        input.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                this.classList.remove('is-invalid');
                const feedback = this.parentElement.querySelector('.invalid-feedback');
                if (feedback) {
                    feedback.style.display = 'none';
                }
            }
            
            if (this.value.length > 0) {
                this.style.borderColor = '#10b981';
            } else {
                this.style.borderColor = '#e2e8f0';
            }
        });
        
        if (input.value !== '') {
            input.parentElement.classList.add('focused');
        }
    });
    
    // Password strength checker
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        if (password.length > 0) {
            passwordStrength.style.display = 'block';
            const strength = checkPasswordStrength(password);
            updatePasswordStrength(strength);
        } else {
            passwordStrength.style.display = 'none';
        }
        checkPasswordMatch();
    });
    
    confirmPasswordInput.addEventListener('input', checkPasswordMatch);
    
    function checkPasswordStrength(password) {
        let score = 0;
        let feedback = [];
        
        if (password.length >= 8) score += 1;
        else feedback.push('8+ characters');
        
        if (/[a-z]/.test(password)) score += 1;
        else feedback.push('lowercase');
        
        if (/[A-Z]/.test(password)) score += 1;
        else feedback.push('uppercase');
        
        if (/\d/.test(password)) score += 1;
        else feedback.push('number');
        
        if (/[^A-Za-z0-9]/.test(password)) score += 1;
        else feedback.push('special char');
        
        return { score, feedback };
    }
    
    function updatePasswordStrength(strength) {
        const { score, feedback } = strength;
        
        strengthFill.className = 'strength-fill';
        
        if (score <= 2) {
            strengthFill.classList.add('strength-weak');
            strengthText.innerHTML = '<span style="color: #ef4444;">🔴 Weak</span> - Add: ' + feedback.join(', ');
        } else if (score === 3) {
            strengthFill.classList.add('strength-fair');
            strengthText.innerHTML = '<span style="color: #f59e0b;">🟡 Fair</span> - Add: ' + feedback.join(', ');
        } else if (score === 4) {
            strengthFill.classList.add('strength-good');
            strengthText.innerHTML = '<span style="color: #10b981;">🟢 Good</span> - Almost there!';
        } else {
            strengthFill.classList.add('strength-strong');
            strengthText.innerHTML = '<span style="color: #059669;">✅ Strong</span> - Perfect!';
        }
    }
    
    function checkPasswordMatch() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        
        if (confirmPassword.length > 0) {
            passwordMatch.classList.add('show');
            if (password === confirmPassword) {
                passwordMatch.classList.remove('no-match');
                passwordMatch.classList.add('match');
                matchIcon.textContent = '✓';
            } else {
                passwordMatch.classList.remove('match');
                passwordMatch.classList.add('no-match');
                matchIcon.textContent = '✗';
            }
        } else {
            passwordMatch.classList.remove('show');
        }
    }
    
    // Enhanced form submission
    form.addEventListener('submit', function(e) {
        registerBtn.classList.add('loading');
        registerBtn.disabled = true;
        
        form.style.transform = 'scale(0.98)';
        form.style.opacity = '0.8';
    });
    
    // Smooth scroll to errors
    const errorElement = document.querySelector('.invalid-feedback');
    if (errorElement) {
        errorElement.scrollIntoView({ 
            behavior: 'smooth', 
            block: 'center',
            inline: 'nearest'
        });
    }
    
    // Enhanced keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && e.target.tagName !== 'BUTTON') {
            e.preventDefault();
            const currentIndex = Array.from(inputs).indexOf(e.target);
            if (currentIndex < inputs.length - 1) {
                inputs[currentIndex + 1].focus();
            } else {
                registerBtn.focus();
                registerBtn.click();
            }
        }
    });
    
    // Add subtle animations on load
    const authContainer = document.querySelector('.auth-form-container');
    const authHero = document.querySelector('.auth-hero');
    
    setTimeout(() => {
        authHero.style.opacity = '1';
        authHero.style.transform = 'translateY(0)';
    }, 100);
    
    setTimeout(() => {
        authContainer.style.opacity = '1';
        authContainer.style.transform = 'translateY(0)';
    }, 200);
    
    authHero.style.opacity = '0';
    authHero.style.transform = 'translateY(20px)';
    authHero.style.transition = 'all 0.6s ease-out';
    
    authContainer.style.opacity = '0';
    authContainer.style.transform = 'translateY(20px)';
    authContainer.style.transition = 'all 0.6s ease-out';
});
</script>
@endsection
