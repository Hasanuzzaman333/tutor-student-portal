<?php
session_start();
if(!isset($_SESSION['id'])){
    header('location:home.php?msg=Login first !');
}
if(isset($_GET['msg'])){
    echo "<script language='javascript'>";
    echo "alert('".$_GET['msg']."')";
    echo "</script>";

    $_GET['msg'] = "";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Join List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .postbox{
            padding: 10px;
        }
        body{
            background-color: #EEEEEE;
        }
        .showpost{
            margin: 5px;

        }
        .postshow{
            margin-left: 40px;
            margin-right: 40px;
            margin-top: 5px;
            margin-bottom: 5px;
            border: 2px solid cornflowerblue;
            border-radius: 12px;
            background-color: #85929E;
        }
        footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;

            background-color: #777;
            padding: 10px;
            text-align: center;
            color: white;
        }
        #postvalue{
            margin-bottom: 60px;
        }
        .downpost2{
            margin-left: 20px;
            margin-right: 20px;
        }
        .downpost1 {
            background-color: DodgerBlue;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            padding: 12px 16px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="home.php">TS Portal</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="home.php">Home</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <?php
        echo '<ul class="nav navbar-nav navbar-right">';

        if(isset($_SESSION['id'])){

            echo "<li><a href='";if($_SESSION['option'] == 'teacher'){echo 'teacher.php';}else{echo 'student.php';} echo "'>".$_SESSION['name']."</a></li>";
            echo "<li><a href='logout.php'>Logout</a></li>";

        }
        else{
            echo "<li><a id='myBtn' href='#'>Sign in</a></li>";
            echo "<li><a href='signup.php'>Sign up</a></li>";
        }
        echo "</ul>";
        ?>

    </div>
</nav>

<div class="container" style="text-align: center;background-color: #85929E">
    <h3>Interested Student For Course <?php echo $_GET['subject'];?></h3>
    <p>Find your tutor or tuition easily!</p>
</div>

<div class="showpost">
    <div class=" text-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">

                </div>
                <div class='col-sm-8' id='postvalue'>
                    <?php
                    include('connection.php');
                    $post_id = $_GET['id'];

                    $sql = "select * from student where student.id in(select student_id from interested where interested.post_id =".$post_id." )";
                    $res = mysqli_query($con,$sql);

                    while($row = $res->fetch_assoc()){
                        echo "<div style='margin-top: 5px;border: solid 1px #5cb85c; border-radius: 10px; background-color: #85929E;'>";
                        echo "<div class='postshow'>";
                        echo "<h3>".$row['name']."</h3>";
                        echo "<h4>".$row['class']."</h4>";
                        echo "<h4>".$row['email']."</h4>";
                        echo "<h4>Contact :".$row['contact']."</h4>";
                        echo "</div>";
                        echo "<button onclick=\"document.location='mail.php?mail=".$row['email']."';\" class=\"btn downpost1\"><i class=\"fa fa-email\"></i>Send mail</button>";
                        echo "</div>";

                    }

                    ?>
                </div>
                <div class="col-sm-2">

                </div>

            </div>
        </div>
    </div>
</div>

<footer>
    <p>Copyright © 2008 Design Shack</p>
</footer>


</body>
</html>
