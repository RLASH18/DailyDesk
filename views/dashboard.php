<?php include '../controllers/dashboardController.php'; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DailyDesk - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
    <?php include '../includes/sidebar.php' ?>

    <main class="main container-fluid" id="main">
        <h1>Dashboard</h1>

        <div class="row mt-4">
            <!-- Card 1 -->
            <div class="col-xl-4 col-md-4 col-sm-12 mb-xl-0 mb-4">
                <div class="custom-card">
                    <div class="custom-card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="card-label">To-Do List</p>
                                <h4 class="card-value"><?= htmlspecialchars($total_task); ?></h4>
                            </div>
                            <div class="card-icon">
                                <i class="material-symbols-rounded">checklist</i>
                            </div>
                        </div>
                    </div>
                    <hr class="custom-divider">
                    <div class="custom-card-footer">
                        <p class="card-footer-text">
                            <span class="text-success">+55%</span> than last week
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-xl-4 col-md-4 col-sm-12 mb-xl-0 mb-4">
                <div class="custom-card">
                    <div class="custom-card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="card-label">Journal Entries</p>
                                <h4 class="card-value"><?= htmlspecialchars($total_journal_entry); ?></h4>
                            </div>
                            <div class="card-icon">
                                <i class="material-symbols-rounded">menu_book</i>
                            </div>
                        </div>
                    </div>
                    <hr class="custom-divider">
                    <div class="custom-card-footer">
                        <p class="card-footer-text">
                            <span class="text-success">+3%</span> than last month
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-xl-4 col-md-4 col-sm-12 mb-xl-0 mb-4">
                <div class="custom-card">
                    <div class="custom-card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="card-label">Total Balances (Income - Expenses)</p>
                                <h4 class="card-value">₱ <?= htmlspecialchars($total_balance); ?></h4>
                            </div>
                            <div class="card-icon">
                                <i class="material-symbols-rounded">account_balance_wallet</i>
                            </div>
                        </div>
                    </div>
                    <hr class="custom-divider">
                    <div class="custom-card-footer">
                        <p class="card-footer-text">
                            <span class="text-danger">-2%</span> than yesterday
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!--Radars-->
        <div class="row">
            <div class="col-xl-7 col-md-12 col-sm-12">
                <div class="pie-card">
                    <div class="pie-header">
                        <span class="material-symbols-rounded icon">assessment</span>
                        <h2 class="pie-title">Users Productivity</h2>
                    </div>
                    <div class="chart-container">
                        <canvas id="productivityRadar"></canvas>
                        <div id="productivity-insights" class="mt-3">
                            <div class="text-center">
                                <span class="insight-label">Productivity Score:</span>
                                <span class="insight-value" id="productivity-score">
                                    <?php
                                    $avg = array_sum(json_decode($productivity_data)->data) / count(json_decode($productivity_data)->data);
                                    echo number_format($avg, 1);
                                    ?>/10
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-5 col-md-12 col-sm-12 mb-xl-0 mb-4">
                <div class="recent-activity-card">
                    <div class="recent-header">
                        <span class="material-symbols-rounded icon">history</span>
                        <h2 class="recent-title">Recent Activity</h2>
                    </div>
                    <ul class="recent-list">
                        <?php if (empty($recent_activities)): ?>
                            <li class="recent-item muted">No recent activity yet.</li>
                        <?php else: ?>
                            <?php foreach ($recent_activities as $activity): ?>
                                <li class="recent-item">
                                    <span class="activity-type"><?= htmlspecialchars($activity['type']) ?></span>
                                    <span class="activity-title"><?= htmlspecialchars($activity['title']) ?></span>
                                    <span class="activity-time"><?= date('F j, Y - g:i A', strtotime($activity['created_at'])) ?></span>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <div id="productivity-data"
        data-productivity='<?= htmlspecialchars($productivity_data, ENT_QUOTES, 'UTF-8'); ?>'
        style="display: none;">
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
    <script src="../assets/js/dashboard.js"></script>:
</body>

</html>