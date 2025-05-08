document.addEventListener("DOMContentLoaded", function () {

    //search and type filter
    const searchInput = document.getElementById('searchInput');
    const typeFilter = document.getElementById('typeFilter');
    const tableRows = document.querySelectorAll('tbody tr');

    function filterTable() {
        const searchText = searchInput.value.toLowerCase();
        const selectedType = typeFilter.value.toLowerCase();

        tableRows.forEach(row => {
            const rowText = row.textContent.toLowerCase();
            const typeCell = row.querySelector('td[data-label="Type"]');

            const typeText = typeCell ? typeCell.textContent.toLowerCase() : "";

            const matchesSearch = rowText.includes(searchText);
            const matchesType = !selectedType || typeText.includes(selectedType);

            if (matchesSearch && matchesType) {
                row.style.display = '';
            }

            else {
                row.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('input', filterTable);
    typeFilter.addEventListener('change', filterTable);


    //if the user choose the income only the incomeOptions lang pagpipilian then if it's expense only the expenseOptions din lang ang lalabas
    const typeSelect = document.getElementById('type');
    const categorySelect = document.getElementById('category');

    const incomeOptions = [
        { value: 'Salary', text: 'Salary' },
        { value: 'Business', text: 'Business' },
        { value: 'Investment', text: 'Investment' },
        { value: 'Allowance', text: 'Allowance' },
        { value: 'Others', text: 'Others' }
    ];

    const expenseOptions = [
        { value: 'Food', text: 'Food' },
        { value: 'Transportation', text: 'Transportation' },
        { value: 'Bills', text: 'Bills' },
        { value: 'Rent', text: 'Rent' },
        { value: 'Leisure', text: 'Leisure' },
        { value: 'Others', text: 'Others' }
    ];

    typeSelect.addEventListener('change', function () {
        const selectedType = this.value;

        //clear existing options first
        categorySelect.innerHTML = '<option value="" disabled selected>Select Category</option>';

        const options = selectedType === 'Income' ? incomeOptions : expenseOptions;

        options.forEach(option => {
            const opt = document.createElement('option');

            opt.value = option.value;
            opt.textContent = option.text;
            categorySelect.appendChild(opt);
        });
    });

    //idit button
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            const budgetId = this.getAttribute('data-budget-id');
            const row = this.closest('tr');

            //Get clean amount value (remove ₱ symbol)
            const amountText = row.querySelector('td[data-label="Amount"] span').textContent.trim().replace(/[^\d.]/g, '');

            document.getElementById('edit_budget_id').value = budgetId;
            document.getElementById('edit_type').value = row.querySelector('td[data-label="Type"] span').textContent;
            document.getElementById('edit_amount').value = amountText;
            document.getElementById('edit_description').value = row.querySelector('td[data-label="Description"] span').textContent.trim();
            document.getElementById('edit_category').value = row.querySelector('td[data-label="Category"] span').textContent.trim();
            document.getElementById('edit_date_logged').value = row.querySelector('.date-logged-container span').textContent.trim();


            //category
            const editType = row.querySelector('td[data-label="Type"] span').textContent.trim();
            const editCategory = row.querySelector('td[data-label="Category"] span').textContent.trim();

            document.getElementById('edit_type').value = editType;

            // Populate the edit_category select
            const editCategorySelect = document.getElementById('edit_category');
            editCategorySelect.innerHTML = '<option value="" disabled>Select Category</option>';

            const selectedOptions = editType === 'Income' ? incomeOptions : expenseOptions;

            selectedOptions.forEach(option => {
                const opt = document.createElement('option');
                opt.value = option.value;
                opt.textContent = option.text;
                if (option.value === editCategory) {
                    opt.selected = true;
                }
                editCategorySelect.appendChild(opt);
            });

        });
    });

    // Delete Button Click
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            if (confirm('Are you sure you want to delete this budget?')) {
                const budgetId = this.getAttribute('data-budget-id');
                window.location.href = `../controllers/budgetController.php?delete_id=${budgetId}`;
            }
        });
    });

});