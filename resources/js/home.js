document.addEventListener('click', function (e) {
    var dropdown = document.querySelector('.dropdown');
    if (!dropdown.contains(e.target)) {
        var dropdownContent = dropdown.querySelector('.dropdown-content');
        dropdownContent.style.display = 'none';
    }
});

document.querySelector('.dropdown').addEventListener('click', function () {
    var dropdownContent = this.querySelector('.dropdown-content');
    dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
});
