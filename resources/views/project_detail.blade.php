<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Detail - {{ $project->name }}</title>
    <link rel="stylesheet" href="/css/style.css">
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
        const projectId = @json($project->id);

        fetch(`/api/projects/${projectId}/tasks`)
            .then(response => response.json())
            .then(data => {
                const tasksDiv = document.getElementById('tasks');
                data.forEach(task => {
                    const taskElement = document.createElement('div');
                    taskElement.innerHTML = `
                    <p>${task.name} - ${task.status}</p>
                    <button onclick="editTask(${task.id})">Edit</button>
                    <button onclick="deleteTask(${task.id})">Delete</button>
                    <form id="editTaskForm-${task.id}" style="display:none;">
                        <input type="text" name="name" value="${task.name}" required>
                        <input type="text" name="description" value="${task.description}">
                        <button type="submit">Update Task</button>
                    </form>
                `;
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
                    console.log(data);
                    const tasksDiv = document.getElementById('tasks');
                    const newTask = document.createElement('div');
                    newTask.innerHTML = `
                    <p>${data.name} - todo</p>
                    <button onclick="editTask(${data.id})">Edit</button>
                    <button onclick="deleteTask(${data.id})">Delete</button>
                    <form id="editTaskForm-${data.id}" style="display:none;">
                        <input type="text" name="name" value="${data.name}" required>
                        <input type="text" name="description" value="${data.description}">
                        <button type="submit">Update Task</button>
                    </form>
                `;
                    tasksDiv.appendChild(newTask);
                });
        });

        function editTask(taskId) {
            const editForm = document.getElementById(`editTaskForm-${taskId}`);
            editForm.style.display = 'block';

            editForm.addEventListener('submit', function (event) {
                event.preventDefault();
                const formData = new FormData(editForm);

                fetch(`/api/tasks/${taskId}`, {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        alert('Task updated successfully!');
                        location.reload();
                    });
            });
        }

        function deleteTask(taskId) {
            if (confirm('Are you sure you want to delete this task?')) {
                fetch(`/api/tasks/${taskId}`, {
                    method: 'DELETE'
                })
                    .then(response => {
                        alert('Task deleted successfully!');
                        location.reload();
                    });
            }
        }
    </script>
</body>
</html>