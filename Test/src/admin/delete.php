<?php
    require '../config/config.php';
    $id = intval($_GET['id']);
    $sql = 'DELETE FROM reservation_villa WHERE id=:id';
    $statement = $dbh->prepare($sql);
    if ($statement->execute([':id' => $id])) {
      header("Location:../config/session.php");
    }
?>