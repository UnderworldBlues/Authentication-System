<?php
// Session start
session_start();
require_once 'utils.php';
// Redirect to profile page if user is already logged in
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
  <title>Register</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.1/css/bootstrap.min.css' />
</head>
<body class="bg-dark bg-gradient">
  <div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-header">
            <h1 class="fw-bold text-secondary">Register</h1>
          </div>
          <div class="card-body p-5">
            <?php
            // Display error message if any
            echo Utils::displayFlash('register_error', 'danger');
            ?>
            <form action="action.php" method="POST">
              <input type="hidden" name="register" value="1">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
              </div>
              <div class="mb-3 d-grid">
                <input type="submit" value="Register" class="btn btn-primary">
              </div>
              <p class="text-center">Already have an account? <a href="/">Login</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>