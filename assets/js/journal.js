document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById('searchInput');
    const container = document.querySelector('#journalContainer');
    const wrappers = Array.from(container.querySelectorAll('.journal-wrapper'));

    searchInput.addEventListener('input', () => {
        const searchTerm = searchInput.value.trim().toLowerCase();

        const matched = [];
        const unmatched = [];

        wrappers.forEach(wrapper => {
            const card = wrapper.querySelector('.journal-card');
            const text = card.textContent.trim().toLowerCase();

            if (text.includes(searchTerm)) {
                matched.push(wrapper);  // Add matched wrapper to the matched list
            } else {
                unmatched.push(wrapper);  // Add unmatched wrapper to the unmatched list
            }
        });

        // Clear the container and append matched cards first
        container.innerHTML = '';

        matched.forEach(el => {
            el.style.display = '';  // Ensure matched cards are visible
            container.appendChild(el);  // Append matched card wrapper to the container
        });

        unmatched.forEach(el => {
            el.style.display = 'none';  // Hide unmatched card wrapper completely
        });
    });

    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            const journalId = this.getAttribute('data-journal-id');
            const row = this.closest('.journal-card');

            document.getElementById('edit_journal_id').value = journalId;
            document.getElementById('edit_entry_title').value = row.querySelector('[data-label="Entry-Title"]').textContent;
            document.getElementById('edit_entry_text').value = row.querySelector('[data-label="Entry-Text"]').textContent.trim();
            document.getElementById('edit_tags').value = row.querySelector('[data-label="Tags"] span').textContent.trim();

        });
    });

    //delete
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            if (confirm('Are you sure you want to delete this journal?')) {
                const journalId = this.getAttribute('data-journal-id');
                window.location.href = `../controllers/journalController.php?delete_id=${journalId}`;
            }
        });
    });

    //view
    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function () {
            const journalId = this.getAttribute('data-journal-id');
            const card = this.closest('.journal-card');

            // Get all the data from the card
            const title = card.querySelector('[data-label="Entry-Title"]').textContent;
            const date = card.querySelector('.entry-date').textContent;
            const text = card.querySelector('[data-label="Entry-Text"]').textContent.trim();

            // Set the modal content
            document.getElementById('viewJournalTitle').textContent = title;
            document.getElementById('viewJournalDate').textContent = date;
            document.getElementById('viewJournalText').textContent = text;

            // Handle image
            const imgElement = card.querySelector('.journal-img img');
            if (imgElement) {
                document.getElementById('viewJournalImage').src = imgElement.src;
                document.getElementById('viewJournalImage').style.display = 'block';
            } else {
                document.getElementById('viewJournalImage').style.display = 'none';
            }

            // Handle tags
            const tagsContainer = document.getElementById('viewJournalTags');
            tagsContainer.innerHTML = '';
            const tags = card.querySelectorAll('.tags-container .tag-badge');
            tags.forEach(tag => {
                const newTag = document.createElement('span');
                newTag.className = 'badge tag-badge me-1';
                newTag.textContent = tag.textContent;
                tagsContainer.appendChild(newTag);
            });
        });
    });
});