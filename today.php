<?php
    include("include/db_connection.php");
    include("include/header.php");
    $date = date("m/d/Y");
    $query = "SELECT date,  remark, status, pos_name, pos_counter FROM pos_data ";
    $query .= "LEFT JOIN pos ON pos_data.pos_id = pos.pos_id ";
    $query .= "WHERE date='$date'";
    $result = mysqli_query($connection, $query);
?>

<table id="table">
  <tr>
    <th>DATE</th>
    <th>POS</th>
    <th>COUNTER</th>
    <th >REMARK</th>
    <th>STATUS</th>
  </tr>
  <?php
    while ($row = mysqli_fetch_array($result)) {
      ?>
      <tr>
        <td><?php echo $row["date"]; ?></td>
        <td><?php echo $row["pos_name"] ?></td>
        <td><?php echo $row["pos_counter"] ?></td>
        <td style="min-width:25rem; max-height:10rem;"><?php echo $row["remark"] ?></td>
        <td><?php echo $row["status"]; ?></td>

      </tr>
      <?php
    }
  ?>

</table>
