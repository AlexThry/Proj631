document.addEventListener("DOMContentLoaded", function () {
  const slider = document.getElementById("books");
  const btnLeft = document.getElementById("move-left");
  const btnRight = document.getElementById("move-right");
  const indicators = document.querySelectorAll(".indicator");

  let activeIndex = 0; // the current page on the slider

  // Update the indicators that show which page we're currently on
  function updateIndicators(index) {
    indicators.forEach((indicator) => {
      indicator.classList.remove("active");
    });
    let newActiveIndicator = indicators[index];
    newActiveIndicator.classList.add("active");
  }

  // Scroll Left button
  btnLeft.addEventListener("click", (e) => {
    let bookWidth = document
      .querySelector(".book")
      .getBoundingClientRect().width;
    let scrollDistance = bookWidth * 6; // Scroll the length of 6 books. TODO: make work for mobile because (4 books/page instead of 6)

    slider.scrollBy({
      top: 0,
      left: -scrollDistance,
      behavior: "smooth",
    });
    activeIndex = (activeIndex - 1) % 3;
    updateIndicators(activeIndex);
  });

  // Scroll Right button
  btnRight.addEventListener("click", (e) => {
    let bookWidth = document
      .querySelector(".book")
      .getBoundingClientRect().width;
    let scrollDistance = bookWidth * 6; // Scroll the length of 6 books. TODO: make work for mobile because (4 books/page instead of 6)

    // if we're on the last page
    if (activeIndex == 2) {
      // duplicate all the items in the slider (this is how we make 'looping' slider)
      populateSlider();
      slider.scrollBy({
        top: 0,
        left: +scrollDistance,
        behavior: "smooth",
      });
      activeIndex = 0;
      updateIndicators(activeIndex);
    } else {
      slider.scrollBy({
        top: 0,
        left: +scrollDistance,
        behavior: "smooth",
      });
      activeIndex = (activeIndex + 1) % 3;
      updateIndicators(activeIndex);
    }
  });

  let currentBook = null;
  let timeout = null;

  books.addEventListener("mousemove", (e) => {
    const book = e.target.closest(".book");
    if (!book) {
      if (currentBook) {
        currentBook.classList.remove("hovered");
      }
      currentBook = book;
      return;
    }

    if (currentBook !== book) {
      if (currentBook) {
        // currentBook.classList.remove("hovered");
        // currentBook.classList.remove("first-plan");

        currentBook.classList.remove("hovered");
        book.classList.add("first-plan");
        book.classList.add("hovered");
      } else {
        book.classList.add("first-plan");
        book.classList.add("hovered");
      }
    }

    currentBook = book;
  });

  for (const book of books.querySelectorAll(".book")) {
    book.addEventListener("transitionend", () => {
      if (!book.classList.contains("hovered")) {
        book.classList.remove("first-plan");
      }
    });
  }
});
