<?php include '../controllers/journalController.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DailyDesk - Journal Notes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/journal.css">
</head>

<body>
    <?php include '../includes/sidebar.php'; ?>

    <main class="main container-fluid" id="main">
        <h1>Journal Notes</h1>

        <?php include '../includes/message.php'; ?>

        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row align-items-stretch gap-2">

                    <div class="flex-grow-1 position-relative">
                        <input type="text" id="searchInput" class="form-control h-100 pe-5" placeholder="Search journal...">
                        <button class="btn position-absolute top-50 end-0 translate-middle-y bg-transparent border-0 search-icon-btn">
                            <i class="ri-search-line"></i>
                        </button>
                    </div>

                    <button class="btn custom-filled-btn mb-2 mb-md-0" style="min-width: 140px;" data-bs-toggle="modal" data-bs-target="#addJournalModal">
                        <i class="ri-add-circle-line"></i> Add Journal
                    </button>
                </div>
            </div>
        </div>

        <!-- add Modal -->
        <div class="modal fade" id="addJournalModal" tabindex="-1" aria-labelledby="addJournalModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addJournalModalLabel">Add Journal Entry</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../controllers/journalController.php" method="POST" id="addJournalForm" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="entry_title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="entry_title" name="entry_title" required>
                            </div>
                            <div class="mb-3">
                                <label for="entry_text" class="form-label">Content</label>
                                <textarea class="form-control" id="entry_text" name="entry_text" rows="5" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="tags" class="form-label">Tags (comma separated)</label>
                                <input type="text" class="form-control" id="tags" name="tags">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/jpeg,image/png,image/gif" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="add_journal">Add Journal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- idit Modal -->
        <div class="modal fade" id="editJournalModal" tabindex="-1" aria-labelledby="editJournalModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editJournalModalLabel">Edit Journal Entry</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../controllers/journalController.php" method="POST" id="editJournalForm" enctype="multipart/form-data">
                            <input type="hidden" name="journal_id" id="edit_journal_id">
                            <div class="mb-3">
                                <label for="edit_entry_title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="edit_entry_title" name="entry_title" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_entry_text" class="form-label">Content</label>
                                <textarea class="form-control" id="edit_entry_text" name="entry_text" rows="5" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="edit_tags" class="form-label">Tags (comma separated)</label>
                                <input type="text" class="form-control" id="edit_tags" name="tags">
                            </div>
                            <div class="mb-3">
                                <label for="edit_image" class="form-label">Image (optional)</label>
                                <input type="file" class="form-control" id="edit_image" name="image" accept="image/jpeg,image/png,image/gif">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="edit_journal">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- view Modal -->
        <div class="modal fade" id="viewJournalModal" tabindex="-1" aria-labelledby="viewJournalModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewJournalModalLabel">Journal Entry</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Image Section -->
                            <div class="col-12 mb-4">
                                <img id="viewJournalImage" src="" class="img-fluid rounded" alt="Journal image" style="max-height: 400px; width: 100%; object-fit: contain;">
                            </div>

                            <!-- Content Section -->
                            <div class="col-12">
                                <h3 id="viewJournalTitle" class="mb-3"></h3>
                                <div class="text-muted mb-3">
                                    <i class="ri-calendar-line" style="color: #2487ce;"></i> <span id="viewJournalDate"></span>
                                </div>
                                <p id="viewJournalText" class="mb-4" style="white-space: pre-line;"></p>

                                <div id="viewJournalTags" class="tags-container mb-3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gy-4 mt-2" id="journalContainer">
            <?php if (empty($journals)): ?>
                <div class="col-12 mt-5 text-center">
                    No journal entries found. Start by adding your first entry!
                </div>
            <?php else: ?>
                <?php foreach ($journals as $journal): ?>
                    <div class="journal-wrapper col-xl-4 col-md-6 d-flex align-items-stretch">
                        <div class="journal-card">
                            <?php if ($journal['image_path']): ?>
                                <div class="journal-img position-relative" data-label="Image">
                                    <img src="../<?= htmlspecialchars($journal['image_path']) ?>" class="img-fluid" alt="Journal entry">
                                    <?php var_dump($journal['image_path']); ?>

                                    <div class="image-actions position-absolute top-50 start-50 translate-middle d-flex gap-3 opacity-0">
                                        <button class="btn-action edit-btn"
                                            title="Edit"
                                            data-journal-id="<?= $journal['id'] ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editJournalModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn-action delete-btn"
                                            title="Delete"
                                            data-journal-id="<?= $journal['id'] ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <button class="btn-action view-btn"
                                            title="View"
                                            data-journal-id="<?= $journal['id'] ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#viewJournalModal">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="entry-content">
                                <h4 data-label="Entry-Title"><?= htmlspecialchars($journal['entry_title']) ?></h4>
                                <div class="entry-date mb-2">
                                    <i class="ri-calendar-line"></i> <?= date('M j, Y', strtotime($journal['created_at'])) ?>
                                </div>
                                <p class="entry-text" data-label="Entry-Text"><?= htmlspecialchars($journal['entry_text']) ?></p>

                                <?php if (!empty($journal['tags'])): ?>
                                    <div class="tags-container" data-label="Tags">
                                        <?php $tags = explode(',', $journal['tags']); ?>
                                        <?php foreach ($tags as $tag): ?>
                                            <span class="badge tag-badge"><?= htmlspecialchars(trim($tag)) ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/journal.js"></script>
    <script src="../assets/js/message.js"></script>
</body>
</html>