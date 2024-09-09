<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <h1>Projects</h1>
    <div id="projects">
    </div>

    <script src="/js/app.js"></script>
    <script>
        fetch('/api/projects')
            .then(response => response.json())
            .then(data => {
                const projectsDiv = document.getElementById('projects');
                data.forEach(project => {
                    const projectElement = document.createElement('div');
                    projectElement.innerHTML = `<a href="/projects/${project.id}">${project.name}</a>`;
                    projectsDiv.appendChild(projectElement);
                });
            });
    </script>
</body>
</html>