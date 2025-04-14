<?php
$host = "localhost";
$dbname = "to_do_list";
$username = "root"; 
$password = ""; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // recupere données JSON 
    $data = json_decode(file_get_contents("php://input"), true);

    if ($data) {
        // nettoyage de la table avant l'insertion
        $pdo->exec("DELETE FROM tasks");

        // insertion des nouvelles tâches
        $stmt = $pdo->prepare("INSERT INTO tasks (task, status) VALUES (:task, :status)");

        foreach ($data["todo"] as $task) {
            $stmt->execute(["task" => $task, "status" => "todo"]);
        }
        foreach ($data["done"] as $task) {
            $stmt->execute(["task" => $task, "status" => "done"]);
        }

        echo "Données enregistrées avec succès !";
    } else {
        echo "Erreur : données non reçues.";
    }

} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>