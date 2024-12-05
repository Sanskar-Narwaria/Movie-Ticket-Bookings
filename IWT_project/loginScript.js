document.addEventListener('DOMContentLoaded', function () {
    const switchToSignup = document.getElementById('switchToSignup');
    const switchToLogin = document.getElementById('switchToLogin');
    const loginBox = document.querySelector('.login-box');
    const signupBox = document.querySelector('.signup-box');

    switchToSignup.addEventListener('click', function (e) {
        e.preventDefault();
        loginBox.style.transform = 'translateX(-100%)';
        signupBox.style.transform = 'translateX(0)';
    });

    switchToLogin.addEventListener('click', function (e) {
        e.preventDefault();
        loginBox.style.transform = 'translateX(0)';
        signupBox.style.transform = 'translateX(100%)';
    });
});


window.onload = function() {
   
    const urlParams = new URLSearchParams(window.location.search);
    const msg = urlParams.get('message');

    if (msg) {
        let alertMessage = '';
        let slideToLogin = false; 

        switch (msg) {
            case 'email_already_exists':
                alertMessage = 'Email already exists';
                break;
            case 'signup_failed':
                alertMessage = 'Signup Failed';
                break;
            case 'signup_success':
                alertMessage = 'Signup Successful. Proceed to Login.';
                slideToLogin = true; 
                break;
            case 'passwords_do_not_match':
                alertMessage = 'Passwords do not match';
                break;
            case 'login_failed':
                alertMessage = 'Login Failed';
                break;
            case 'invalid_credentials':
                alertMessage = 'Invalid credentials';
                break;
        }

        
        if (alertMessage) {
            alert(alertMessage);
        }

        
        if (slideToLogin) {
            const loginBox = document.querySelector('.login-box');
            const signupBox = document.querySelector('.signup-box');
            loginBox.style.transform = 'translateX(0)';
            signupBox.style.transform = 'translateX(100%)';
        } else {
            
            const loginBox = document.querySelector('.login-box');
            const signupBox = document.querySelector('.signup-box');
            loginBox.style.transform = 'translateX(-100%)';
            signupBox.style.transform = 'translateX(0)';
        }
    } 
    
};