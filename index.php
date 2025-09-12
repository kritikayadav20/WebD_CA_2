<?php
require 'classes/Todo.php';
$pdo = new PDO('mysql:host=127.0.0.1;dbname=todos', 'root', '');

$query = 'SELECT * FROM todos';

$statement = $pdo->prepare($query);

$statement->execute();

$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

$todos = [];

foreach ($rows as $row) {
    $todo = new Todo($row['description'], $row['due_date']);
    if ($row['is_completed']) {
        $todo->markAsCompleted();
    }
    $todos[] = $todo;
}

require 'views/index.html';