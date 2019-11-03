<?php
  include("include/db_connection.php");

  $result_per_page = 10;
  $query_pagination = "SELECT * FROM pos_data";
  $result_pagination = mysqli_query($connection, $query_pagination);
  $number_of_result = mysqli_num_rows($result_pagination);
  $number_of_pages = ceil($number_of_result/$result_per_page);
  if (!isset($_GET["page"])) {
    $page = ($_GET["page"]=1);
  }
  else {
    $page = $_GET["page"];
  }
  $this_page_per_result = ($page-1)*$result_per_page;


  $get_pos_query = "SELECT * FROM pos WHERE pos_id='$_GET[pos]'";
  $get_pos_result = mysqli_query($connection, $get_pos_query);
  $get_row_pos = mysqli_fetch_array($get_pos_result);
  $header = $get_row_pos[1];





  if (isset($_POST["update"])) {
    $pos_data_id = $_POST["pos_data_id"];
    $date = $_POST["date_update"];
    $remark = $_POST["remark_update"];
    $status = $_POST["status_update"];

    $query_update = "UPDATE pos_data SET ";
    $query_update .= "date='$date', remark='$remark', status='$status' ";
    $query_update .= "WHERE pos_data_id='$pos_data_id'";
    $result_update = mysqli_query($connection, $query_update);
    if ($result_update) {

    }
    else {
      ?>
        <script type="text/javascript">
          alert("Failed!");
        </script>
      <?php
    }
  }


  if (isset($_POST["submit"])) {
    $pos = $_GET["pos"];
    $date = $_POST["date"];
    $remark = $_POST["remark"];
    $status = $_POST["status"];

    $query_add = "INSERT INTO pos_data(pos_id,date,remark,status) ";
    $query_add .= "VALUES('$pos','$date','$remark','$status')";
    $result_add = mysqli_query($connection, $query_add);
    if ($result_add) {
      // code...
    }
    else {
      ?>
        <script type="text/javascript">
          alert("failed!");
        </script>
      <?php
    }
  }
  $pos_id = $_GET["pos"];
  $query_get = "SELECT * FROM pos_data WHERE pos_id=".$_GET["pos"]." ORDER BY pos_data_id DESC ";
  $query_get .= "LIMIT ".$this_page_per_result . ",". $result_per_page ;
  $result_get = mysqli_query($connection, $query_get);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.min.css">
    <script type="text/javascript" src="js/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="a076d05399.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <meta charset="utf-8">
    <title>POS Tracking System</title>
  </head>
  <body>
    <nav class="navbar bg-primary" id="header">
      <a href="index.php"> <h1><?php echo $header; ?></h1></a>
      <p><?php //echo date("Y/m/d h:i:sa") ?></p>
    </nav>

    <table id="table">
      <tr>
        <th>DATE</th>
        <!-- <th>POS</th> -->
        <th >REMARK</th>
        <th>STATUS</th>
        <th></th>
      </tr>
      <?php
        while ($row = mysqli_fetch_array($result_get)) {
          ?>
          <tr>
            <td><?php echo $row[2]; ?></td>
            <td style="max-width:40rem; max-height:10rem;"><?php echo $row[3] ?></td>
            <td><?php echo $row[4]; ?></td>
            <td> <button type="button" name="button" onclick="edit('<?php echo $row[0].",/+-".$row[2].",/+-".$row[3].",/+-".$row[4];?>')">Edit</button> </td>
          </tr>
          <?php
        }
      ?>
      <tr>
        <form class="" action="pos.php?pos=<?php echo $_GET["pos"]; ?>" method="post" id="add">
          <td> <input type="text" name="date" value="<?php echo date("m/d/Y"); ?>"> </td>
          <!-- <td><input class="form-control" type="text" name="" value=""></td> -->
          <td> <textarea name="remark" rows="2" cols="50" required></textarea></td>
          <td>
            <select class="form-control" name="status">
              <option value="Pending">Pending</option>
              <option value="fixed <?php echo date("m/d/Y"); ?>">Fixed </option>
              <option value="Need Replacement">Need Replacement</option>
            </select>
        </td>
        <td> <input class="form-control bg-primary text-dark" type="submit" name="submit" value="Add"> </td>
        </form>
      </tr>
      <tr>
        <td colspan="4">
          <div id="pagination">
            <ul class="pagination pagination-sm">
              <?php
                if ($_GET["page"] <= 1) {
                  ?>
                    <li class="page-item disabled" > <a href="#" class="page-link">Previous</a> </li>
                  <?php
                }
                else {
                  ?>
                    <li class="page-item" > <a href="pos.php?pos=<?php echo $_GET["pos"]."&page=".($_GET["page"]-1) ?> " class="page-link">Previous</a> </li>
                  <?php
                }
                for ($page=$_GET["page"]-4; $page <$_GET["page"] ; $page++) {
          				if ($page>0) {
          					?>
                      <li class="page-item" > <a href="pos.php?pos=<?php echo $_GET["pos"]."&page=".($page) ?> " class="page-link"><?php echo $page; ?></a> </li>
                    <?php
          				}
          			}


                if ($number_of_result == 0 || $number_of_result == 1) {
                  echo "";
                }
                else {
                  ?>
                    <li class="page-item" > <a style="background-color:rgba(0,123,255,1); color:#fff;" href=""class="page-link bg-default"><?php echo $_GET["page"]; ?></a> </li>
                  <?php
                }

                for ($i=$page+1; $i <= $number_of_pages; $i++) {
                  ?>
                    <li class="page-item"> <a class="page-link" href="pos.php?pos=<?php echo $_GET["pos"]."&page=".$i; ?>"><?php echo $i; ?></a> </li>
                  <?php
                }







                if ($number_of_pages>$_GET["page"]) {
                  ?>
                    <li class="page-item"> <a href="pos.php?pos=<?php echo $_GET["pos"]."&page=".($_GET["page"]+1) ?> " class="page-link">Next</a> </li>
                  <?php
                }
                else {
                  ?>
                    <li class="page-item disabled"><a href="" class="page-link">Next</a> </li>
                  <?php
                }
              ?>
            </ul>
          </div>
        </td>
      </tr>
      <!--     -->
    </table>





    <div id="container-insert" onclick="close(this)">
      <div id="insert-pos1">
        <div id="insert-header" class="bg-primary">
          <p href="" style="width: 30px; text-align: center; border-radius: 1rem;color:red; float:right; margin:-10px; background-color: rgba(100,200,40,1);font: 1.5rem Arial;" id="close">X</p>
          <h1>Update</h1>
        </div>
        <div id="form">
          <form  action="pos.php?pos=<?php echo $_GET["pos"]."&page=".$_GET["page"]; ?>" method="post">
            <div class="form-group">
              <input type="hidden" id="pos_data_id" value=""  class="form-control"  name="pos_data_id" required>
            </div>
            <div class="form-group">
              <label for="pos_name">Date</label>
              <input type="text" id="date" class="form-control" name="date_update" required>
            </div>
            <div class="form-group">
              <label for="remark">Remark</label><br>
              <textarea id="remark" class="control-form"name="remark_update" rows="2" cols="50"></textarea>
            </div>
            <div class="form-group">
              <label for="pos_counter">Status</label>
              <select id="status" class="form-control" name="status_update">
                <option value="Pending">Pending</option>
                <option value="fixed <?php echo date("m/d/Y"); ?>">Fixed </option>
                <option value="Need Replacement">Need Replacement</option>
              </select>
            </div>
            <div class="form-group">
              <input type="submit" class="form-control bg-primary" name="update" value="Update">
            </div>
          </form>
        </div>
      </div>
    </div>

    <script type="text/javascript">
    var close = document.getElementById("close");
    close.onclick = function() {
      document.getElementById("container-insert").style.display = "none";
    }

    function edit(value) {
      document.getElementById("container-insert").style.display = "block";

      var x =  value.split(",/+-",1000);
      document.getElementById("pos_data_id").value = x[0];
      document.getElementById("date").value = x[1];
      document.getElementById("remark").value = x[2];
      document.getElementById("status").value = x[3];
    }
    function close() {
      this.style.display = "none";
    }
    </script>
  </body>
</html>
