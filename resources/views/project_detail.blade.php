<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Detail</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <h1>Tasks for Project: {{ $project->name }}</h1>
    <div id="tasks">
    </div>

    <h2>Add New Task</h2>
    <form id="taskForm">
        <input type="text" name="name" placeholder="Task Name" required>
        <input type="text" name="description" placeholder="Task Description">
        <button type="submit">Add Task</button>
    </form>

    <script src="/js/app.js"></script>
    <script>
        const projectId = {{ $project->id }};
        
        fetch(`/api/projects/${projectId}/tasks`)
        .then(response => response.json())
        .then(data => {
            const tasksDiv = document.getElementById('tasks');
            data.forEach(task => {
                const taskElement = document.createElement('div');
                taskElement.innerHTML = `<p>${task.name} - ${task.status}</p>`;
                tasksDiv.appendChild(taskElement);
            });
        });

        const taskForm = document.getElementById('taskForm');
        taskForm.addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(taskForm);
            
            fetch(`/api/projects/${projectId}/tasks`, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const tasksDiv = document.getElementById('tasks');
                const newTask = document.createElement('div');
                newTask.innerHTML = `<p>${data.name} - ${data.status}</p>`;
                tasksDiv.appendChild(newTask);
            });
        });
    </script>
</body>
</html>