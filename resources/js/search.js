const searchInput = document.getElementById('linkSearchInput');
const clearSearchBtn = document.getElementById('clearSearchBtn');
const linkItems = document.querySelectorAll('.link-item');
const noResultsMsg = document.getElementById('noSearchResults');

if (searchInput) {
    const filterLinks = () => {
        const query = searchInput.value.trim().toLowerCase();
        let visibleCount = 0;

        clearSearchBtn.style.display = query.length > 0 ? 'block' : 'none';

        linkItems.forEach(item => {
            const text = item.dataset.search || '';
            if (text.includes(query)) {
                item.style.display = 'flex';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        if (noResultsMsg) {
            noResultsMsg.style.display = (visibleCount === 0 && linkItems.length > 0) ? 'block' : 'none';
        }
    };

    searchInput.addEventListener('input', filterLinks);

    clearSearchBtn.addEventListener('click', () => {
        searchInput.value = '';
        filterLinks();
        searchInput.focus();
    });
}
