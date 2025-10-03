<?php
require 'database/db.php';

$pdo = db_connect();

if (isset($_GET['id'])) {
    db_delete($pdo, 'todos', ['id' => $_GET['id']]);
}

header('Location: index.php');


