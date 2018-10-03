<?php
    session_start();
    if(isset($_GET['id'])){
        include('connection.php');
        $sql = "select teacher_id from post where id = ".$_GET['id'];
        $res = mysqli_query($con,$sql);
        $teacher_id = "";
        while($row = $res->fetch_assoc()){
            $teacher_id = $row['teacher_id'];
        }

        $responseText = "";
        $sql = "insert into interested(student_id,teacher_id,post_id) values(".$_SESSION['id'].",".$teacher_id.",".$_GET['id'].")";
        $con->query($sql);

        $sql = "select count(*) as cnt from interested where teacher_id=".$teacher_id." and post_id=".$_GET['id'];
        $res = mysqli_query($con,$sql);
        $total = "";
        if ($row = $res->fetch_assoc()) {
            $total = $row['cnt'];
        };

        header('location:joinedcourses.php?msg=Successfully Joined !');
    }


?>