<?php
require_once 'utils.php';
require_once 'db.php';

class AuthSystem 
{
  private $db;
  public function __construct() 
  {
    session_start();
    $this->db = new Database();
  }

  public function registerUser($name, $email, $password, $confirm_password) 
  {
    $name = Utils::sanitize($name);
    $email = Utils::sanitize($email);
    $password = Utils::sanitize($password);
    $confirm_password = Utils::sanitize($confirm_password);
    if ($password !== $confirm_password) {
      Utils::setFlash('register_error', 'Passwords do not match!');
      Utils::redirect('register.php');
    } else {
      $user = $this->db->getUserByEmail($email);
      if ($user) {
        Utils::setFlash('register_error', 'Email already exists!');
        Utils::redirect('register.php');
      } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $this->db->register($name, $email, $hashed_password);
        Utils::setFlash('register_success', 'You are now registered and can login now!');
        Utils::redirect('./');
      }
    }
  }

  public function loginUser($email, $password) 
  {
    $email = Utils::sanitize($email);
    $password = Utils::sanitize($password);
    $user = $this->db->login($email, $password);
    if ($user) {
      unset($user['password']);
      $_SESSION['user'] = $user;
      Utils::redirect('profile.php');
    } else {
      Utils::setFlash('login_error', 'Invalid credentials!');
      Utils::redirect('./');
    }
  }
  
  public function logoutUser() 
  {
    unset($_SESSION['user']);
    Utils::redirect('./');
  }

  public function forgotPassword($email) 
  {
    $email = Utils::sanitize($email);
    $user = $this->db->getUserByEmail($email);
    
    if ($user) 
    {
      $token = bin2hex(random_bytes(50));
      $this->db->setToken($email, $token);
      $link = BASE_URL . '/reset.php?email=' . $email . '&token=' . $token;
      $message = '<p>Hi ' . $user['name'] . ',</p><p>Please click on the following link to reset your password:</p><p><a href="' . $link . '">' . $link . '</a></p>';
      $mailData = [
        "api_key" => MAIL_API_KEY,
        "to" => [$email],
        "sender" => "DCodeMania <documents@thehiren.com>",
        "subject" => "Reset Password",
        "text_body" => "Reset Your Password",
        "html_body" => $message
      ];
      if (Utils::sendMail($mailData)) {
        Utils::setFlash('forgot_success', 'Reset link sent to your email!');
        Utils::redirect('forgot.php');
      } else {
        Utils::setFlash('forgot_error', 'Something went wrong!');
        Utils::redirect('forgot.php');
      }

    } else {
      Utils::setFlash('forgot_error', 'Email does not exist!');
      Utils::redirect('forgot.php');
    }
  }

  public function resetPassword($token, $password, $confirm_password) 
  {
    $token = Utils::sanitize($token);
    $password = Utils::sanitize($password);
    $confirm_password = Utils::sanitize($confirm_password);
    if ($password !== $confirm_password) {
      Utils::setFlash('reset_error', 'Passwords do not match!');
      Utils::redirect('reset.php?token=' . $token);
    } else {
      $user = $this->db->getUserByToken($token);
      if ($user) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $this->db->updatePassword($user['email'], $hashed_password);
        Utils::setFlash('reset_success', 'Password reset successfully!');
        Utils::redirect('reset.php?token=' . $token);
      } else {
        Utils::setFlash('reset_error', 'Invalid token!');
        Utils::redirect('reset.php?token=' . $token);
      }
    }
  }

}

$authSystem = new AuthSystem();

if (isset($_POST['register'])) {
  $authSystem->registerUser($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirm_password']);
} elseif (isset($_POST['login'])) {
  $authSystem->loginUser($_POST['email'], $_POST['password']);
} elseif (isset($_GET['logout'])) {
  $authSystem->logoutUser();
} elseif (isset($_POST['forgot'])) {
  $authSystem->forgotPassword($_POST['email']);
} elseif (isset($_POST['reset'])) {
  $authSystem->resetPassword($_POST['token'], $_POST['password'], $_POST['confirm_password']);
}