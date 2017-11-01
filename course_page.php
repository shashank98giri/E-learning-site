
<!DOCTYPE html>
<html lang="en">
<head>
    <title>LearnX</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Acme' rel='stylesheet'>
<style type="text/css">
html,body{
    margin: 0px;
    
    background-repeat: no-repeat;
    
}
.opaque-navbar {
    background-color: rgba(0,0,0,0.5);
  /* Transparent = rgba(0,0,0,0) / Translucent = (0,0,0,0.5)  */
    height: 60px;
    border-bottom: 0px;
    transition: background-color .5s ease 0s;
}

.opaque-navbar.opaque {
    background-color: black;
    height: 60px;
    transition: background-color .5s ease 0s;
}

ul.dropdown-menu {
    background-color: black;
}
/*.about{
    background-image:url("b1.jpg");
    z-index: 3;
    width:auto;
    
    background-repeat: no-repeat;
}*/
.add{
    text-align: left;
}
li:hover{
	color: gray;
}
</style>
</head>
<body>

<?php
    session_start();
    $server="localhost";
    $user="root";
    $password="";$db="learnX";
    $conn=mysqli_connect($server,$user,$password,$db);
    $cid=$_SESSION['course_id'];
    $course_name="";$description="";$ins_name="";$contents="";$no_student;$duration;
    $sql="select * from Account inner join (Instructor inner join (Courses inner join Creates on Creates.course_id=Courses.course_id) 
    on Instructor.acct_id=Creates.acct_id) on Account.acct_id=Instructor.acct_id where Courses.course_id=$cid;";
    $row=mysqli_query($conn,$sql);
    $ele=mysqli_fetch_assoc($row);
    $course_name=$ele["course_name"];
    $description=$ele["description"];
    $ins_name="Professor ".$ele["first_name"]." ".$ele["last_name"];
    $contents=$ele["contents"];
    $duration=$ele["duration"];$cid=$ele["course_id"];
    $no_student=mysqli_fetch_assoc(mysqli_query($conn,"select count(acct_id) from Enrolls where course_id='$cid'"))["count(acct_id)"];
    ?>

<nav class="navbar navbar-inverse navbar-fixed-top opaque-navbar">
    <div class="container-fluid">

        <!-- Logo -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavBar">
                <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand" class="active">LearnX</a>
        </div>

        <!-- Menu Items -->
        <div class="collapse navbar-collapse" id="mainNavBar">
            <ul class="nav navbar-nav">
                <li><a href="homepage.php">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
          </ul>

     <ul class="nav navbar-nav pull-right">
      <li><a href="signin.html">Sign up</a></li>
      <li><a href="login.html">Log in</a></li>
      </ul>
    </div>
    </div>
</nav>
<div class="container-fluid">
    <p class="about" style="margin-top:55px;margin-left:20px;text-indent: 50px;padding-left: 5px;">
         <img src="b1.jpg" style="padding: 5px;float: left;" /><b style="font-size: 400%;color:LIGHTSTEELBLUE;text-indent:50px;margin-bottom: 0px" id="course_name">
             <?php echo $course_name?>
         </b>
    <br></p>
    <p style="font-size: 220%;padding:10px;font-family: 'Acme'" id="description"> <?php echo $description?></p>
    <input type="checkbox" name="enroll" onclick="myfunction()"  /><b style="font-size: 120%;color: red">I agree to all terms and conditions</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button type="button" class="btn btn-primary" style="visibility: hidden;" >ENROLL ME</button>
</div>
<br>
<div class="row">
<div  class="col-sm-6 topics">
    <p style="font-family:'Acne';font-size:150%;padding:20px" >TOPICS :<br><span id="contents"><?php echo $contents?>;</span></p>
</div>
<div class="col-sm-3"><p style="margin-left: 20px;font-size: 150%">Instructor</p>
<div style="padding-left:5px;"><p style="color: steelblue;margin-left: 20px"><b style="font-size: 150%" ><?php echo $ins_name?></b><br><b style="font-size: 120%;color:#FF00FF">Department of Computer Science</b><br>IIT INDORE</p></div></div>
    <div class="col-sm-3"><div style="border:1px solid black;margin:10px;">
        <p style="padding: 2px;margin-bottom: 0px;margin-left: 30px;font-size: 120%" ><img src="clock.png" style="margin-right: 15px" >Length:&nbsp;&nbsp;&nbsp;<span id="duration"><?php echo $duration." Weeks"?></span>
        <hr style="color: black;margin:2px;width:85%;margin-left: 20px">
        <p style="padding: 2px;margin-bottom: 0px;margin-left: 30px;font-size: 120%"><img src="graduation-cap.png"><?php echo "Subject : ".$ele["subject"]?></p><hr style="color: black;margin:2px;width:85%;margin-left: 20px">
        <p style="padding: 2px;margin-bottom: 0px;margin-left: 30px;font-size: 120%"><img src="comment-o.png">Languages:English</p><hr style="color: black;margin:2px;width:85%;margin-left: 20px">
        <p style="padding: 2px;margin-bottom: 0px;margin-left: 30px;font-size: 120%"><img src="bank.png">Institution:IIT INDORE</p><hr style="color: black;margin:2px;width:85%;margin-left: 20px">
        <p style="padding: 2px;margin-bottom: 0px;margin-left: 30px;font-size: 120%"><img src="tag-fill.png">Price:FREE<br>Add a Verified Certificate at a cost of 2,000 Rupees </p>      
        <hr style="color: black;margin:2px;width:85%;margin-left: 20px">
        <p style="padding: 2px;margin-bottom: 0px;margin-left: 30px;font-size: 120%">Total Number of Students:<span id="no_student"><?php echo $no_student?></span><br> </p>
        <hr style="color: black;margin:2px;width:85%;margin-left: 20px">
        <p style="padding: 2px;margin-bottom: 0px;margin-left: 30px;font-size: 120%">Prerequisite: <?php echo $ele["prerequisite"]?> </p>               
    </div></div>
</div>
  <script src="jquery-3.2.1.js"></script>
<script>
 $(window).scroll(function() {
    if($(this).scrollTop() > 50)  /*height in pixels when the navbar becomes non opaque*/ 
    {
        $('.opaque-navbar').addClass('opaque');
    } else {
        $('.opaque-navbar').removeClass('opaque');
    }
});
  function myfunction(){
if(!($("input[type='checkbox']").is(':checked')))
{
$("button").css("visibility","hidden");
// $(this).css("font-size","200%");
}
else{
    $("button").css("visibility","visible");
}}

    
    $("button").click(function(){
        window.location.assign("enroll.php");
        
    })
    

</script>

</body>
</html>
