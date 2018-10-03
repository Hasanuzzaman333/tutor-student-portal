<?php

$sub = $_POST['sub'];
$noofst = $_POST['noofst'];
$des = $_POST['des'];

echo '<script>';
echo 'console.log("abc")';
echo '</script>';

$teacher_id = 2;

$responsestr = "";

try{
    include('connection.php');

    $sql = "insert into post(teacher_id,post,subject,noofseat) value (".$teacher_id.",'".$des."','".$sub."',".$noofst.")";
    $con->query($sql);

    //$sql = "select * from post";
    //$res = mysqli_query($con,$sql);

    //while($row = $res->fetch_assoc()){
        $responsestr ="<div style='margin-top: 5px;border: solid 1px #5cb85c; border-radius: 70px; background-color: #85929E;'><div class='postshow'><h3>Hasanuzzaman</h3><h4>BSc in cse</h4><h4>".$sub."</h4><h4>".$noofst."</h4></div></div>";

    //}

    //$responsestr = "<div style='margin-top: 5px;border: solid 1px #5cb85c; border-radius: 70px; background-color: #85929E;'><div class='postshow'><h3>Hasanuzzaman</h3><h4>BSc in cse</h4><h4>".$sub."</h4><h4>".$noofst."</h4></div></div>";


   echo $responsestr;


}
catch(PDOException $ex){
    echo "AJAX Database Connection Error";
}










/*
if(isset($_GET['sub']) && isset($_GET['noofstudent']) && isset($_GET['description'])){
    $sub = $_GET['sub'];
    $noofstudent = $_GET['noofstudent'];
    $description = $_GET['description'];

    echo "<script> alart(".$noofstudent.$description.$sub.")</script>";
}

try{
    include('connection.php');

    $sql = "insert into post(teacher_id,post,subject,noofseat) value (".$teacher_id.",'".$description."','".$sub."','".$noofstudent."')";
    $con->query($sql);

    /*$sql2 = "select * from post";
    $res = mysqli_query($con,$sql2);

    $responsestr = "<div class='postshow'>";
    while($row = $res->fetch_assoc()){
        $responsestr = $responsestr."<h3>Hasanuzzaman</h3><h4>BSc in cse</h4><h4>".$row['subject']."</h4><h4>".$row['noofseat']."</h4>";
    }
    $responsestr = $responsestr."</div>";

    echo $responsestr;


}
catch(PDOException $ex){
    echo "AJAX Database Connection Error";
}
*/
?>