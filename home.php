<?php
    session_start();
    echo "<script language='javascript'>";
    echo "alert('".$_GET['msg']."')";
    echo "</script>";
    $_GET['msg'] = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .modal-header, h4, .close {
            background-color: #5cb85c;
            color:white !important;
            text-align: center;
            font-size: 30px;
        }
        .modal-footer {
            background-color: #f9f9f9;
        }
        body{
            background-color: #EEEEEE;
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


<!-- sign in modal -->
<div class="container">

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="padding:35px 50px;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
                </div>
                <div class="modal-body" style="padding:40px 50px;">
                    <form role="form" method="post" action="signin.php">
                        <div class="form-group">
                            <label for="email"><span class="glyphicon glyphicon-user"></span> Email</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="password"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="teacher" value="teacher" checked>I am a Teacher</label>
                        </div>
                        <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <p>Not a member? <a href="signup.php">Sign Up</a></p>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#myBtn").click(function(){
            $("#myModal").modal();
        });
    });
</script>



<div class="container" style="text-align: center;background-color: #85929E">
    <h3>Tutor Student Portal </h3>
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
                    if(isset($_SESSION['id'])) {
                        include('connection.php');

                        $sql = "select post.*,teacher.name,teacher.email,teacher.contact,teacher.background,(SELECT count(*) FROM interested WHERE interested.student_id =".$_SESSION['id']." and interested.post_id = post.id) as cnt from post CROSS JOIN teacher on post.teacher_id = teacher.id ORDER BY post.id DESC";
                        $res = mysqli_query($con, $sql);


                        while ($row = $res->fetch_assoc()) {
                            echo "<div style='margin-top: 5px;border: solid 1px #5cb85c; border-radius: 10px; background-color: #85929E;'>";
                            echo "<div class='postshow'>";
                            echo "<h3>" . $row['name'] . "</h3>";
                            echo "<h5>" . $row['background'] . "</h5>";
                            echo "<h5>" . $row['email'] . "</h5>";
                            echo "<h4>Subject :" . $row['subject'] . "</h4>";
                            echo "<h4>Total Seat :" . $row['noofseat'] . "</h4>";
                            echo "</div>";

                            if($_SESSION['option'] == 'student' ) {
                                if ($row['cnt'] == 0)
                                    echo "<button onclick=\"document.location='join.php?id=" . $row['id'] . "';\" class=\"w3-button w3-xlarge w3-circle w3-teal downpost2\">+Join</button>";
                                else
                                    echo "<button class=\"w3-button w3-xlarge w3-circle w3-teal downpost2\">Joined</button>";

                            }
                            echo "<button onclick=\"document.location='mail.php?mail=".$row['email']."';\" class=\"btn downpost1\"><i class=\"fa fa-email\"></i>Send mail</button>";

                            echo "</div>";

                        }
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


