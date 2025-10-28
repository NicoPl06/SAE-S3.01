document.addEventListener('DOMContentLoaded', function()
{
    const searchForm = document.querySelector('.search-form');
    const searchButton = document.querySelector('.search-btn');
    searchButton.addEventListener('click', function() {
        searchForm.classList.toggle('active');
    });
});
