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
    <title>Student</title>
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
            if($_SESSION['option'] == 'student')
                echo "<li><a href='joinedcourses.php'>Joined Courses</a></li>";
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

<div >
    <div class=" text-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">

                </div>
                <div class="col-sm-8" style="border: solid 1px #5cb85c; border-radius: 12px; background-color: lightgray;">
                    <div class="postbox">
                        <form action="posted.php" method="POST" name="postform" class="form-horizontal">
                            <div class="form-group">
                                <label for="search" class="col-sm-2 control-label">Search</label>
                                <div class="col-sm-8">
                                    <input class="form-control" onkeyup="filersearch();" id="search" name="search" type="text" placeholder="search" required>
                                </div>
                                <select id="select" name="sas" style="width: 180px;height: 40px;background-color: #3eb4c1; margin-top: 5px">
                                    <option value="subject">Subject</option>
                                    <option value="teacher">Teacher</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-2 control-label"></label>
                                <div class="col-sm-8">
                                    <button type="submit" name="post" class="btn btn-success">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-2">

                </div>
            </div>
        </div>
    </div>
</div>

<div class="showpost">
    <div class=" text-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">

                </div>
                <div class='col-sm-8' id='postvalue'>



                    <?php /*
                    include('connection.php');

                    $sql = "select post.*,teacher.name,teacher.email,teacher.contact,teacher.background from post CROSS JOIN teacher on post.teacher_id = teacher.id where post.teacher_id = ".$_SESSION['id']." and teacher.id = ".$_SESSION['id']." ORDER BY post.id DESC";
                    $res = mysqli_query($con,$sql);


                    while($row = $res->fetch_assoc()){
                        echo "<div style='margin-top: 5px;border: solid 1px #5cb85c; border-radius: 70px; background-color: #85929E;'>";
                        echo "<div class='postshow'>";
                        echo "<h3>".$row['name']."</h3>";
                        echo "<h4>".$row['background']."</h4>";
                        echo "<h4>".$row['email']."</h4>";
                        echo "<h4>Subject :".$row['subject']."</h4>";
                        echo "<h4>Total Seat :".$row['noofseat']."</h4>";
                        echo "</div>";
                        //echo "<div class='downpost'>";
                        echo "<button onclick=\"document.location='deletepost.php?id=".$row['id']."';\" class=\"btn downpost1\"><i class=\"fa fa-trash\"></i> Trash</button>";
                        echo "<button class=\"w3-button w3-xlarge w3-circle w3-teal downpost2\">+Join</button>";
                        //echo "</div>";
                        echo "</div>";

                    }
*/
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


<script>
    function filersearch() {
        //var sel = document.getElementById('select').value;

        var xhttp=new XMLHttpRequest();
        xhttp.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                document.getElementById('postvalue').innerHTML=this.responseText;
            }
        }
        xhttp.open("GET","searchpost.php?search="+document.getElementById('search').value+"&sel="+document.getElementById('select').value,true);
        xhttp.send();
    }

</script>


</body>
</html>
