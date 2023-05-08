function initDarkMode() {
  var themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
  var themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");

  // Change the icons inside the button based on previous settings
  if (
    localStorage.getItem("color-theme") === "dark" ||
    (!("color-theme" in localStorage) &&
      window.matchMedia("(prefers-color-scheme: dark)").matches)
  ) {
    themeToggleLightIcon.classList.remove("hidden");
  } else {
    themeToggleDarkIcon.classList.remove("hidden");
  }

  var themeToggleBtn = document.getElementById("theme-toggle");

  themeToggleBtn.addEventListener("click", function () {
    // toggle icons inside button
    themeToggleDarkIcon.classList.toggle("hidden");
    themeToggleLightIcon.classList.toggle("hidden");

    // if set via local storage previously
    if (localStorage.getItem("color-theme")) {
      if (localStorage.getItem("color-theme") === "light") {
        document.documentElement.classList.add("dark");
        localStorage.setItem("color-theme", "dark");
      } else {
        document.documentElement.classList.remove("dark");
        localStorage.setItem("color-theme", "light");
      }

      // if NOT set via local storage previously
    } else {
      if (document.documentElement.classList.contains("dark")) {
        document.documentElement.classList.remove("dark");
        localStorage.setItem("color-theme", "light");
      } else {
        document.documentElement.classList.add("dark");
        localStorage.setItem("color-theme", "dark");
      }
    }
  });
}

function initSearchDropdown() {
  if (!document.querySelector(".search-hidden-genre")) return;

  document.addEventListener("click", function (event) {
    let catEl = event.target.closest(
      ".search-cat-dropdown-container .dropdown-cat-search > ul > li"
    );
    if (!catEl) return;

    const catDropdownContainer = catEl.closest(
      ".search-cat-dropdown-container"
    );
    const hiddenInput = catDropdownContainer.querySelector(
      ".search-hidden-genre"
    );
    const buttonText = catDropdownContainer.querySelector(
      ".dropdown-cat-value"
    );
    const dropdown = catDropdownContainer.querySelector(".dropdown-cat-search");

    dropdown.classList.add("hidden");
    dropdown.classList.remove("block");
    const cat = catEl.dataset.cat;
    buttonText.innerHTML = cat || "Toutes catégories";
    hiddenInput.value = cat;
  });
}

document.addEventListener("DOMContentLoaded", function () {
  initDarkMode();
  initSearchDropdown();
});
