@extends('layouts.app')

@section('content')
<style>
    /* Reset dan base styles yang menyatu dengan layout */
    .auth-page {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: calc(100vh - 80px); /* Adjust for navbar height */
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
        background: linear-gradient(135deg, #1e293b 0%, #6366f1 100%);
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
    
    .auth-features {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-top: 40px;
    }
    
    .feature-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }
    
    .feature-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    .feature-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
    }
    
    .feature-text {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
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
        background: linear-gradient(90deg, #6366f1, #8b5cf6, #ec4899);
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
        border-color: #6366f1;
        background: white;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
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
    
    .checkbox-container {
        display: flex;
        align-items: center;
        margin: 24px 0;
        gap: 12px;
    }
    
    .custom-checkbox {
        position: relative;
        display: inline-block;
        width: 20px;
        height: 20px;
        cursor: pointer;
    }
    
    .custom-checkbox input {
        opacity: 0;
        width: 100%;
        height: 100%;
        position: absolute;
        cursor: pointer;
        margin: 0;
    }
    
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 20px;
        background: #f1f5f9;
        border: 2px solid #cbd5e1;
        border-radius: 6px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .custom-checkbox input:checked ~ .checkmark {
        background: #6366f1;
        border-color: #6366f1;
    }
    
    .checkmark::after {
        content: "✓";
        color: white;
        font-size: 12px;
        font-weight: bold;
        opacity: 0;
        transform: scale(0);
        transition: all 0.2s ease;
    }
    
    .custom-checkbox input:checked ~ .checkmark::after {
        opacity: 1;
        transform: scale(1);
    }
    
    .checkbox-label {
        font-size: 14px;
        color: #64748b;
        cursor: pointer;
        user-select: none;
        line-height: 1.4;
    }
    
    .btn-primary {
        width: 100%;
        padding: 16px 24px;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
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
        box-shadow: 0 12px 30px rgba(99, 102, 241, 0.4);
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
    
    .forgot-password {
        margin-bottom: 20px;
    }
    
    .forgot-password a {
        color: #6366f1;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: color 0.3s ease;
    }
    
    .forgot-password a:hover {
        color: #4f46e5;
        text-decoration: underline;
    }
    
    .register-link {
        padding-top: 20px;
        border-top: 1px solid #e2e8f0;
        color: #64748b;
        font-size: 14px;
    }
    
    .register-link a {
        color: #6366f1;
        text-decoration: none;
        font-weight: 600;
        margin-left: 4px;
        transition: color 0.3s ease;
    }
    
    .register-link a:hover {
        color: #4f46e5;
        text-decoration: underline;
    }
    
    .social-login {
        margin: 30px 0;
        position: relative;
    }
    
    .social-divider {
        text-align: center;
        position: relative;
        margin: 30px 0;
    }
    
    .social-divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: #e2e8f0;
    }
    
    .social-divider span {
        background: white;
        padding: 0 20px;
        color: #64748b;
        font-size: 14px;
        position: relative;
    }
    
    /* Responsive Design */
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
        
        .auth-features {
            justify-content: center;
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
        
        .auth-features {
            grid-template-columns: 1fr;
        }
    }
    
    /* Integration dengan existing layout styles */
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
            <h1>Welcome Back</h1>
            <p>Sign in to access your account and continue your shopping journey with us.</p>
            
            <div class="auth-features">
                <div class="feature-item">
                    <div class="feature-icon">🛒</div>
                    <div class="feature-text">Easy Shopping</div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">🚚</div>
                    <div class="feature-text">Fast Delivery</div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">💳</div>
                    <div class="feature-text">Secure Payment</div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">⭐</div>
                    <div class="feature-text">Quality Products</div>
                </div>
            </div>
        </div>
        
        <!-- Form Section -->
        <div class="auth-form-container">
            <div class="auth-form-header">
                <h2>{{ __('Sign In') }}</h2>
                <p>Enter your credentials to access your account</p>
            </div>
            
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
                
                <div class="form-group">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-input @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus 
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
                           name="password" required autocomplete="current-password" 
                           placeholder="Enter your password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <span>⚠️</span>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="checkbox-container">
                    <label class="custom-checkbox">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox-label" for="remember">
                        {{ __('Keep me signed in') }}
                    </label>
                </div>

                <button type="submit" class="btn-primary" id="loginBtn">
                    <span class="btn-text">{{ __('Sign In to Your Account') }}</span>
                </button>

                <div class="auth-links">
                    @if (Route::has('password.request'))
                        <div class="forgot-password">
                            <a href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        </div>
                    @endif
                    
                    <div class="register-link">
                        {{ __("Don't have an account?") }}
                        <a href="{{ route('register') }}">{{ __('Create one now') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    const loginBtn = document.getElementById('loginBtn');
    const inputs = document.querySelectorAll('.form-input');
    
    // Enhanced input interactions
    inputs.forEach(input => {
        // Focus effects
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
        
        // Real-time validation feedback
        input.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                this.classList.remove('is-invalid');
                const feedback = this.parentElement.querySelector('.invalid-feedback');
                if (feedback) {
                    feedback.style.display = 'none';
                }
            }
            
            // Add valid styling for filled inputs
            if (this.value.length > 0) {
                this.style.borderColor = '#10b981';
            } else {
                this.style.borderColor = '#e2e8f0';
            }
        });
        
        // Check if input has value on load
        if (input.value !== '') {
            input.parentElement.classList.add('focused');
        }
    });
    
    // Enhanced form submission
    form.addEventListener('submit', function(e) {
        // Add loading state
        loginBtn.classList.add('loading');
        loginBtn.disabled = true;
        
        // Add subtle form animation
        form.style.transform = 'scale(0.98)';
        form.style.opacity = '0.8';
        
        // Prevent double submission
        setTimeout(() => {
            if (!form.submitted) {
                form.submitted = true;
            }
        }, 100);
    });
    
    // Smooth scroll to errors
    const errorElement = document.querySelector('.invalid-feedback');
    if (errorElement) {
        errorElement.scrollIntoView({ 
            behavior: 'smooth', 
            block: 'center',
            inline: 'nearest'
        });
        
        // Add attention animation to error
        errorElement.style.animation = 'pulse 2s ease-in-out 3';
    }
    
    // Enhanced keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && e.target.tagName !== 'BUTTON') {
            e.preventDefault();
            const currentIndex = Array.from(inputs).indexOf(e.target);
            if (currentIndex < inputs.length - 1) {
                inputs[currentIndex + 1].focus();
            } else {
                loginBtn.focus();
                loginBtn.click();
            }
        }
    });
    
    // Add subtle animations on load
    const authContainer = document.querySelector('.auth-form-container');
    const authHero = document.querySelector('.auth-hero');
    
    // Stagger animations
    setTimeout(() => {
        authHero.style.opacity = '1';
        authHero.style.transform = 'translateY(0)';
    }, 100);
    
    setTimeout(() => {
        authContainer.style.opacity = '1';
        authContainer.style.transform = 'translateY(0)';
    }, 200);
    
    // Initial state for animations
    authHero.style.opacity = '0';
    authHero.style.transform = 'translateY(20px)';
    authHero.style.transition = 'all 0.6s ease-out';
    
    authContainer.style.opacity = '0';
    authContainer.style.transform = 'translateY(20px)';
    authContainer.style.transition = 'all 0.6s ease-out';
});

// Add CSS animation keyframes
const style = document.createElement('style');
style.textContent = `
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }
`;
document.head.appendChild(style);
</script>
@endsection
