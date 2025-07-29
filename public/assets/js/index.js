document.getElementById("hamburger").addEventListener("click", function () {
  document.getElementById("sidebar").classList.remove("-translate-x-full");
});
document.getElementById("closeBtn").addEventListener("click", function () {
  document.getElementById("sidebar").classList.add("-translate-x-full");
});


