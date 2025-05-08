<?php include '../controllers/budgetController.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DailyDesk - Budget Tracker</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/budget.css">
</head>

<body>

    <?php include '../includes/sidebar.php'; ?>

    <main class="main container-fluid" id="main">
        <h1>Budget Tracker</h1>

        <?php include '../includes/message.php'; ?>

        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row align-items-stretch gap-2">

                    <div class="flex-grow-1 position-relative">
                        <input type="text" id="searchInput" class="form-control h-100 pe-5" placeholder="Search budget...">
                        <button class="btn position-absolute top-50 end-0 translate-middle-y bg-transparent border-0 search-icon-btn">
                            <i class="ri-search-line"></i>
                        </button>
                    </div>

                    <div class="d-flex flex-grow-1 flex-column flex-sm-row gap-2">
                        <select id="typeFilter" class="form-select flex-fill">
                            <option value="">All Types</option>
                            <option value="Income">Income</option>
                            <option value="Expense">Expense</option>
                        </select>
                    </div>

                    <button class="btn custom-filled-btn mb-2 mb-md-0" style="min-width: 140px;" data-bs-toggle="modal" data-bs-target="#addBudgetModal">
                        <i class="ri-add-circle-line"></i> Add Budget
                    </button>
                </div>
            </div>
        </div>

        <!-- add Modal -->
        <div class="modal fade" id="addBudgetModal" tabindex="-1" aria-labelledby="addBudgetModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBudgetModalLabel">Add New Budget</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../controllers/budgetController.php" method="POST" id="budgetForm">
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select class="form-select" name="type" id="type" required>
                                    <option value="" disabled selected>Select Type</option>
                                    <option value="Income">Income</option>
                                    <option value="Expense">Expense</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" class="form-control" name="amount" id="amount" step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" name="category" id="category" required>
                                    <option value="" disabled selected>Select Category</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date_logged" class="form-label">Date Logged</label>
                                <input type="date" class="form-control" name="date_logged" id="date_logged" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="add_budget">Add Budget</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- idit Modal -->
        <div class="modal fade" id="editBudgetModal" tabindex="-1" aria-labelledby="editBudgetModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBudgetModalLabel">Edit Budget</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../controllers/budgetController.php" method="POST" id="editBudgetForm">
                            <input type="hidden" name="budget_id" id="edit_budget_id">
                            <div class="mb-3">
                                <label for="edit_type" class="form-label">Type</label>
                                <select class="form-select" name="type" id="edit_type" required>
                                    <option value="" disabled selected>Select Type</option>
                                    <option value="Income">Income</option>
                                    <option value="Expense">Expense</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit_amount" class="form-label">Amount</label>
                                <input type="number" class="form-control" name="amount" id="edit_amount" step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="edit_description" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="edit_category" class="form-label">Category</label>
                                <select class="form-select" name="category" id="edit_category" required>
                                    <option value="" disabled selected>Select Category</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit_date_logged" class="form-label">Date Logged</label>
                                <input type="date" class="form-control" name="date_logged" id="edit_date_logged" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="edit_budget">Save Changes</button>
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

                            <?php if (empty($budgets)): ?>
                                <div class="text-center p-4">
                                    <p class="mb-0">No budget entries found.</p>
                                </div>

                            <?php else: ?>
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="ps-3 fw-semibold">Type</th>
                                            <th class=" fw-semibold">Amount</th>
                                            <th class=" fw-semibold">Description</th>
                                            <th class="fw-semibold">Category</th>
                                            <th class="fw-semibold">Date Logged</th>
                                            <th class="text-end pe-4 fw-semibold">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($budgets as $budget): ?>
                                            <tr class="table-row-modern">
                                                <td class="ps-3" data-label="Type">
                                                    <div class="d-flex align-items-center">
                                                        <span class="fw-medium"><?= htmlspecialchars($budget['type']) ?></span>
                                                    </div>
                                                </td>
                                                <td data-label="Amount">
                                                    <div class="d-flex align-items-center">
                                                        <span class="fw-medium">₱<?= htmlspecialchars($budget['amount'], 2) ?></span>
                                                    </div>
                                                </td>
                                                <td data-label="Description">
                                                    <div class="d-flex align-items-center">
                                                        <span class="fw-medium"><?= htmlspecialchars($budget['description']) ?></span>
                                                    </div>
                                                </td>
                                                <td data-label="Category">
                                                    <?php
                                                    if (!function_exists('getCategoryBadgeClass')) {
                                                        function getCategoryBadgeClass($category)
                                                        {
                                                            $incomeCategories = ['Salary', 'Business', 'Investment', 'Allowance'];
                                                            $expenseCategories = ['Food', 'Transportation', 'Bills', 'Rent', 'Leisure'];

                                                            if (in_array($category, $incomeCategories)) {
                                                                return 'badge-income';
                                                            } elseif (in_array($category, $expenseCategories)) {
                                                                return 'badge-expense';
                                                            } else {
                                                                return 'badge-others';
                                                            }
                                                        }
                                                    }
                                                    ?>

                                                    <div class="d-flex align-items-center">
                                                        <span class="badge rounded-pill <?= getCategoryBadgeClass($budget['category']) ?>">
                                                            <?= htmlspecialchars($budget['category']) ?>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td data-label="Date-Logged">
                                                    <div class="date-logged-container">
                                                        <span><?= htmlspecialchars($budget['date_logged']) ?></span>
                                                    </div>
                                                </td>
                                                <td class="text-end pe-4">
                                                    <div class="btn-group btn-group-sm" role="group">

                                                        <button class="btn btn-outline-primary btn-action edit-btn"
                                                            title="Edit"
                                                            data-budget-id="<?= $budget['id'] ?>"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editBudgetModal">
                                                            <i class="fas fa-edit"></i>
                                                        </button>

                                                        <button class="btn btn-outline-danger btn-action delete-btn"
                                                            title="Delete"
                                                            data-budget-id="<?= $budget['id'] ?>">
                                                            <i class="fas fa-trash-alt"></i>
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
    <script src="../assets/js/budget.js"></script>
    <script src="../assets/js/message.js"></script>

</body>

</html>