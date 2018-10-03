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
    <title>Send Mail</title>
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
                <div class="col-sm-8" style="border: solid 1px #5cb85c; background-color: lightgray;">
                    <div class="postbox">
                        <form action="send_mail.php?mail=<?php echo $_GET['mail'];?>" method="POST" name="postform" class="form-horizontal">

                            <div class="form-group">
                                <label for="to" class="col-sm-2 control-label">To</label>
                                <div class="col-sm-8">
                                    <input class="form-control" value="<?php echo $_GET['mail'];?>" id="to" name="to" type="text" placeholder="to" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Subject</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="subject" type="text" name="subject" placeholder="subject" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="message" class="col-sm-2 control-label">Message</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="message" name="message" type="text" placeholder="message" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <label  class="col-sm-2 control-label"></label>
                                <div class="col-sm-8">
                                    <button type="submit" name="send" class="btn btn-success">Send</button>
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


<footer>
    <p>Copyright © 2008 Design Shack</p>
</footer>


</body>
</html>
