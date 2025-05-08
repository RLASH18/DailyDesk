document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const statusFilter = document.getElementById("statusFilter");
    const priorityFilter = document.getElementById("priorityFilter");

    // Function to filter the table based on search input and dropdown filters
    function filterTable() {
        const searchValue = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value.toLowerCase();
        const priorityValue = priorityFilter.value.toLowerCase();

        const tableRows = document.querySelectorAll(".table-row-modern");
        tableRows.forEach(row => {
            const taskText = row.querySelector("td[data-label='Task'] span")?.textContent.toLowerCase() || '';
            const statusText = row.querySelector("td[data-label='Status'] span")?.textContent.toLowerCase() || '';
            const priorityText = row.querySelector("td[data-label='Priority'] span")?.textContent.toLowerCase() || '';

            const matchesSearch = taskText.includes(searchValue);
            const matchesStatus = !statusValue || statusText.includes(statusValue);
            const matchesPriority = !priorityValue || priorityText.includes(priorityValue);

            if (matchesSearch && matchesStatus && matchesPriority) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    // Event listeners for live searching and filtering
    if (searchInput) searchInput.addEventListener("input", filterTable);
    if (statusFilter) statusFilter.addEventListener("change", filterTable);
    if (priorityFilter) priorityFilter.addEventListener("change", filterTable);

    //idit button
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            const taskId = this.getAttribute('data-task-id');
            const row = this.closest('tr');

            document.getElementById('edit_task_id').value = taskId;
            document.getElementById('edit_task').value = row.querySelector('td[data-label="Task"] span').textContent;
            document.getElementById('edit_priority').value = row.querySelector('td[data-label="Priority"] .badge').textContent.trim();
            document.getElementById('edit_status').value = row.querySelector('td[data-label="Status"] .badge').textContent.trim();
            document.getElementById('edit_due_date').value = row.querySelector('.due-date-container span').textContent.trim();
        });
    });

    // Delete Button Click
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            if (confirm('Are you sure you want to delete this task?')) {
                const taskId = this.getAttribute('data-task-id');
                window.location.href = `../controllers/todoController.php?delete_id=${taskId}`;
            }
        });
    });

    // Complete Button Click
    document.querySelectorAll('.complete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const taskId = this.getAttribute('data-task-id');
            window.location.href = `../controllers/todoController.php?complete_id=${taskId}`;
        });
    });
});
