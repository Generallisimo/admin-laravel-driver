const nameFilter = document.getElementById('name-filter');
const phoneFilter = document.getElementById('phone-filter');
const dateFilter = document.getElementById('date-filter');

nameFilter.addEventListener('input', filterTable);
phoneFilter.addEventListener('input', filterTable);
dateFilter.addEventListener('input', filterTable);

function filterTable() {
    const nameValue = nameFilter.value.toLowerCase();
    const phoneValue = phoneFilter.value.toLowerCase();
    const dateValue = dateFilter.value.toLowerCase();
    
    const tableRows = document.querySelectorAll('#example2_wrapper tbody tr');
    
    tableRows.forEach(row => {
        const name = row.querySelector('#name-filter').textContent.toLowerCase();
        const phone = row.querySelector('#phone-filter').textContent.toLowerCase();
        const date = row.querySelector('#date-filter').textContent.toLowerCase();
        
        if (name.includes(nameValue) && phone.includes(phoneValue) && date.includes(dateValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
