<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  
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
      position: relative;
    
      bottom: 0%;
      top:100px;
    }
    .container1 p{
      margin-top:10px
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
</head>
<body>
  <div class="container">

  <?php
  // print_r($_POST);  this is used to check whether form is working or not

  if(isset($_POST['submit'])){
    $fullname=$_POST['fullname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $passwordRepeat=$_POST['repeat_password'];
    $phoneno=$_POST['phoneno'];
    $age=$_POST['age'];
    $address=$_POST['address'];


    // encrypt the password so that no one can see
    $passwordhash=password_hash($password,PASSWORD_DEFAULT);
    $errors=array();


  
  if(empty($fullname) or empty($email) or empty($password) or empty($passwordRepeat) or empty($address) or empty($phoneno) or empty($age)){
    array_push($errors,"All fields are required");
  }

  // to check whether user provide valid email or not 

  if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    array_push($errors,"Email is not valid");
  }

  // to check password 8 character is there or not 

  if(strlen($password)<8){
    array_push($errors,"password must be 8 characters long");

  }
  // to check wheather user enter repeat password same or not 

  if($password!==$passwordRepeat){
    array_push($errors,"password does not match");

  }
  // connect to db
  require_once"database.php";
// to check email is alredy exist or not
  $sql="SELECT *FROM users where email='$email'";

  $result=mysqli_query($conn,$sql);
  $rowCount=mysqli_num_rows($result);
  if($rowCount>0){
    array_push($errors,"Email already exists!");
  }

  // to count and display errors to the users 

  if(count($errors)>0){
    foreach($errors as $error){
      echo"<div class='alert alert-danger'>$error</div>";
    }
  }else{
      // we will insert data into database

  
      $sql="INSERT INTO users(full_name,email,password,phoneno,age,address)VALUES(?, ?, ?,?,?,?)";
      $stmt=mysqli_stmt_init($conn);
     $preparestmt= mysqli_stmt_prepare($stmt,$sql);

    if($preparestmt){
      // sss for the values are string so three s
      mysqli_stmt_bind_param($stmt,"ssssss",$fullname,$email,$passwordhash,$phoneno,$age,$address);
      mysqli_stmt_execute($stmt);
      echo"<div id='success'>your register successfully</div>";
    }else{
      die("something went wrong");
    }

    }

  }
  ?>
  

<style>
  .success{
    color:green;
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
    height:500px;
    align-items: center;
      
      text-align: left;
      margin-bottom:10px;
    border:1px solid black;
  }
  .form-group{
    margin-left:20%;
  }
 #email{
margin-top:20px;
  width: 200px;
 

  height:20px;
outline:none;

border:1px solid black;
 }
 #age{
  margin-top:20px;
  width: 200px;

  height:20px;
outline:none;
cursor:text;
border:1px solid black;
 }
 #phoneno{
  margin-top:20px;
  width: 200px;

  height:20px;
outline:none;
cursor:text;
border:1px solid black;
 }
 #address{
  margin-top:20px;
  width: 200px;

  height:20px;
outline:none;
cursor:text;
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
 #register{
margin-top:20px;
  width: 80px;
  background-color: #0f95f0;
 box-shadow:1px 1px 7px black;
  height: 25px;
  margin-left:25%;
outline:none;
border-radius:5px;
border:none;
cursor: pointer;
 }
 #text-container{ 

  font-size:16px; 
  color:black;
  
padding-left:40px !important;
  text-decoration: none;
  cursor:text;
 }
 #text-container1{ 
  color:red;  
  text-decoration: underline;
  cursor:pointer;
  text-decoration-color:purple;
 }


</style>
 <br> <br>
 <div class="formcontainer">
<h2 style="margin-left:33%">Registration Form</h2>
    <form action="registration.php" method="post">
<div class="form-group">
  <b>FullName:</b><input type="text" id="name" name="fullname" placeholder="Full Name:">
</div>
<div class="form-group">
  <b>Phone Number:</b><input type="text" name="phoneno" id="phoneno" placeholder="Enter Phone Number">
</div>
<div class="form-group">
  <b>Age:</b><input type="text" name="age" id="age" placeholder="Enter Age:">
</div>
<div class="form-group">
  <b>Address:</b><input type="text" name="address" id="address" placeholder="Enter address">
</div>
<div class="form-group">
  <b>Email:</b><input type="email" id="email" name="email" placeholder="email:">
</div>

<div class="form-group">
 <b>Password:</b><input type="password" id="password" name="password" placeholder="Password:">
</div>
<div class="form-group">
  <b>Confirm Password:</b><input type="text" name="repeat_password" id="password" placeholder="repeat_password:">
</div>


<div class="form-group">
  <input type="submit" value="Register" id="register" name="submit">
</div>
    </form>
  
  <a id="text-container" href="login.php">
    <p  style="margin-left:80px">Already  have account...? <span id="text-container1">Login now</span></p>
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