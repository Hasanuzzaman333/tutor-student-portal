<?php
session_start();
$sql = "";
if($_GET['sel'] == 'subject'){
    $sql = "select post.*,teacher.name,teacher.email,teacher.contact,teacher.background,(SELECT count(*) FROM interested WHERE interested.student_id =".$_SESSION['id']." and interested.post_id = post.id) as cnt from post CROSS JOIN teacher on post.teacher_id = teacher.id where post.subject like '%".$_GET['search']."%'  ORDER BY post.id DESC";

}
else{
    $sql = "select post.*,teacher.name,teacher.email,teacher.contact,teacher.background,(SELECT count(*) FROM interested WHERE interested.student_id =".$_SESSION['id']." and interested.post_id = post.id) as cnt from post CROSS JOIN teacher on post.teacher_id = teacher.id where teacher.name like '%".$_GET['search']."%'  ORDER BY post.id DESC";

}

include('connection.php');
$responseText = "";
$res = mysqli_query($con,$sql);
while($row = $res->fetch_assoc()){
    $responseText = $responseText."<div style='margin-top: 5px;border: solid 1px #5cb85c; border-radius: 10px; background-color: #85929E;'>";
    $responseText = $responseText. "<div class='postshow'>";
    $responseText = $responseText. "<h3>".$row['name']."</h3>";
    $responseText = $responseText. "<h4>".$row['background']."</h4>";
    $responseText = $responseText. "<h4>".$row['email']."</h4>";
    $responseText = $responseText. "<h4>Subject :".$row['subject']."</h4>";
    $responseText = $responseText. "<h4>Total Seat :".$row['noofseat']."</h4>";
    $responseText = $responseText. "</div>";
    if($row['cnt'] == 0)
    $responseText = $responseText. "<button onclick=\"document.location='join.php?id=".$row['id']."';\" class=\"w3-button w3-xlarge w3-circle w3-teal downpost2\">+Join</button>";
    else
    $responseText = $responseText. "<button class=\"w3-button w3-xlarge w3-circle w3-teal downpost2\">Joined</button>";

    $responseText = $responseText."<button onclick=\"document.location='mail.php?mail=".$row['email']."';\" class=\"btn downpost1\"><i class=\"fa fa-email\"></i>Send mail</button>";
    $responseText = $responseText. "</div>";

}

echo $responseText;

?>
