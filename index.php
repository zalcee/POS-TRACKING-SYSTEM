


<?php
  include("include/header.php");
  include("include/db_connection.php");

  $query = "SELECT * FROM pos";
  $result = mysqli_query($connection, $query);
  if ($result) {

  }
?>


<div id="container-add">
  <?php
    while ($row = mysqli_fetch_array($result)) {


  ?>
  <div id="unit">
      <a href="pos.php?pos=<?php echo $row[0]; ?>&page=1">
      <i class="fa fa-desktop" > </i>
      <p><?php echo $row[1]; ?></p>
    </a>
    <p><?php echo $row[2]; ?></p>
  </div>
  <?php
    }
  ?>
  </div>








<?php
  include("include/footer.php");
?>
