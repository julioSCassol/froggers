function toggleMenu() {
  const slidingMenu = document.getElementById('sliding-menu');

  if (slidingMenu.classList.contains('menu-closed')) {
    slidingMenu.classList.remove('menu-closed');
  } else {
    slidingMenu.classList.add('menu-closed');
  }
}

document.getElementById('menu-button').addEventListener('click', toggleMenu);
document.getElementById('continue-shopping').addEventListener('click', toggleMenu);
document.getElementById('close-menu').addEventListener('click', toggleMenu);

const pagina = document.querySelector('.pagina');
pagina.style.minHeight = window.innerHeight + 'px';

function searchProducts() {
  var searchTerm = document.getElementById("search-input").value;

  // Make an AJAX request to the search.php file
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var searchResults = document.getElementById("search-results");
      searchResults.innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "search.php?search=" + searchTerm, true);
  xhttp.send();
}
document.getElementById("search-form").addEventListener("submit", function(e) {
  e.preventDefault();
  searchProducts();
});
