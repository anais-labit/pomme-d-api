<?php 

require_once 'vendor/autoload.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Document</title>
</head>
<body>

<form action="register" method="post">
  <div class="flex justify-center items-center gap-4">
  <div class="flex flex-col items-center gap-6 bg-yellow-500">
    <div class="flex gap-4">
    
    <input type="login" name="login" placeholder="login">
  </div>
  <div class="flex gap-4">
    
    <input type="password" name="password" placeholder="password">
  </div>
  <div>
    <input type="password" name="confirm_password" placeholder="confirm password">
  </div>
  <button type="submit">Login</button>
  </div>
  </div>
</body>
</html>