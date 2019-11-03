<?php
  include("include/db_connection.php");




    $pos = $_POST["pos"];
    $format = "formatted";
    $date = date("m/d/Y");
    $request = "SELECT status FROM pos_ref_sched WHERE pos_name='$pos'";
    $request_result = mysqli_query($connection, $request);
    $request_row = mysqli_fetch_array($request_result);
    if ($request_row["status"] == $format) {
      $format = "";
      $date = "";
    }





    $query = "UPDATE pos_ref_sched SET ";
    $query .= "status='$format' , date_formatted='$date' WHERE pos_name='$pos'";
    $result = mysqli_query($connection, $query);




?>
