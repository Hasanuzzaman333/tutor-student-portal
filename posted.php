<?php
session_start();
if(!isset($_SESSION['id'])){
    header('location:home.php?msg=Login first !');
}

$sub = $_POST['subject'];
$noofst = $_POST['noofstudent'];
$des = $_POST['description'];

$teacher_id = $_SESSION['id'];

echo $teacher_id.",".$des.",".$sub.",".$noofst;

try{
    include('connection.php');

    $sql = "insert into post(teacher_id,post,subject,noofseat) values (".$teacher_id.",'".$des."','".$sub."',".$noofst.")";
    $con->query($sql);

    header('location:teacher.php!');
}
catch(PDOException $ex){
    header('location:teacher.php?msg=Database Connection Error !');

}

?>