// app-sidebar toggle js

const toggleButton = document.getElementById("menu-toggle");
const sidebar = document.querySelector(".app-sidebar");
const mainContent = document.querySelector(".main-content.app-content");
const closeButton = document.getElementById("close");

toggleButton.addEventListener("click", function() {
  sidebar.classList.toggle("hidden");
  mainContent.classList.toggle("full-width");
});

closeButton.addEventListener("click", function() {
  sidebar.classList.remove("hidden");
});

