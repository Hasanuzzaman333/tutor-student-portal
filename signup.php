<?php
    session_start();
if($_SERVER['REQUEST_METHOD']=="GET"){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign up</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body{
            background-color: #EEEEEE;
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
    </div>
</nav>

<div class="container">
    <h2>Please Insert Your Info:</h2>
    <form class="form-horizontal" action="signup.php" method="post">
        <div class="form-group">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-8">
                <input class="form-control" id="name" type="text" name="name" placeholder="name" required>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-8">
                <input class="form-control" id="password" name="password" type="password" placeholder="password" required>
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-8">
                <input class="form-control" id="email" name="email" type="text" placeholder="email" required>
            </div>
        </div>
        <div class="form-group">
            <label for="contact" class="col-sm-2 control-label">Contact</label>
            <div class="col-sm-8">
                <input class="form-control" id="contact" name="contact" type="text" placeholder="contact" required>
            </div>
        </div>

        <div class="form-group">
            <label  class="col-sm-2 control-label">Select</label>
            <div class="col-sm-8">
                <div class="radio">
                    <label><input type="radio" value="teacher" onchange="teacherfunc();" name="option" >Teacher</label>
                </div>
                <div class="radio">
                    <label><input type="radio" value="student" onchange="studentfunc();" name="option">Student</label>
                </div>
            </div>
        </div>

        <div id="te" style="display: none;">
            <div class="form-group">
                <label for="back" class="col-sm-2 control-label">Background</label>
                <div class="col-sm-8">
                    <input class="form-control" id="background" name="background" type="text" placeholder="background" >
                </div>
            </div>
        </div>

        <div id="st" style="display: none;">
            <div class="form-group">
                <label for="class" class="col-sm-2 control-label">Class</label>
                <div class="col-sm-8">
                    <input class="form-control" id="class" name="class" type="text" placeholder="class" >
                </div>
            </div>
        </div>

        <div class="form-group">
            <label  class="col-sm-2 control-label"></label>
            <div class="col-sm-8">
                <button type="submit" name="submit" class="btn btn-success">Sign up</button>
            </div>
        </div>



    </form>
</div>

<script>
    function teacherfunc() {
        var x = document.getElementById("te");
        var y = document.getElementById("st");
        if (x.style.display === "none") {
            x.style.display = "block";
            y.style.display = "none";
        }
    }
    function studentfunc() {
        var x = document.getElementById("st");
        var y = document.getElementById("te");
        if (x.style.display === "none") {
            x.style.display = "block";
            y.style.display = "none";
        }
    }
</script>

<?php
}
else if($_SERVER['REQUEST_METHOD']=="POST"){
    $c = mysqli_connect( 'localhost', 'root','', 'tsp' );
    if(isset($_POST['submit']) && isset($_POST['option'])){

        if($_POST['option'] == 'teacher') {
            $sql = "insert into teacher (name,email,password,contact,background) values ('".$_POST['name']."','".$_POST['email']."','".$_POST['password']."','".$_POST['contact']."','".$_POST['background']."')";
            if ($c->query($sql) === TRUE) {
                $last_id = $c->insert_id;
                $_SESSION["id"] = $last_id;
                $_SESSION["name"] = $_POST['name'];
                $_SESSION["option"] = 'teacher';

                header('location:home.php?msg=Signup Successfully !');
            } else {
                header('location:home.php?msg=Signup failed !');
            }
        }
        else{
            $sql = "insert into student (name,email,password,contact,class) values ('".$_POST['name']."','".$_POST['email']."','".$_POST['password']."','".$_POST['contact']."','".$_POST['class']."')";
            if ($c->query($sql) === TRUE) {
                $_SESSION["id"] = $row["id"];
                $_SESSION["name"] = $row["name"];
                $_SESSION["option"] = 'student';

                header('location:home.php?msg=Signup Successfully !');
            } else {
                header('location:home.php?msg=Signup failed !');
            }
        }
    }
}

?>

</body>
</html>

