<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
        <ul class="nav navbar-nav navbar-right">
            <li><a id="myBtn" href="#">Sign in</a></li>
            <li><a href="signup.php">Sign up</a></li>
        </ul>
        <form class="navbar-form navbar-right" action="/action_page.php">
            <div class="form-group">

                <input type="text" class="form-control" placeholder="Search" name="search">
            </div>
            <button type="submit" class="btn btn-default">Search</button>
        </form>
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
                    <form onsubmit="posted()" method="POST" name="postform" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Subject</label>
                            <div class="col-sm-8">
                                <input class="form-control" id="subject" type="text" name="subject" placeholder="subject" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="noofstudent" class="col-sm-2 control-label">No of students</label>
                            <div class="col-sm-8">
                                <input class="form-control" id="noofstudent" name="noofstudent" type="text" placeholder="No of student" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-8">
                                <input class="form-control" id="description" name="description" type="text" placeholder="Description" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label  class="col-sm-2 control-label"></label>
                            <div class="col-sm-8">
                                <button type="submit" name="post" class="btn btn-success">Post</button>
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


                    <!--/*echo "<div class='postshow'>";
                    echo "<h3>Md.Hasanuzzaman</h3>";
                    echo "<h4>BSc in cse</h4>";
                    echo "<h4>Subject: ICT</h4>";
                    echo "<h4>Capacity: 10</h4>";
                    echo "</div>";
                    */ -->

                 </div>
                <div class="col-sm-2">

                </div>

            </div>
        </div>
    </div>
</div>

<script>

    function posted(){
        let sub = document.forms['postform'][0].value;
        let noofst = document.forms['postform'][1].value;
        let des = document.forms['postform'][2].value;

        if(sub != null && noofstudent != null && des != null){

            let data = new FormData();

            data.append('sub',sub);
            data.append('noofst',noofst);
            data.append('des',des);

            let url = 'signin.php';

            var req=new XMLHttpRequest();
            req.onreadystatechange=function(){
                if(this.readyState==4 && this.status==200){
                    //document.getElementById('postvalue').innerHTML += "abcdefghi";
                    //let txt = this.responseText;

                    //location = window['teacher.php'];
                    //window.location.reload();
                    reloadpg();


                }
            };

            //req.open("POST","posted.php?sub="+document.getElementById('subject').value+"noofstudent="+document.getElementById('noofstudent').value+"description="+document.getElementById('description').value,true);
            req.open("POST","posted.php",true);
            req.send(data);


        }
    }
    function reloadpg(){
        alert("post successfully !");
        location.reload(true);
    }



</script>

<?php

    include('connection.php');

    try{
        $sql = "select * from post ORDER BY id DESC";
        $res = mysqli_query($con,$sql);

        $responsestr = "";
        while($row = $res->fetch_assoc()){
            $responsestr = $responsestr."<div style='margin-top: 5px;border: solid 1px #5cb85c; border-radius: 70px; background-color: #85929E;'><div class='postshow'><h3>Hasanuzzaman</h3><h4>BSc in cse</h4><h4>".$row['subject']."</h4><h4>".$row['noofseat']."</h4></div></div>";
        }


        echo "<script> document.getElementById('postvalue').innerHTML=\"$responsestr\";</script>";
    }catch(PDOException $ex){
        echo "<script>console.log('can\'t connect to database);</script>";
    }


?>

</body>
</html>