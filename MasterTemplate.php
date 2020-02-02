<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Johnson's Johnson</title>
    <!--Latest compiled and minified CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!--jQuery library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Latest compiled ad minified CSS-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Site specific Cascaing Stylesheet -->
    <link rel="stylesheet" href="css/site.css" />
	<!-- Load font awesome icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- The social media icon bar -->
	<div class="icon-bar">
	<a href="https://www.facebook.com/" class="facebook"><i class="fa fa-facebook"></i></a> 
	<a href="https://twitter.com/" class="twitter"><i class="fa fa-twitter"></i></a> 
	<a href="https://www.linkedin.com/in/khenghin/?originalSubdomain=sg" class="linkedin"><i class="fa fa-linkedin"></i></a>
	</div>
  </head>
  <body>
  <style>
  
  /* Fixed/sticky icon bar (vertically aligned 50% from the top of the screen) */
.icon-bar {
  position: fixed;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
}

/* Style the icon bar links */
.icon-bar a {
  display: block;
  text-align: center;
  padding: 16px;
  transition: all 0.3s ease;
  color: white;
  font-size: 20px;
}

/* Style the social media icons with color, if you want */
.icon-bar a:hover {
  background-color: #000;
}

.facebook {
  background: #3B5998;
  color: white;
}

.twitter {
  background: #55ACEE;
  color: white;
}

.linkedin {
  background: #007bb5;
  color: white;
}

.carousel-inner img 
{
	 opacity: 1;
	 display: block;
	 width: 30%;
	 height: 30%;
	 transition: .5s ease;
	 backface-visibility: hidden;
	 }
.carousel-item:hover .image
{
	opacity: 0.5;	
}
.carousel-item:hover .middle
{
	opacity: 1;	
}
.text {
  color: black;
  font-size: 16px;
}
.text1 {
  color: black;
  font-size: 20px;
}
.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 90%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}
.top {
  transition: .5s ease;
  opacity: 1;
  position: absolute;
  top: 10%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}
.bg { 
  /* The image used */
  background-image: url("Images/baby.jpg");

  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.carousel-control-next,
.carousel-control-prev {
    filter: invert(100%);
}
  </style>
    <div class="container">
      <!-- 1st Row-->
      <div class="row">
	  <div class="col-sm-12">
	  <a href = "index.php">
	  <img src = "Images/johnson.jpg" alt ="Logo"
	  class = "img-fluid" style = "width:100%"/></a>
	  </div>
	  </div>
      <!--2nd Row-->
      <div class="row">
	  <div class ="col-sm-12">
	  <?php include ("navbar.php");?>
	  </div>
	  </div>
      <!--3rd Row-->
      <div class="row">
	  <div class ="col-sm-12" style="padding:15px;">
	  <?php echo $MainContent;?>
	  </div>
	  </div>
      <!--4th Row-->
      <div class="row">
	  <div class ="col-sm-12" style ="text-align:right;">
	  <hr/>
	  Do you need help? Please email to:
	  <a href="mailto:mamaya@np.edu.sg">johnson@np.edu.sg</a>
	  <p style = "font-size:12px">&copy;Copyright by Johnson Group</p>
	  </div>
    </div>
  </body>
</html>
