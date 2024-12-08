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
  <title>Password Reset</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.1/css/bootstrap.min.css' />
</head>
<body class="bg-success bg-gradient">
  <div class="container">
    <div class="row min-vh-100 justify-content-center align-items-center">
      <div class="col-lg-5">
        <div class="card shadow">
          <div class="card-header">
            <h1 class="fw-bold text-secondary">Password Reset</h1>
          </div>
          <div class="card-body p-5">
            <?php
            echo Utils::displayFlash('reset_error', 'danger');
            echo Utils::displayFlash('reset_success', 'success');
            ?>
            <form action="action.php" method="POST">
              <input type="hidden" name="reset" value="1">
              <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
              <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
              </div>
              <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" id="confirm_password" required>
              </div>
              <div class="d-grid">
                <input type="submit" class="btn btn-danger" value="Reset Password">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>