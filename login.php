<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: profile.php");
    exit();
}

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    require_once "database.php";
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        if ($user) {
            if (password_verify($password, $user["password"])) {
                $_SESSION["user"] = $email;
                header("Location: profile.php");
                exit();
            } else {
                echo "<div class='alert'>Password does not match</div>";
            }
        } else {
            echo "<div class='alert'>Email does not exist</div>";
        }
    } else {
        echo "<div class='alert'>Failed to prepare the SQL statement</div>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>

  <link rel="icon " type="x-icon" href="images/41d2d539-248b-4588-bbfd-a93eee5fec37-modified.png">
<link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet"
/>
<link rel="preconnect" href="https://fonts.googleapis.com">
  <style>
    body{
      margin: 0;
      background-color:gainsboro;
      opacity:  background-color 0.2;
    }
    header{
      background-color: rgba(7, 86, 86, 0.961);
      margin-bottom: 0;
      padding: 0;
      max-width: 100%;
    }
    header h1{
      margin: 0;
     padding: 20px;
     color: white;
     display: flex;
     font-weight: bold;
   margin-left: 20px;
    }
    header .container{
      margin: 0;
      display: flex;
      align-items: center;
      margin: 0 auto;
      justify-content: space-between;
    }

    nav a li{
      float: left;
    padding-right: 10px;
      list-style-type: none;
     
      color: white;
      
      display: flex;
      cursor: pointer;
    }
    nav {
      align-items: center;
display: flex;
margin-right: 10px;
    }
    nav i{
      padding: 3px;
      color: white;
      font-size: 18px;
      cursor: pointer;
    }
    li.drop-down{
      display: inline;
      text-decoration: none;
     
    }
    li a{
      text-decoration: none;
      color: white;
      font-size: 17px;
      cursor: pointer;
    }
.dropdown-content{
  background-color: #00ffeb;
  width: 300px;
  display: none;
  z-index: 1;
  height: 300px;
  position: absolute;
}
li.drop-down:hover .dropdown-content{
  display: block;
}
    .hero{
      margin: 0;
      padding: 0;
      max-width: 12000px;
      padding: 60px;
    background-image: url(images/herobackground.jpg);
    background-repeat: no-repeat;
      text-align: center;
     background-size: cover;
font-weight: bold;



      line-height: 20px;
    }
    .header{
      color: black;
      margin: 0;
      font-size: 2rem;
      
     text-shadow: 2px 2px 1px #8ca659;;
    }
 
    .tagline1{
      color: black;
      font-size: 28px;
       font-family: "PT Serif", serif,arial;
  font-weight: 900; 
  font-style: normal;
      text-shadow: 2px 2px 1px #8ca659;
    }



/* footer style */
    footer{
      padding: 5px;
      width: 100%;
      background-color: rgba(7, 86, 86, 0.961);
      align-items: center;
      position: absolute;
      bottom: 0%;
    }
    .container1 p{
      font-size: 20px;
      color: white;
  
      align-items: center;
      
      text-align: center;
    }
 

     
  </style>
</head>
<body>
<header>
    <div class="container">
   
     
<h1>ElectroSolve Nexus</h1>

<nav>
  <i class="ri-home-line" ></i>
  <a href="index.html">
    
    <li>Home</li>
  </a>
  <i class="ri-shopping-cart-line"></i>
  <a href="#">
<li class="drop-down">
<a href="shop.html">Shop now</a>

 
</li>
<div>

</div>
  </a>
  <i class="ri-tools-fill"></i>
  <a href="solution.html">
    <li>Solutions</li>
  </a>

  <i class="ri-group-line"></i>
  <a href="aboutus.html">
    <li>About us</li>
  </a>

  <i class="ri-login-box-line"></i>
  <a href="login.php">
    <li>Login
    </li>
     </a>
</nav>
    </div>
  </header>
  <div class="container">
    <?php
    if(isset($_POST["login"])){
      $email=$_POST["email"];
      $password=$_POST["password"];
      require_once "database.php";
      $sql= "SELECT *FROM users WHERE email='$email'";
      $result=mysqli_query($conn,$sql);
      $user=mysqli_fetch_array($result,MYSQLI_ASSOC);
      if($user){
// to verify the password whether matching or not

if(password_verify($password,$user["password"])){
  session_start();
  $_SESSION["user"]="yes";

  header('Location:profile.php');
  die();
}else{
  echo "<div class='alert'>password does not exists</div>";


}
      }else{
        echo "<div class='alert'>email does not exists</div>";

      }


    }
    ?>

<style>
  .alert{
    color:Red;
    margin-top:20px !important;
    margin:0px;
    margin-left:30%;
 
    width: 500px;
    padding:0px;
    font-size:20px;
    align-items: center;
      
      text-align: center;
    border:none;
    
  }
  .formcontainer{
    width: 500px;
  
    margin-left:30%;
    height:250px;
    align-items: center;
      
      text-align: center;
    border:1px solid black;
  }
 #email{
margin-top:20px;
  width: 200px;

  height:20px;
outline:none;

border:1px solid black;
 }
 #password{
margin-top:20px;
  width: 200px;

  height:20px;
outline:none;
cursor:text;
border:1px solid black;
 }
 #login{
margin-top:20px;
  width: 80px;
  background-color: #0f95f0;
 box-shadow:1px 1px 7px black;
  height: 25px;
outline:none;
border-radius:5px;
border:none;
cursor: pointer;
 }
 #text-container {  color:black;
  cursor: text;
  font-size:16px; 

  text-decoration: none;
 }
 #text-container1 {  color:red;
  font-size:16px; 

  text-decoration: none;
 }
 #text-container1:hover{ 

  text-decoration: underline;
  cursor:pointer;
  text-decoration-color:purple;
 }


</style>
 <br> <br>
 <div class="formcontainer">
<h2>Login Form</h2>
   <form id="form-container" action="login.php" method="post">
<div class="form-group">
  <b>  Email: </b><span style="margin-left:10px"></span><input type="email" name="email" id="email" placeholder="Enter Email">
</div>
<div class="form-group">
  <b>Password:</b><input type="password" name="password" id="password" placeholder="Enter password">
</div>
<div class="form-btn">
  <input type="submit" value="Login" id="login" name="login">
</div>

    </form>
    <a id="text-container" href="registration.php">
    <p >Don't have account...? <span id="text-container1"  >Register now</span></p>
    </a>
    
</div>
  </div>

<!-- footer -->
  
<footer>
  <div class="container1">
<p>© 2024 ElectroSolve Nexus. All rights reserved.</p>
  </div>
</footer>

</body>
</html>