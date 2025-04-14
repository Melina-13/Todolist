<?php
$host = "localhost";
$dbname = "to_do_list";
$username = "root"; 
$password = ""; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // recupération des tâches
    $stmt = $pdo->query("SELECT task, status FROM tasks");
    $tasks = [
        "todo" => [],
        "done" => []
    ];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row["status"] === "todo") {
            $tasks["todo"][] = $row["task"];
        } else {
            $tasks["done"][] = $row["task"];
        }
    }

    // envoi des données JSON
    echo json_encode($tasks);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
