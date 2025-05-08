<?php

$alerts = [
    'error_message' => ['type' => 'danger', 'icon' => 'ri-error-warning-fill'],
    'success_message' => ['type' => 'success', 'icon' => 'ri-check-line'],
    'info_message' => ['type' => 'primary', 'icon' => 'ri-information-line'],
];

foreach ($alerts as $var => $details){
    if (!empty($$var)) {
        ?>
        <div class="alert alert-<?= $details['type'] ?> alert-dismissible fade show d-flex align-items-center justify-content-between" role="alert">
            <div>
                <i class="<?= $details['icon'] ?> me-2"></i>
                <?= htmlspecialchars($$var) ?>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
    }
}

?>