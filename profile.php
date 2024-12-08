<?php
require_once 'utils.php';
// check if user is logged in or not and redirect to login page
session_start();

if (!Utils::isLoggedIn()) 
{
  Utils::redirect('./');
}
// get user from session
$user = null;

if (isset($_SESSION['user'])) 
{
  $user = $_SESSION['user'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.1/css/bootstrap.min.css' />
</head>
<body class="bg-success bg-gradient">
  <div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
      <div class="col-lg-5">
        <div class="card shadow">
          <div class="card-header">
            <h2 class="fw-bold text-secondary">User Profile</h2>
          </div>
          <div class="card-body p-5">
            <table class="table table-striped table-bordered">
              <tr>
                <th>Name</th>
                <td><?php echo $user['name']; ?></td>
              </tr>
              <tr>
                <th>Email</th>
                <td><?php echo $user['email']; ?></td>
              </tr>
              <tr>
                <th>Created At</th>
                <td><?php echo $user['created_at']; ?></td>
              </tr>
              <tr>
                <th>Updated At</th>
                <td><?php echo $user['updated_at']; ?></td>
              </tr>
            </table>
          </div>
          <div class="card-footer px-5 text-end">
            <a href="action.php?logout=1" class="btn btn-dark">Logout</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>