// sidebar
const buttonSidebar = document.getElementById("buttonSidebar");
const sidebar = document.getElementById("sidebar");
const page = document.getElementById("page");

buttonSidebar.addEventListener("click", () => {
    sidebar.classList.toggle("d-none");
    sidebar.classList.toggle("d-sm-none");
    page.classList.toggle("page-margin");
});
