<?php
session_start();
if(!isset($_SESSION['id'])){
    header('location:home.php?msg=Login first !');
}
include('connection.php');

if(isset($_GET['id'])){
    $sql = "delete from post where id =".$_GET['id'];
    $con->query($sql);
    header('location:teacher.php?msg=Post deleted successfully !');
}
else{
    header('location:teacher.php?msg=Operation failed !');
}

?>
