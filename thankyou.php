<!DOCTYPE html>
<html>
<head>
  <title>Thank You</title>
</head>
<style>
    h1 {
    color: green; 
}
  .popup {
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #ffebcd;
    z-index: 1;
}

.popup-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    text-align: center;
    font-family: "Poppins", san-serif;
}

button {
    padding: 10px 30px;
    font-size: 14px;
    background-color: #ffebcd;
    color: #333;
    font-weight:bold;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

</style>
<body>
  <div id="popup" class="popup">
    <div class="popup-content">
      <h1>Thank you for signing up!</h1>
      <p>You can now log in.</p>
      <button onclick="redirectToLogin()">Okay</button>
    </div>
  </div>

  <script>
    function redirectToLogin() {
      window.location.href = "login.php";
    }
  </script>
</body>
</html>

