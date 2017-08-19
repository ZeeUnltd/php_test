<?php

include ('db.php');

  if(isset($_POST['submit'])){
    $error = [];

    if(empty($_POST['fname'])){
      $error['fname']= "Plese Enter Nickname";
      echo $error['fname'];
    }else {
      $fname = mysqli_real_escape_string($db, $_POST['fname']);
    } //echo $fname = $_POST['fname'];

    if(empty($_POST['lname'])){
      $error['lname']= "Plese Enter Firstname";
      echo $error['lname'];
    }else {
      $lname = mysqli_real_escape_string($db, $_POST['lname']);
    }// echo $lname = $_POST['lname'];

    if(empty($error)){
      $query = mysqli_query($db,"INSERT INTO user(user_id,firstname,lastname) VALUES(NULL, '".$fname."' ,'".$lname."')") or die (mysqli_error($db));



      echo "Application Successful!";
      //$nm = $_SESSION['id'];
      //header("Location:home.php?success=$success");
    }
  }


  ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Test Script</title>
  </head>
  <body>
    <div class="">


    <fieldset>

    <legend>
      <h1>PHP Test File</h1>
    </legend>
    <form class="" action="" method="post">
      <p>Please Enter Your Name to Add to Database</p>
        <label for="">Nickname</label>
          <input type="text" name="fname" placeholder="Nickname">

        <label for="">Firstname</label>
          <input type="text" name="lname" placeholder="Firstname">

        <input type="submit" name="submit" value="Add to DB">

    </form>
    </fieldset>
    </div>
    <hr>

    <div class="">
    <fieldset>

    <legend>
      <h1>Login</h1>
    </legend>
    <form class="" action="" method="post">
      <p>Please Enter Your Nickname to Access DB</p>
        <label for="">Nickname</label>
          <input type="text" name="fname_in" placeholder="Nickname">
        <input type="submit" name="submit_db" value="Submit">

    </form>
    </fieldset>
    </div>
    <div class="">
      <fieldset><?php
      session_start();

      if (isset($_POST['submit_db'])){
        $err =[];

        if(empty($_POST['fname_in'])){
          $err['fname_in'] = "Please enter a Valid Nickname";
        } else {
          $fname_in = mysqli_real_escape_string($db, $_POST['fname_in']);
        }

        if(empty($err)){
          $check = mysqli_query($db, "SELECT * FROM user WHERE firstname = ('".$fname_in."')")or die (mysqli_error($db));

          if(mysqli_num_rows($check) ==1){
            $record = mysqli_fetch_array($check);

            $_SESSION['id'] = $record['user_id'];
            $_SESSION['firstname'] = $record['firstname'];
            $_SESSION['lastname'] = $record['lastname'];

            echo "<legend> <h3>Welcome Unique No:".$_SESSION['id']."</legend> Your Nickname is '".$_SESSION['firstname']."' And Your Firstname is '".$_SESSION['lastname']."'</h2>"; }
            }else {
              foreach ($err as $error) {
                echo $error;
              }
            }
          }

       ?>
        <!-- </legend> -->


      </fieldset>
    </div>






  </body>
</html>
