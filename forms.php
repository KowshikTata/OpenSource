<?php
if ( isset( $_POST["submit"] ) ) {
$username = $_POST["username"];
$email =$_POST["email"];
$password=$_POST["password"];
$cpassword=$_POST["cpassword"];
		
$conn=new mysqli("localhost","root","aaa","newDB");

if($conn->conn_error)
{
echo $conn->error;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
echo "invalid email adress!!";
}
else if($password!=$cpassword)
{
echo "password and confirm password must be same";
}

else if (strlen($_POST["password"]) <= '8') {
echo "Password Must Contain At Least 8 Characters!";
}
else if(!preg_match("#[0-9]+#",$password)) {
echo "Password Must Contain At Least 1 Number!";
}
else if(!preg_match("#[A-Z]+#",$password)) {
echo "Password Must Contain At Least 1 Capital Letter!";
}
else if(!preg_match("#[a-z]+#",$password)) {
echo "Password Must Contain At Least 1 Lowercase Letter!";
} 
else
{

$sql="select * from signup where email = '$email'";
$result=$conn->query($sql);
$sql2="select * from signup where username= '$username'";
$result2=$conn->query($sql2);
if($result->num_rows>0) 
{
echo "Email Already Exists!!";
}
else if($result2->num_rows>0)
{
echo "UserName Already Exists!!";
}
else
{
$st=$conn->prepare("INSERT INTO signup(username,email,password) values(?,?,?)");
$st->bind_param("sss",$username,$email,$password);
$st->execute();
echo "Registered Successfully!!";
}
}

}


?>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">


<head>

<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
function userfocusFunction() {
  
  document.getElementById("usermsg").innerHTML = "<br>UserName must conatin 6 characters";
}

function userblurFunction() {

  document.getElementById("usermsg").innerHTML= "";
}
function emailfocusFunction() {
  
  document.getElementById("emailmsg").innerHTML = "<br>Enter Vaid Email Address";
}

function emailblurFunction() {

  document.getElementById("emailmsg").innerHTML= "";
}

function focusFunction() {
  
  document.getElementById("pwdmsg").innerHTML = "<br>Must contain 1 capital Letter <br> Must contain 1 Small Letter<br> Must contain 1 Number <br> Must contain Atleat 8 Characters";
}
function cpasswordFunction() {

  document.getElementById("cpwdmsg").innerHTML= "<br>Retype password for Confirmation";
}
function pwdblurFunction() {
    document.getElementById("pwdmsg").innerHTML= "";
}
function cpwdblurFunction() {
    document.getElementById("cpwdmsg").innerHTML= "";
}
</script>
<style>

.w3-btn,.w3-button{border:none;display:inline-block;padding:8px 16px;vertical-align:middle;overflow:hidden;text-decoration:none;color:inherit;background-color:inherit;text-align:center;cursor:pointer;white-space:nowrap}
.w3-bar{width:100%;overflow:hidden}.w3-center .w3-bar{display:inline-block;width:auto}
.w3-bar .w3-bar-item{padding:8px 16px;float:left;width:auto;border:none;display:block;outline:0}
.w3-bar .w3-dropdown-hover,.w3-bar .w3-dropdown-click{position:static;float:left}
.w3-bar .w3-button{white-space:normal}
.w3-bar-block .w3-bar-item{width:100%;display:block;padding:8px 16px;text-align:left;border:none;white-space:normal;float:none;outline:0}
.w3-bar-block.w3-center .w3-bar-item{text-align:center}.w3-block{display:block;width:100%}
.w3-black,.w3-hover-black:hover{color:#fff!important;background-color:#000!important}
.w3-bar .w3-button{white-space:normal}

body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

.input-container {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  width: 100%;
  margin-bottom: 10px;
}

.icon {
  padding: 15px;
  background: grey;
  color: white;
  min-width: 50px;
  text-align: center;
}

.input-field {
  width: 100%;
  padding: 5px;
  outline: none;
}

.input-field:focus {
  border: 2px solid #4CAF50;
}
.formcontainer{

  background: #f1f1f1;
  color: #000;
  border: 1px solid #ccc;

  padding: 5px;
  margin-top: 50px;
  margin-left:200px;
  margin-right:100px;

}


#usermsg{
color: blue;
font-size: 18px;
}
#emailmsg{
color: gold;
font-size: 18px;
}
#pwdmsg{
color: black;
font-size: 18px;
}
#cpwdmsg{
color: red;
font-size: 18px;
}
input[type=submit] {
  background-color:#4CAF50;
  color: white;
  padding: 10px;
  margin-left: 100px;
}
.w3-bar-block .w3-bar-item{width:100%;display:block;padding:8px 16px;text-align:left;border:none;white-space:normal;float:none;outline:0}
.w3-bar-block.w3-center .w3-bar-item{text-align:center}.w3-block{display:block;width:100%}
.w3-black,.w3-hover-black:hover{color:#fff!important;background-color:#000!important}
.w3-bar .w3-button{white-space:normal}
.w3-black,.w3-hover-black:hover{color:#fff!important;background-color:#000!important}


</style>
</head>
<body>


<!-- Navigation -->
<nav class="w3-bar w3-black">
  <a href="home.php" class="w3-button w3-bar-item">Home</a>
  <a href="product.php" class="w3-button w3-bar-item">Product</a>
  <a href="aboutUs.php" class="w3-button w3-bar-item">About Us</a>
  <a href="forms.php" class="w3-button w3-bar-item">Sign Up</a>
</nav>





<form action="forms.php" method="post">
<div class="formcontainer">

<h2>Sign Up</h2>
<p>Please fill in this form to create an account</p>


  <div class="input-container">
    <i class="fa fa-user icon"></i>
<input class="input-field" type="text" name="username" placeholder="User Name" min=6  onfocus="userfocusFunction()" onblur="userblurFunction()" required />
</div>
<span id='usermsg'></span><br>


  <div class="input-container">
    <i class="fa fa-telegram icon"></i>
<input class="input-field" type="email" name="email" placeholder="Email" onfocus="emailfocusFunction()" onblur="emailblurFunction()"  required />
</div>
<span id='emailmsg'></span><br>

  <div class="input-container">
    <i class="fa fa-lock icon"></i>
<input class="input-field" type="password" name="password" placeholder="Password" onfocus="focusFunction()" onblur="pwdblurFunction()" required />
</div>
<span id='pwdmsg'></span><br>

  <div class="input-container">
<i class="fa fa-lock icon"></i>    
<input class="input-field" type="password" name="cpassword" placeholder="Confirm Password" onfocus="cpasswordFunction()" onblur="cpwdblurFunction()" required />
</div>
<span id='cpwdmsg'></span><br>

<input type="checkbox" id="checkbox" name="checkbox"  required>
<label for="checkbox"> Please accept all the Terms & Conditions</label>
<input type="submit" name="submit" value="Sign Up" />
</div>
</form> 


<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-black w3-xlarge">
<center> 
 <a href="#"><i class="fa fa-facebook-official"></i></a>
  <a href="#"><i class="fa fa-pinterest-p"></i></a>
  <a href="#"><i class="fa fa-twitter"></i></a>
  <a href="#"><i class="fa fa-flickr"></i></a>
  <a href="#"><i class="fa fa-linkedin"></i></a>
  <p>&copy; SmartBuy</p>
</center>
</footer>


</body>
</html>
