<?php

session_start();
if(!isset($_SESSION['id'])){
    header('location:home.php?msg=Login first !');
}

include('connection.php');
if($_SERVER['REQUEST_METHOD']=="POST"){
    $temp = "";

    if(isset($_POST["teacher"] )) {

        if (!empty($_POST["email"]) && !empty($_POST["password"])) {
            $sql = "SELECT * FROM teacher";
            $res = mysqli_query($con, $sql);
            while ($row = $res->fetch_assoc()) {
                if ($row["email"] == $_POST["email"] && $row["password"] == $_POST["password"]) {
                    $_SESSION["id"] = $row["id"];
                    $_SESSION["name"] = $row["name"];
                    $_SESSION["option"] = 'teacher';

                    header('location:home.php?msg=sign in successfully !');
                    Die();
            }
            }
            header('location:home.php?msg=sign in failed !');
        }
    }
    else{
        if (!empty($_POST["email"]) && !empty($_POST["password"])) {
            $sql = "SELECT * FROM student";
            $res = mysqli_query($con, $sql);
            while ($row = $res->fetch_assoc()) {

                if ($row["email"] == $_POST["email"] && $row["password"] == $_POST["password"]) {
                    $_SESSION["id"] = $row["id"];
                    $_SESSION["name"] = $row["name"];
                    $_SESSION["option"] = 'student';
                    header('location:home.php?msg=sign in successfully !');
                    Die();
                }

            }
            header('location:home.php?msg=sign in failed !');
        }
    }

}


?>
