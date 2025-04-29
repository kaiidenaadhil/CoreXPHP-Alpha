
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login to uComfortBD - Fostering Goodness and Discouraging Evil</title>
  <link href="https://cdn.jsdelivr.net/npm/@iconscout/unicons@4.0.8/css/line.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    main {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: linear-gradient(166deg, #127fb1, #88cdae);
      padding: 1rem;
    }

    .auth-form-container {
      border-radius: 0.5rem;
      border: 1px solid #e2e2e2;
      background: #edf7fd;
      max-width: 400px;
      width: 100%;
      color: #333;
      display: flex;
      flex-direction: column;
      padding: 2rem;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .auth-form-container .logo {
    font-size: 32px;             
    font-weight: bold;    
    color: #559fde;           
    letter-spacing: 2px; 
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    display: inline-block;
    padding: 10px 20px;
    border-radius: 5px;
    transition: all 0.3s ease; 
      text-align: center;
      filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
    }

    .back-button {
      display: inline-flex;
      align-items: center;
      color: #127fb1;
      text-decoration: none;
      font-weight: bold;
      margin-bottom: 1rem;
      transition: color 0.2s;
    }

    .back-button i {
      margin-right: 0.5rem;
    }

    .back-button:hover {
      color: #0a5a7e;
    }

    h3 {
      text-align: center;
      margin: 0.5rem 0;
      color: #127fb1;
    }

    .form-group {
      margin-bottom: 1rem;
      position: relative;
    }

    .input-group {
      display: flex;
      align-items: center;
      border: 1px solid #ccc;
      border-radius: 0.25rem;
      padding: 0.45rem;
      background-color: #fff;
    }

    .input-group input {
      border: none;
      outline: none;
      flex: 1;
      padding: 0.45rem;
      font-size: 1rem;
    }

    .input-icon {
      color: #888;
      margin-right: 0.5rem;
      font-size: 1.2rem;
    }

    .password-toggle {
      color: #888;
      cursor: pointer;
      font-size: 1.2rem;
    }

    .gradient-btn {
      background: linear-gradient(90deg, #127fb1, #88cdae);
      color: #fff;
      padding: 0.75rem;
      font-size: 1rem;
      border: none;
      border-radius: 0.25rem;
      cursor: pointer;
      transition: background 0.3s;
      width: 100%;
      font-weight: bold;
    }

    .gradient-btn:hover {
      background: linear-gradient(90deg, #0a5a7e, #6bbfad);
    }

    .footer-text {
      text-align: center;
      margin-top: 1rem;
    }

    .footer-text a {
      color: #127fb1;
      text-decoration: none;
      font-weight: bold;
    }

    .footer-text a:hover {
      color: #0a5a7e;
    }

    /* Responsive Styling */
    @media (max-width: 480px) {
      .auth-form-container {
        padding: 2rem;
      }

      .input-group input {
        font-size: 0.9rem;
      }

      .gradient-btn {
        font-size: 0.9rem;
        padding: 0.6rem;
      }

      h3 {
        font-size: 1.2rem;
      }
    }
  </style>
</head>

<body>
  <main>
 


    <form class="auth-form-container" method="POST" action="<?=ROOT?>/login">
      <a href="<?=ROOT?>" class="back-button"><i class="uil uil-arrow-left"></i> Back</a>
      <div class="logo">
        <?=APP_NAME?>
      </div>
      <h3>Log In</h3>
      <p style="text-align: center;">to continue to <b><?=APP_NAME?> </b></p>

      <div class="form-group">
        <div class="input-group">
          <span class="input-icon"><i class="uil uil-envelope"></i></span>
          <input type="email" id="email" name="userEmail" value="admin@ucomfortbd.com" placeholder="Email" required>
        </div>
      </div>

      <div class="form-group">
        <div class="input-group">
          <span class="input-icon"><i class="uil uil-lock"></i></span>
          <input type="password" id="password" name="userPassword" value="@dmin1234567" placeholder="Password" required>
          <span class="password-toggle"><i class="uil uil-eye-slash"></i></span>
        </div>

        <div style="display: flex;justify-content: space-between;">
        <div style="margin-top: 0.5rem;">
          <label>
              <input type="checkbox" name="rememberMe" value="1"> Remember Me
          </label>
      </div>
        <div style="margin-top: 0.5rem;">
          <a href="<?=ROOT?>/forget-password" style="color: #127fb1;">Forgot password?</a>
        </div>
        </div>

      </div>

      <button type="submit" class="gradient-btn">Log In</button>

      <div class="footer-text">
        <p>New to <b><?=APP_NAME?></b>? <a href="<?=ROOT?>/register">Create an Account</a></p>
      </div>
    </form>
  </main>

  <script>
    const passwordInput = document.getElementById('password');
    const togglePasswordBtn = document.querySelector('.password-toggle i');
    togglePasswordBtn.addEventListener('click', function () {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      togglePasswordBtn.classList.toggle('uil-eye-slash');
      togglePasswordBtn.classList.toggle('uil-eye');
    });
  </script>
</body>

</html>
