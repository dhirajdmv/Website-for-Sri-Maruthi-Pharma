<?php
session_start();


if(!isset($_SESSION["login"]))
{
header("Location:../login/switch.php");
exit();
}


$host="localhost"; // Host name
$username="root"; // Mysql username
$password=""; // Mysql password
$db_name="Pharmacy"; // Database name
$tbl_name="User"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

$var3=$_SESSION["myusername"];
$var4=$_SESSION['mypassword'];

$sql="SELECT * FROM $tbl_name WHERE username='$var3' and password='$var4'";
$result=mysql_query($sql);

while($row=mysql_fetch_array($result))
{
	
$aboutusername=$row["Username"];
$aboutemailid=$row["Emailid"];	
$aboutfname=$row["Fname"];
$aboutlname=$row["Lname"];
$aboutgender=$row["Gender"];
$aboutpassword=$row["Password"];	
}


if(count($_POST)>0) {
	$var6=$aboutpassword;
	
$var5=md5($_POST["newPassword"]);
$result2 = mysql_query("SELECT * from user WHERE Username='$var3'");
while($row2=mysql_fetch_array($result2))
{
if(md5($_POST["currentPassword"])==$var6) 
{
mysql_query("UPDATE user set Password='$var5' WHERE Username='$var3'");
$message = "Password Changed";

}
 
else $message = "Current Password is not correct";

}
}



?>


<!DOCTYPE html>

<html>

    <head>
        <meta charset="UTF-8">
		
		<meta name="description" content="Login page">
		
   	   <meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0">
	   
	    <title>Dashboard</title>
		
		<link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome-4.5.0/css/font-awesome.min.css">
		
		<link rel="stylesheet" type="text/css" href="dashboard.css">
		
		<script type="text/javascript" src="../assets/jquery/jquery-2.2.js"></script>
		
		<script type="text/javascript" src="dashboard.js"></script>
		
    </head>

<body>

<div id="header">

	<nav id="mainmenu">
	<ul id="menu">
	<li class="menuitem"><a class="link1" href="../aboutus/aboutus.php">About us</a></li>
	<li class="menuitem"><a class="link1" href="../pharmacy/pharmacy.php"><i class="fa fa-plus-square"></i> Pharmacy</a></li>
	<li class="menuitem"><a id="menulogo" class="link1"><img src="../img/img5.png" alt="logo"></a></li>
	<li class="menuitem"><a class="link1" href="../faqs/faqs.php">FAQS</a></li>
	<li class="menuitem"><a class="link1" href="../contact/contact.php">Contact</a></li>
	
	<div id="usermenu">
     <div><i id="icon" class="fa fa-list fa-2x"></i></div>
	 
	 <div >
	 <ul id="submenu">
	 <li id="homelink"><a>Welcome 
	 
	 <?php
	 
	 
	 if(!isset($_SESSION["login"]))
	 {
	 echo("User");
	 
	 }
	 else{
	 echo $_SESSION["myusername"];
	 }
	 ?>
	</a></li>
	 <li id="profilelink"><a href="dashboard.php" >Dashboard</a></li>
	 <li id="cartlink"><a href="../cart/cart.php" ><i id="cartlogo" class="fa fa-shopping-cart"></i><div id="carttext">Cart</div></a></li>
	 <li id="loglink"><a href="../login/switch.php" >
	 
	 <?php
	 
	 if(!isset($_SESSION["login"]))
	 {
	 echo("Login");
	 
	 }
	 else{
	 echo "Logout";
	 }
	 ?>
	 </a></li>
	 </ul>
	 </div>
	
     </div>
	
	</ul>
	
	</nav>
	
	</div>



           <div id="background">
		   
		   <div id="backdash"><div id="backdashtext">Welcome back, 
		   <?php
		   echo $_SESSION["myusername"];
		   ?>
		   !
		   </div>
		   </div>
		   
		   
		   <div id="dashheader">
		   Dashboard <i id ="dashlogo" class="fa fa-tachometer"></i>
		   </div>
		   
		   
		   <div id="dashprofile">
		  
            <div id="aboutme"><i class="fa fa-user"></i> ABOUT</div>
			<br>   
			
			<label id="g1" class="tag">First Name: </label><div id="c1"><?php echo $aboutfname;?></div>
             <label id="g2" class="tag">Last Name: </label><div id="c2"><?php echo $aboutlname;?></div>
			 
			<label id="g3" class="tag">User Name: </label><div id="c3"><?php echo $aboutusername;?></div>
             <label id="g4" class="tag">Email: </label><div id="c4"><?php echo $aboutemailid;?></div>
			 
			 <label id="g5" class="tag">Gender: </label><div id="c5"><?php echo $aboutgender;?></div>
			 
			 <form id="passwordform" name="frmChange" method="post" action="" onSubmit="return validatePassword()">
