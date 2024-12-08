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
  <title>Forgot Password</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.1/css/bootstrap.min.css' />
</head>
<body class="bg-warning bg-gradient">
  <div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-header">
            <h1 class="fw-bold text-secondary">Forgot Password</h1>
          </div>
          <div class="card-body p-5">
            <?php
            echo Utils::displayFlash('forgot_error', 'danger');
            echo Utils::displayFlash('forgot_success', 'success');
            ?>
            <form action="action.php" method="POST">
              <input type="hidden" name="forgot" value="1">
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="form-control" required>
              </div>
              <div class="mb-3 d-grid">
                <input type="submit" value="Send Reset Link" class="btn btn-primary">
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