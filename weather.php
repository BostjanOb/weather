<?php

require 'bootstrap.php';

try {
    $date = \Carbon\Carbon::parse($_GET['day'] ?? 'now');
} catch (\Exception $e) {
    die($e->getMessage());
}

$sql = 'SELECT * FROM weather WHERE created_at BETWEEN :start AND :end';

$sth = $db->prepare($sql);
$sth->execute([
    ':start' => $date->startOfDay()->toDateTimeString(),
    ':end' => $date->endOfDay()->toDateTimeString()
]);
$all = $sth->fetchAll(PDO::FETCH_OBJ);

header('Content-Type: application/json');
echo json_encode($all);
