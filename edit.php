
<?php
require 'database/db.php';
require 'classes/Todo.php';

$pdo = db_connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['id']) || empty($_POST['description']) || empty($_POST['due_date'])) {
        $errorMessage = "All fields are required";
    } else {
        $fields = [
            'description' => $_POST['description'],
            'due_date' => $_POST['due_date']
        ];
        $conditions = [
            'id' => $_POST['id']
        ];
        $updated = db_update($pdo, 'todos', $fields, $conditions);
        if ($updated) {
            $successMessage = "Todo updated successfully";
        }
    }
    $row = db_fetch_one($pdo, 'todos', ['id' => $_POST['id']]);
} else {
    $row = db_fetch_one($pdo, 'todos', ['id' => $_GET['id']]);
}

if ($row) {
    $todo = new Todo($row['description'], $row['due_date']);
    if ($row['is_completed']) {
        $todo->markAsCompleted();
    }
    $todo->id = $row['id'];
}

require 'views/edit.html';