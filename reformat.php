<?php
  include("include/db_connection.php");
  include("include/header.php");
  include("include/function.php");
  reformat_sched($connection);
?>

<style media="screen">
  #formatted {
    background-color: rgba(255,0,0,.3);
  }
</style>

<script type="text/javascript">
var table = document.getElementById("table");
  var rows = table.getElementsByTagName("tr");
  for (i = 1; i < rows.length; i++) {
      row = table.rows[i];
      row.onclick = function(){
                        var cell = this.getElementsByTagName("td")[0];
                        var id = cell.innerHTML;
                        xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                          if (this.readyState ==4 && this.status == 200) {
                            location.reload(true);
                          }
                        }
                        xmlhttp.open("POST", "reformat_update.php", true);
                        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xmlhttp.send("pos="+id);
                    };
  }
</script>
