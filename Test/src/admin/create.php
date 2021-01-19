<?php
require '../config/config.php';
if (isset ($_POST['name'])  && isset($_POST['entry']) && isset($_POST['out']) ) {
  $name = $_POST['name'];
  $entry = $_POST['entry'];
  $out = $_POST['out'];
  $sql = 'INSERT INTO reservation_villa(nom, entry_date, out_date) VALUES(:name, :entry, :out)';
  $statement = $dbh->prepare($sql);
  if ($statement->execute([':name' => $name, ':entry' => $entry, ':out' => $out])){
    header("location:../config/session.php");
  }
}
 ?>