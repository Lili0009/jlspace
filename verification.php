<?php

$error= ' ';
include("includes/dbh.inc.php");

if(isset($_POST['Verify'])){

   $digit1 = $_POST['digit1'];
   $digit2 = $_POST['digit2'];
   $digit3 = $_POST['digit3'];
   $digit4 = $_POST['digit4'];

   $code = $digit1.$digit2.$digit3.$digit4;


$interval = 5;
$select_cus = mysqli_query($con, "SELECT * FROM `customers` where cidCustomer = '$uname'");

if(mysqli_num_rows($select_cus) > 0){
      while($fetch_cus = mysqli_fetch_assoc($select_cus)){

      $vcode=$fetch_cus['verification_code'];
      $vcodecreate=$fetch_cus['verification_code_inserted_at'];



function TimeAgo ($oldTime, $newTime) {
$timeCalc = strtotime($newTime) - strtotime($oldTime);
if($timeCalc > 0){
    $timeCalc .= " seconds ago";
  }
return $timeCalc;
}

//Connecting Database
$date = date("Y-m-d H:i:s",strtotime($vcodecreate));

$timeago =TimeAgo($fetch_cus['verification_code_inserted_at'], date("Y-m-d H:i:s"));
      if($code == $vcode && $timeago > 60){
          $error=2;
      }else if($code == $vcode ){
          $update_query = mysqli_query($con, "UPDATE `customers` SET verification_status = 1 WHERE cidCustomer = '$uname'");
          if($update_query){
              header("Location: ../login.php");
          };
      }else{
          $error=1;
      }
}
}


}

$codesent = 0;

