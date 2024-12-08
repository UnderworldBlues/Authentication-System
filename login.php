<?php
// Start session
session_start();
require_once 'utils.php';
// Redirect to profile if logged in
if (Utils::isLoggedIn()) 
{
  Utils::redirect('profile.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.1/css/bootstrap.min.css' />
</head>
<body class="bg-dark bg-gradient">
  <div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
      <div class="col-md-5">
        <div class="card shadow">
          <div class="card-header">
            <h1 class="fw-bold text-secondary">Login</h1>
          </div>
          <div class="card-body p-5">
            <?php
            echo Utils::displayFlash('register_success', 'success');
            echo Utils::displayFlash('login_error', 'danger');
            ?>
            <form action="action.php" method="POST">
              <input type="hidden" name="login" value="1">
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
              </div>
              <div class="mb-3">
                <a href="forgot.php">Forgot Password?</a>
              </div>
              <div class="mb-3 d-grid">
                <input type="submit" value="Login" class="btn btn-primary">
              </div>
              <p class="text-center">Don't have an account? <a href="/register.php">Register</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>