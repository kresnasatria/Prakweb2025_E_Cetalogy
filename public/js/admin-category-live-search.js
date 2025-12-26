document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('input[name="search"]');
    const tableBody = document.querySelector('tbody');
    const paginationDiv = document.querySelector('.mt-6');
    let timer;

    if (!searchInput) return;

    searchInput.addEventListener('input', function () {
        clearTimeout(timer);
        timer = setTimeout(() => {
            const query = searchInput.value;
            fetch(`${window.location.pathname}?search=${encodeURIComponent(query)}&ajax=1`)
                .then(res => res.json())
                .then(data => {
                    tableBody.innerHTML = data.html;
                    if (paginationDiv) {
                        paginationDiv.innerHTML = data.pagination;
                    }
                });
        }, 400);
    });
});
