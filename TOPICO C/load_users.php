<?php
include('conectiondb.php');

$query = "SELECT username FROM users";  // Ajuste o nome da coluna se necessário
$result = $conn->query($query);

$users = array();

while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode($users);

$conn->close();
?>
