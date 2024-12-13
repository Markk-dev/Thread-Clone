 // JavaScript to handle hover effect
 const searchBar = document.querySelector('.search-bar');

 document.querySelector('.group').addEventListener('mouseenter', () => {
     searchBar.classList.add('show');
 });

 document.querySelector('.group').addEventListener('mouseleave', () => {
     searchBar.classList.remove('show');
 });