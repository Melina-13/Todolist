document.addEventListener("DOMContentLoaded", function () {
    const taskInput = document.getElementById("taskInput");
    const addTaskBtn = document.getElementById("addTaskBtn");
    const todoList = document.getElementById("todoList");
    const doneList = document.getElementById("doneList");
    const saveBtn = document.getElementById("saveBtn");
    const loadBtn = document.getElementById("loadBtn");

    // ajoute une tâche à la liste 
    function addTask(taskText, status = "todo") {
        const li = document.createElement("li");
        li.innerHTML = `
            <span>${taskText}</span>
            <div class="actions">
                <button class="doneBtn">✔ </button>
                <button class="delete">❌</button>
            </div>
        `;

        // Bouton pour marquer comme terminé
        li.querySelector(".doneBtn").addEventListener("click", function () {
            li.classList.add("done");
            doneList.appendChild(li);
            this.remove();//  supprimer le bouton "✔"
        });

        // bouton pour supprimer
        li.querySelector(".delete").addEventListener("click", function () {
            li.remove();
        });

        // ajouter la tâche à la liste appropriée
        if (status === "todo") {
            todoList.appendChild(li);
        } else {
            doneList.appendChild(li);
            li.classList.add("done");
        }
    }

    // charger les données 
    function loadTasks() {
        fetch("load.php")
            .then(response => response.json())
            .then(data => {
                // Charger les tâches "À Faire"
                data.todo.forEach(task => addTask(task, "todo"));
                // Charger les tâches "Terminé"
                data.done.forEach(task => addTask(task, "done"));
            })
            .catch(error => console.error("Erreur lors du chargement des tâches :", error));
    }

   
    loadTasks();

    // ajouter une tâche
    addTaskBtn.addEventListener("click", function () {
        const taskText = taskInput.value.trim();
        if (taskText !== "") {
            addTask(taskText);
            taskInput.value = ""; // Réinitialiser le champ de saisie
        }
    });

    // sauvegarder les tâches via Fetch
    saveBtn.addEventListener("click", function () {
        const tasks = {
            todo: [],
            done: []
        };

        document.querySelectorAll("#todoList li span").forEach(task => {
            tasks.todo.push(task.innerText);
        });

        document.querySelectorAll("#doneList li span").forEach(task => {
            tasks.done.push(task.innerText);
        });

        fetch("save.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(tasks)
        })
        .then(response => response.text())
        .then(data => {
            alert("Tâches sauvegardées !");
            console.log(data);
        })
        .catch(error => console.error("Erreur :", error));
    });

    // charger les tâches avec le bouton
    loadBtn.addEventListener("click", loadTasks);
});