<div style="width:500px;">
<div class="message"><?php if(isset($message)) { echo $message; } ?></div>
<table id="maintable" border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">
<tr class="tableheader">
<td colspan="2">Change Password</td>
</tr>
<tr>
<td width="40%"><label>Current Password</label></td>
<td width="60%"><input type="password" name="currentPassword" class="txtField"/><span id="currentPassword"  class="required"></span></td>
</tr>
<tr>
<td><label>New Password</label></td>
<td><input type="password" name="newPassword" class="txtField"/><span id="newPassword" class="required"></span></td>
</tr>
<td><label>Confirm Password</label></td>
<td><input type="password" name="confirmPassword" class="txtField"/><span id="confirmPassword" class="required"></span></td>
</tr>
<tr>
<td colspan="2"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>
</tr>
</table>
</div>
</form>

			 
               
		  </div>
		   
		   
		   
		   
                        	
							<footer>
        <div class="footer-logo">
            <img src="../img/img4.png" alt="Medicarelogo">
        </div>
		
        <div class="footer-info">
            <div class="info-container">
                <label class="footerlabel">Company</label>
                <ul>
                    <li><a href="../aboutus/aboutus.php">About Medicare</a></li>
                    <li><a href="#">Career</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Sitemap</a></li>
                </ul>
            </div>

            <div class="info-container">
                <label class="footerlabel">Policy Information</label>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Use</a></li>
                    <li><a href="#">Return Policy</a></li>
                    <li><a href="#">Shipping Policy</a></li>
                </ul>
				
            </div>
            <div class="info-container">
                <label class="footerlabel">Need Help?</label>
                <ul>
                    <li><a href="../faqs/faqs.php">FAQS</a></li>
                    <li><a href="../contact/contact.php">Contact us </a></li>
                </ul>
				
            </div>
            <div class="info-container">
                <label class="footerlabel">Account information</label>
                <ul>
                    
                    <li><a href="../login/switch.php">
					<?php
					
					
					if(!isset($_SESSION["login"]))
				
				    {
					echo("Login");	
						
					}
					else{
						echo "Logout";
					}
					?>
					</a></li>
                  <!--  <li><a href="../register/mainregister.php">Create Account</a></li>  -->
                    <li><a href="#">Track Order</a></li>
                </ul>
            </div>
			
            <div class="info-container">
                <label class="footerlabel">Connect with Us</label>
                <ul class="social">
                    <li><a class="fbicon" href="https://facebook.com/" title="Facebook" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
                    <li><a class="twittericon" href="https://twitter.com/" title="twitter" target="_blank"><i class="fa fa-twitter-square"></i></a></li>
                    <li><a class="googleicon" href="https://plus.google.com/" title="google+" target="_blank"><i class="fa fa-google-plus-square"></i></a></li>
                    <li><a class="pinteresticon" href="https://www.pinterest.com/" title="Pinterest" target="_blank"><i class="fa fa-pinterest-square"></i></a></li>
                    <li><a class="linkedinicon" href="https://www.linkedin.com/" title="LinkedIn" target="_blank"><i class="fa fa-linkedin-square"></i></a></li>
                </ul>

        </div>
		</div>
        <div class="footer-copyright">
            <p> Copyright© 2016 Medicare. All Rights Reserved</p>
        </div>
    </footer>

							
							
                       
</div>
 
	
	
</body>

</html>
