<?php
  include("include/header.php");
  include("include/db_connection.php");
  include("include/function.php");

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div style="width:20rem; margin: 1% auto 1% auto;  display:flex;">


    <label for="date_log" style="margin:5px; font-weight:bolder;">DATE</label>
      <input style="width:11rem;" type="date" id="date_log" class="form-control"  >
    </div>
  <table id="table">
      <tr>
        <th>DATE</th>
        <th>POS</th>
        <th>COUNTER</th>
        <th style="min-width:25rem; max-height:10rem;">REMARK</th>
        <th>STATUS</th>
      </tr>
      
    </table>
  </body>
</html>


<script type="text/javascript">
  var date_ = document.getElementById("date_log");
  date_.onchange = function() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {

        document.getElementById("table").innerHTML = this.responseText;
      }

    }
    var dat =  date_.value.split("-",10);
    var date = dat[1]+"/"+dat[2]+"/"+dat[0];
    xmlhttp.open("GET", "output.php?date="+date, true);
    xmlhttp.send();
  }
</script>
