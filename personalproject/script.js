// ===== MOBILE MENU =====
// On phones the links are hidden. The button shows or hides them.
var menuButton = document.getElementById("menuToggle");
var nav = document.getElementById("mainNav");

if (menuButton && nav) {
  menuButton.addEventListener("click", function () {
    nav.classList.toggle("open");   // adds the class "open" if missing, removes it if present
  });
}

// ===== REGISTER FORM CHECK =====
// Checks the passwords in the browser before the form is sent to PHP.
var registerForm = document.getElementById("registerForm");

if (registerForm) {
  registerForm.addEventListener("submit", function (event) {
    var password = registerForm.elements["password"].value;
    var confirm = registerForm.elements["confirm"].value;

    if (password.length < 6) {
      alert("Password must be at least 6 characters.");
      event.preventDefault();       // stops the form from being sent
    } else if (password != confirm) {
      alert("Passwords do not match.");
      event.preventDefault();
    }
  });
}
