<!-- Your signup form -->
<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Signup</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet"/>
  <link rel="stykesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
 
<style type="text/css">
  *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", san-serif;
  }
 
  body{
    background: #A67051;
  }
 
  .wrapper{
    width: 1000px;
    padding: 2rem 1rem;
    margin: 30px auto;
    background-color: #fff;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
  }
 
  h1{
    font-size: 2rem;
    color: #07001f;
    margin-bottom: 1.2rem;
  }
 
  form input{
    width: 60%;
    outline: none;
    border: 1px solid #fff;
    padding: 12px 20px;
    margin-bottom: 10px;
    border-radius: 20px;
    background: #e4e4e4;
    
  }
 
  button{
    font-size: 1rem;
    margin-top: 1.8rem;
    padding: 10px 0;
    border-radius: 20px;
    outline: none;
    border: none;
    width: 90%;
    color: #fff;
    cursor: pointer;
    background: #385b4f; 
  }
  button:hover{
    background: #A9A9A9;
  }
  input:focus{
    border: 1px solid rgb(192, 192, 192)
  }
  .terms{
    margin-top: 0.2rem;
  }
  .terms input{
    height: 1em;
    width: 1em;
    margin-top: 0.6rem;
    vertical-align: middle;
    cursor: pointer;
  }
  .terms label{
    font-size: 0.7rem;
  }
  .terms a{
    color: #385b4f;
    text-decoration: none;
  }
  .member{
    font-size: 0.8rem;
    margin-top: 1.4rem;
    color: #636363;
  }
  .member a{
    color: #385b4f;
    text-decoration: none;
  }

  .signuperror {
      color: red;
      font-size: 0.7rem;
      margin-top: 1.4rem;
  }

  .signup-success {
      color: green;
      font-size: 0.7rem;
      margin-top: 1.4rem;
  }

  .terms input:required {
  border-color: red;
  }
  </style>
 
  <div class="wrapper">
    <h1>SIGN UP</h1>
 
    <form class = "form-sign-up" action = "includes/signup.inc.php" method = "post">
      <input id="text" type="text" name="fname" placeholder = " Firstname" required><br><br>
      <input id="text" type="text" name="lname" placeholder = " Lastname" required><br><br>
      <input id="text" type="text" name="uname" placeholder = " Username" required><br><br>
      <input id="text" type="email" name="email" placeholder = "Email" required><br><br>
      <input id="text" type="number" name="phone" placeholder = "Phone Number" required pattern="[0-9]{11}" oninvalid="this.setCustomValidity('Enter 11 Digits Number')" oninput="this.setCustomValidity('')"><br><br>
      <input id="text" type="text" name="address" placeholder = "Address" required><br><br>
      <input id="text" type="password" name="password" placeholder = "Password" required><br><br>
      <input id="text" type="password" name="repassword" placeholder="Confirm Password" required><br><br>
      <div class="terms">
      <input type="checkbox" id=checkbox>
      <label for="checkbox">I agree to the <a href="#" id="terms-link">Terms & Conditions</a>.</label>
      
      </div>
      
      <?php
      if(isset($_GET['error'])){
 
        if($_GET['error'] == "emptyfields"){
          echo '<p class = "signuperror">Fill in all fields</p>';
        }
        else if($_GET['error'] === "username_short") {
          echo '<p class="signuperror">Username must be at least 5 characters long.</p>';
        }
        else if($_GET['error'] == "invalididuid"){
          echo '<p class = "signusignuperrorperrro">Invalid Username and Email</p>';
        }
        else if($_GET['error'] == "invalidmail"){
          echo '<p class = "signuperror">Invalid Email</p>';
        }
        else if($_GET['error'] == "passwordcheck"){
          echo '<p class = "signuperror">Your password do not match!</p>';
        }
        else if ($_GET['error'] == "invalidpassword") {
          echo '<p class="signuperror">Your password must be at least 8 characters long and include a number, an uppercase letter, a lowercase letter, and a special character.</p>';
        }
        else if($_GET['error'] == "usertaken"){
          echo '<p class = "signuperror">Username is already taken</p>';
        }
        else if($_GET['error'] == "emailtaken"){
          echo '<p class = "signuperror">Email account already in use</p>';
        }
      }
      if(isset($_GET['signup'])){
        if($_GET['signup'] == 'success'){
          echo '<p class = "signup-success">Thank you for signing up!</p>';
        }
      }
      ?>
 
      <button type = "submit" id = "button" name = "Signup">SIGN UP</button><br><br>
      
 
      <div class="member">
        Already a member? <a href="login.php">LOGIN HERE</a><br><br>
      </div>
    </form>
  </div>
</body>
</html>
</div>

<div id="terms-popup" class="popup">
    <div class="popup-content">
        <span class="close" id="close-popup">&times;</span>
        
        <h2><center>Terms & Conditions</center></h2>

        <p><br> Welcome to JL'Space Pastries!</br></p>

           <p align="justify"><br>Orders are subject to availability, and we reserve the right to refuse or cancel any order. The quality and freshness of our pastries are of utmost importance to us, and we guarantee to provide products that meet our high standards. We are not responsible for any allergies or health issues that may arise due to the consumption of our pastries, as ingredients and allergen information are clearly provided. Payment is due in full upon ordering, and we do not offer refunds except in cases of product defects or errors on our part. We respect your privacy and handle your personal information in accordance with our privacy policy, which can be reviewed on our website.</p></br></p>
    </div>
</div>
<style>
.popup {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1;
}

.popup-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 15px;
    cursor: pointer;
}
</style>

<script>
    const termsLink = document.getElementById('terms-link');
    const termsPopup = document.getElementById('terms-popup');
    const closePopup = document.getElementById('close-popup');

    termsLink.addEventListener('click', () => {
        termsPopup.style.display = 'block';
    });

    closePopup.addEventListener('click', () => {
        termsPopup.style.display = 'none';
    });
</script>
