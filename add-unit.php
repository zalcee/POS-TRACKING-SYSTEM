<?php
  include("include/header.php");
  include("include/db_connection.php");

  $alert = "";
  if (isset($_POST["submit"])) {
    $pos_name = $_POST["pos_name"];
    $pos_counter = "Counter ". $_POST["pos_counter"];

    $query = "INSERT INTO pos (pos_name,pos_counter) ";
    $query .= "VALUES('$pos_name', '$pos_counter')";
    $result = mysqli_query($connection, $query);
    if ($result) {
      $alert = "POS Added successfully!";
    }
    else {
      $alert = "Error while uploading!";
    }
  }
?>


<style media="screen">
a:hover {
  text-decoration: none;
}
</style>
<div id="container-insert" style="display:block; min-height:20rem;">
  <div id="insert-pos">
    <div id="insert-header" class="bg-primary">
      <a href="index.php" onclick="close()" style="width: 30px; text-align: center; border-radius: 1rem;color:red; float:right; margin:-10px; background-color: rgba(100,200,40,1);font: 1.5rem Arial;" id="close">X</a>
      <h1>Add Machine</h1>
      <h3><?php echo $alert; ?></h3>
    </div>
    <div id="form">
      <form  action="add-unit.php" method="post">
        <div class="form-group">
          <label for="pos_name">POS Name</label>
          <input type="text" id="pos_name" class="form-control" name="pos_name" required>
        </div>
        <div class="form-group">
          <label for="pos_counter">POS Counter Number</label>
          <input type="number" id="pos_counter" class="form-control" name="pos_counter" required>
        </div>
        <div class="form-group">
          <input type="submit" class="form-control bg-primary" name="submit" value="Add">
        </div>
      </form>
    </div>
  </div>
</div>
