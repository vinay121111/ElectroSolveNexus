<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

require_once "database.php";

$email = $_SESSION["user"];

if ($email) {
    $sql = "SELECT *FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        if ($user) {
            $fullname = $user['full_name'];
            $address=$user['address'];
            $age=$user['age'];
            $phoneno=$user['phoneno'];
        } else {
            $fullname = "Guest";
        }
    } else {
        $fullname = "Guest";
    }
} else {
    $fullname = "Guest";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    
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
    }
    .container1 p{
      font-size: 20px;
      color: white;
  
      align-items: center;
      
      text-align: center;
    }
 
    h2 {
            text-align: center; /* Center align the text */
            font-family: Arial, sans-serif; /* Set font */
            color:black;
        }
        .indent {
            margin-left: 30px; /* Adjust indentation as needed */
            display: inline-block; /* Ensures margin applies correctly */
        }
        .indent-2 {
            margin-left: 50px;
            display: inline-block;
        }
        .indent-3 {
            margin-left: 40px;
            display: inline-block;
        }
     #logout{
      margin-top:20px;
  width: 80px;
  margin-left:48%;
  align-items:center;
  padding:7px;

  padding-inline:10px; 
  background-color: #0f95f0;
 box-shadow:1px 1px 7px black;
  height: 25px;
outline:none;
border-radius:1px;
border:none;
text-decoration:none;
color:white;
cursor: pointer;
     }

     #cart-view{
      margin-top:0%;
  width: 80px;
  margin-left:48%;
  align-items:center;

  padding:7px;

  padding-inline:10px; 
  background-color: #0f95f0;
 box-shadow:1px 1px 7px black;
  height: 25px;
outline:none;
border-radius:1px;
border:none;
text-decoration:none;
color:white;
cursor: pointer;
     }
     .profile-container{
      width: 400px;
      height:250px;
      align-items:center;
      margin-left:33%;
      box-shadow:1px 1px 5px white;
     }
     .profile-container h3{
      text-align:center;
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
      
        <h1 style="margin-left:30%">Welcome to Dashboard,<span style="color:#7036c9;"><?php echo htmlspecialchars($fullname); ?></span> !</h1>
        <div class="profile-container"> <br>
        <h3 style="color:red" >Profile Information</h3>
        <h3>
          <?php echo  'Name:'. htmlspecialchars($fullname);
           echo '<p >age:'.htmlspecialchars($age).'</p>';
          echo '<p>phoneNo:'.htmlspecialchars($phoneno).'</p>';
        echo '<p>Address:'. htmlspecialchars($address).'</p>'; 
       
        ?></span> 
       

        </h3>
          
        </div>
       
      
        <h2 style="color:#ff4500; margin-bottom:0px;"> Enjoy shopping or find solutions with us     </h2>
    </div>
   
    <br><br>
    <div >
    <a href="addcart.html" id="cart-view" ><i class="ri-luggage-cart-line"></i>View Cart</a> <p></p>
    <a href="logout.php" id="logout">Logout</a>

    </div>
   
    <h2>
        <span class="indent"></span>"
        In the world of e-commerce,<br>
        <span class="indent-2"></span>
        ElectroSolve Nexus believes<br>
        <span class="indent"></span>
        our customers are our<br>
        <span class="indent-3"></span>
        greatest asset."<br>
    </h2>

<!-- footer -->
  
<footer>
  <div class="container1">
<p>© 2024 ElectroSolve Nexus. All rights reserved.</p>
  </div>
</footer>
</body>
</html>
