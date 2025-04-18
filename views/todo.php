<?php include '../controllers/todoController.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DailyDesk - To-Do List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/todo.css">
</head>

<body>
    <?php include '../includes/sidebar.php' ?>

    <main class="main container-fluid" id="main">
        <h1>To-Do List</h1>

        <?php include '../includes/message.php'; ?>

        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row align-items-stretch gap-2">

                    <div class="flex-grow-1 position-relative">
                        <input type="text" id="searchInput" class="form-control h-100 pe-5" placeholder="Search tasks...">
                        <button class="btn position-absolute top-50 end-0 translate-middle-y bg-transparent border-0 search-icon-btn">
                            <i class="ri-search-line"></i>
                        </button>
                    </div>

                    <div class="d-flex flex-grow-1 flex-column flex-sm-row gap-2">
                        <select id="statusFilter" class="form-select flex-fill">
                            <option value="">All Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Done">Done</option>
                        </select>

                        <select id="priorityFilter" class="form-select flex-fill">
                            <option value="">All Priority</option>
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                    </div>

                    <button class="btn custom-filled-btn mb-2 mb-md-0" style="min-width: 140px;" data-bs-toggle="modal" data-bs-target="#addTodoModal">
                        <i class="ri-add-circle-line"></i> Add To-Do
                    </button>
                </div>
            </div>
        </div>

        <!-- add Modal -->
        <div class="modal fade" id="addTodoModal" tabindex="-1" aria-labelledby="addTodoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTodoModalLabel">Add New To-Do</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../controllers/todoController.php" method="POST" id="todoForm">
                            <div class="mb-3">
                                <label for="task" class="form-label">Task</label>
                                <textarea class="form-control" name="task" id="task" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="priority" class="form-label">Priority</label>
                                <select class="form-select" name="priority" id="priority" required>
                                    <option value="" disabled selected>Select Priority</option>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" id="status" required>
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Done">Done</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="due_date" class="form-label">Due Date</label>
                                <input type="date" class="form-control" name="due_date" id="due_date" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="add_todo">Add To-Do</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- idit Modal -->
        <div class="modal fade" id="editTodoModal" tabindex="-1" aria-labelledby="editTodoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTodoModalLabel">Edit To-Do</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../controllers/todoController.php" method="POST" id="editTodoForm">
                            <input type="hidden" name="task_id" id="edit_task_id">
                            <div class="mb-3">
                                <label for="edit_task" class="form-label">Task</label>
                                <textarea class="form-control" name="task" id="edit_task" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="edit_priority" class="form-label">Priority</label>
                                <select class="form-select" name="priority" id="edit_priority" required>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit_status" class="form-label">Status</label>
                                <select class="form-select" name="status" id="edit_status" required>
                                    <option value="Pending">Pending</option>
                                    <option value="Done">Done</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit_due_date" class="form-label">Due Date</label>
                                <input type="date" class="form-control" name="due_date" id="edit_due_date" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="edit_todo">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 mb-xl-0 mb-4">
                <div class="card mb-4">
                    <div class="card-body p-0">
                        <div class="table-responsive p-3">

                            <?php if (empty($tasks)): ?>
                                <div class="text-center p-4">
                                    <p class="mb-0">No task available.</p>
                                </div>
                            
                            <?php else: ?>
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="ps-3 fw-semibold">Task</th>
                                            <th class="text-center fw-semibold">Priority</th>
                                            <th class="text-center fw-semibold">Status</th>
                                            <th class="text-center fw-semibold">Due Date</th>
                                            <th class="text-end pe-4 fw-semibold">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tasks as $task): ?>
                                            <tr class="table-row-modern">
                                                <td class="ps-3" data-label="Task">
                                                    <div class="d-flex align-items-center">
                                                        <span class="fw-medium"><?= htmlspecialchars($task['task']) ?></span>
                                                    </div>
                                                </td>
                                                <td class="text-center" data-label="Priority">
                                                    <span class="badge rounded-pill priority-<?= strtolower($task['priority']) ?>">
                                                        <?= $task['priority'] ?>
                                                    </span>
                                                </td>
                                                <td class="text-center" data-label="Status">
                                                    <span class="badge rounded-pill status-<?= strtolower($task['status']) ?>">
                                                        <?= $task['status'] ?>
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="due-date-container">
                                                        <span><?= $task['due_date'] ?></span>
                                                    </div>
                                                </td>
                                                <td class="text-end pe-4">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <button class="btn btn-outline-primary btn-action edit-btn"
                                                            title="Edit"
                                                            data-task-id="<?= $task['id'] ?>"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editTodoModal">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-outline-danger btn-action delete-btn"
                                                            title="Delete"
                                                            data-task-id="<?= $task['id'] ?>">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                        <button class="btn btn-outline-success btn-action complete-btn"
                                                            title="<?= $task['status'] === 'Done' ? 'Task already completed' : 'Mark as Done' ?>"
                                                            data-task-id="<?= $task['id'] ?>">
                                                            <i class="fas fa-check-circle"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/todo.js"></script>
    <script src="../assets/js/message.js"></script>
</body>

</html>