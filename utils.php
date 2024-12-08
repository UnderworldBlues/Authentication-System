<?php
require_once 'settings.php';
class Utils 
{
  public static function sanitize($data) 
  {
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return $data;
  }
  
  public static function redirect($page) 
  {
    $home_url = BASE_URL;
    header('location: ' . $home_url . '/' . $page);
  }

  public static function setFlash($name, $message) 
  {
    if (!empty($_SESSION[$name])) {
      unset($_SESSION[$name]);
    }
    $_SESSION[$name] = $message;
  }

  public static function displayFlash($name, $type) 
  {
    if (isset($_SESSION[$name])) {
      echo '<div class="alert alert-' . $type . '">' . $_SESSION[$name] . '</div>';
      unset($_SESSION[$name]);
    }
  }

  public static function isLoggedIn() 
  {
    if (isset($_SESSION['user'])) {
      return true;
    } else {
      return false;
    }
  }
  // method to send mail
  public static function sendMail($data) 
  {
    $curl = curl_init();
    
    curl_setopt_array($curl, [
      CURLOPT_URL => "https://api.smtp2go.com/v3/email/send",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_HTTPHEADER => [
        "Accept: application/json",
        "Content-Type: application/json"
      ],
    ]);

    curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
      return false;
    } else {
      return true;
    }
  }

}