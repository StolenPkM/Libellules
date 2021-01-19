<?php
require '../config/config.php';
$id = $_POST['id'];
echo $id;
echo "<br>";
$sql = 'SELECT * FROM reservation_villa WHERE id=:id';
$statement = $dbh->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
var_dump($person);
echo "<br>";
echo $name;
echo $entry;
echo $out;
if  (isset($_POST['name'])  && isset($_POST['entry']) && isset($_POST['out'])) {
    $name = $_POST['name'];
    $entry = $_POST['entry'];
    $out = $_POST['out'];
  $update = 'UPDATE reservation_villa SET nom=:name, entry_date=:entry, out_date=:out WHERE id=:id';
  $statement = $dbh->prepare($update);
  if ($statement->execute([':name' => $name, ':entry' => $entry, ':out' => $out, ':id' => $id])) {
    header("Location:../config/session.php");
  }
}
 ?>