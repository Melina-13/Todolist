<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <div class="container">
        <h2>Bienvenue sur Ma To-Do List</h2>
        
        <!-- Section de l'ajout des tâches -->
        <div class="task-input-section">
            <input type="text" id="taskInput" placeholder="Ajouter une tâche...">
            <button id="addTaskBtn">Ajouter </button>
        </div>
        
        <!-- Section des listes de tâches -->
        <div class="task-lists">
            <div class="list-container">
                <h3> À Faire </h3>
                <ul id="todoList"></ul>
            </div>
            
            <div class="list-container">
                <h3>Terminé </h3>
                <ul id="doneList"></ul>
            </div>
        </div>

        <div class="buttons">
            <button id="loadBtn">Charger les tâches </button>
            <button id="saveBtn">Sauvegarder </button>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
