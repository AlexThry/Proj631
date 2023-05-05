class BookEventHandler {
  constructor(book) {
    if (!book) throw new Error("No book found");
    this.book = book;
    this.timeout = null;
    this.book.addEventListener("mouseenter", this.handleMouseEnter.bind(this));
    this.book.addEventListener("mouseleave", this.handleMouseLeave.bind(this));
  }

  handleMouseEnter(e) {
    if (this.timeout) {
      this.book.classList.add("hovered");
      clearTimeout(this.timeout);
      return;
    }

    this.timeout = setTimeout(() => {
      this.book.classList.add("first-plan");
      this.book.classList.add("hovered");
      this.timeout = null;
    }, 500);
  }

  handleMouseLeave(e) {
    if (this.timeout) {
      clearTimeout(this.timeout);
      return;
    }

    this.book.classList.remove("hovered");
    this.timeout = setTimeout(() => {
      this.book.classList.remove("first-plan");
      this.timeout = null;
    }, 800);
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const slider = document.getElementById("books");
  const btnLeft = document.getElementById("moveLeft");
  const btnRight = document.getElementById("moveRight");
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

  for (const book of books.querySelectorAll(".book")) {
    new BookEventHandler(book);
  }
});