if(isset($_POST['Resend'])){

       $randomnum = rand(1231,7879);
       $datenow = date("Y-m-d H:i:s");

       $select_cus = mysqli_query($con, "SELECT * FROM `customers` where cidCustomer = '$uname'");

        if(mysqli_num_rows($select_cus) > 0){
              while($fetch_cus = mysqli_fetch_assoc($select_cus)){
             $email=$fetch_cus['email'];
            }
          }

        $to_email = $email;
        $subject = "Your Verification Code";
        $body = "Hi ".$uname.", Your Verification Code is ".$randomnum;
        $headers = "From: siaa311project@gmail.com";

        mail($to_email, $subject, $body, $headers);

        $update_query = mysqli_query($con, "UPDATE `customers` SET verification_code = '$randomnum',verification_code_inserted_at='$datenow' WHERE cidCustomer = '$uname'");

        if($update_query){
        $codesent = 1;
         }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Verification</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    /* Your CSS styles */
    /* Box sizing rules */
    *,
    *::before,
    *::after {
      box-sizing: border-box;
    }

    /* Remove default margin */
    body,
    h1,
    h2,
    h3,
    h4,
    p,
    figure,
    blockquote,
    dl,
    dd {
      margin: 0;
    }

    ul[role="list"],
    ol[role="list"] {
      list-style: none;
    }

    /* Set core root defaults */
    html:focus-within {
      scroll-behavior: smooth;
    }

    /* Set core body defaults */
    body {
      min-height: 100vh;
      text-rendering: optimizeSpeed;
      line-height: 1.5;
      background: #A67051;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    /* A elements that don't have a class get default styles */
    a:not([class]) {
      text-decoration-skip-ink: auto;
    }

    /* Make images easier to work with */
    img,
    picture {
      max-width: 100%;
      display: block;
    }

    /* Inherit fonts for inputs and buttons */
    input,
    button,
    textarea,
    select {
      font: inherit;
      outline: none; /* Remove blue outline */
    }

    /* Remove all animations, transitions and smooth scroll for people that prefer not to see them */
    @media (prefers-reduced-motion: reduce) {
      html:focus-within {
        scroll-behavior: auto;
      }

      *,
      *::before,
      *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
        scroll-behavior: auto !important;
      }
    }

    

    body {
        font-family: "Poppins", san-serif;
    }

    .box {
      width: 330px;
      padding: 2rem 1rem;
      background-color: #fff;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
    }

    h1 {
      font-size: 1.5rem;
      color: #07001f;
      margin-bottom: 1.2rem;
    }

    p {
      font-size: 0.7rem;
      color: #A67051;
    }

    a {
      font-weight: bold;
      text-decoration: none;
      color: var(--clr-accent, #385b4f);
    }

    .code {
      display: flex;
      gap: 0.5em;
      justify-content: center;
      margin-block: 2em;
    }

    input {
      width: 3rem;
      height: 3rem;
      border-radius: 0.7em;
      text-align: center;
      font-size: 1.5rem;
      font-weight: bold;
      border: 1px solid #d3d3d3;
      -moz-appearance: textfield; /* Firefox */
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    input:focus {
      border-color: var(--clr-accent, #304eff);
      caret-color: transparent;
    }

    label {
      position: relative;
    }

    label input:focus + span {
      width: 1.5em;
      height: 2px;
      display: block;
      position: absolute;
      bottom: 0.5em;
      left: 50%; /* Center the blue line */
      transform: translateX(-50%);
      background-color: var(--clr-accent, #304eff);
      animation: 750ms infinite alternate blink;
    }

    button {
      font-size: 1rem;
      margin-top: 1.0rem;
      padding: 10px 0;
      border-radius: 20px;
      outline: none;
      border: none;
      width: 90%;
      color: #fff;
      cursor: pointer;
      background: #A67051;
    }

    button:hover {
      background: #a9a9a9;
    }

    .timer {
      font-size: 0.7rem; 
      margin-top: 0.5rem; 
      color: var(--clr-accent, #636363); 
    }

    .resend-text {
      font-size: 0.7rem;
      color: black;
      margin-top: 1rem;
    }

     .signuperror {
      color: red;
      font-size: 0.7rem;
      margin-top: 1.4rem;
  }

  </style>
</head>
<body>
  <div class="box">
    <h1>VERIFY YOUR EMAIL</h1>
    <p>A verification code has been sent to your email.</p>
        <form class = "form-sign-up" action = "" method = "post">
      <div class="code">
        <label for="digit1"><input type="text" id="digit1" name="digit1" maxlength="1" oninput="validateInput(event, 1)" onkeyup="moveToNextInput(event, 1)" onkeydown="deleteInput(event, 1)"><span></span></label>
        <label for="digit2"><input type="text" id="digit2" name="digit2"  maxlength="1" oninput="validateInput(event, 2)" onkeyup="moveToNextInput(event, 2)" onkeydown="deleteInput(event, 2)"><span></span></label>
        <label for="digit3"><input type="text" id="digit3" name="digit3" maxlength="1" oninput="validateInput(event, 3)" onkeyup="moveToNextInput(event, 3)" onkeydown="deleteInput(event, 3)"><span></span></label>
        <label for="digit4"><input type="text" id="digit4" name="digit4" maxlength="1" oninput="validateInput(event, 4)" onkeyup="moveToNextInput(event, 4)" onkeydown="deleteInput(event, 4)"><span></span></label>
      </div>

      <div class="cta"><button  type="submit"  name = "Verify">Verify</button></div><br>
            <?php
        if($error == 1){
          echo '<p class = "signuperror">Invalid Code</p>';
        }else if($error == 2){
          echo '<p class = "signuperror">Code Expired</p>';
        }else if($codesent == 1){
          echo '<p class = "signup-success">Verification Code Successfully Sent!</p>';
        }
      ?>


    </form>
     <form class = "form-sign-up" action = "" method = "post">
    <p class="resend-text">Didn't receive the code? <button  style="background-color: transparent;padding:0px;    font-size: 0.7rem;
    color: #385b4f;margin-top:0px;font-weight: bold;" type="submit"  name = "Resend">Resend</button></p>
  </form>
    <div class="timer" id="timer"></div>
  </div>

  <script>
    function validateInput(event, index) {
      const target = event.target;
      const value = target.value;
      target.value = value.replace(/\D/g, ''); // Remove non-digit characters
    }

    function moveToNextInput(event, index) {
      const target = event.target;
      const maxLength = parseInt(target.getAttribute('maxlength'));
      const currentLength = target.value.length;

      if (currentLength >= maxLength && index < 4) {
        const nextInput = document.getElementById('digit' + (index + 1));
        nextInput.focus();
      }
    }

    function deleteInput(event, index) {
      if (event.code === "Backspace" && index > 1) {
        const target = event.target;
        const value = target.value;
        if (value === '') {
          const previousInput = document.getElementById('digit' + (index - 1));
          previousInput.focus();
        }
      }
    }

    // Countdown timer
    const timerElement = document.getElementById('timer');
    let remainingTime = 60; 

    function updateTimer() {
      const minutes = Math.floor(remainingTime / 60);
      const seconds = remainingTime % 60;
      timerElement.textContent = `Time remaining: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
      remainingTime--;

      if (remainingTime < 0) {
        clearInterval(timerInterval);
        timerElement.textContent = 'Time expired';
      }
    }

    updateTimer(); // Call it initially
    const timerInterval = setInterval(updateTimer, 1000); // Update every second
  </script>
</body>
</html>