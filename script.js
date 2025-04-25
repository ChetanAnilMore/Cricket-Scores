// Mobile menu toggle
document.addEventListener("DOMContentLoaded", function () {
  const mobileMenuButton = document.querySelector(".mobile-menu-button");
  const navList = document.querySelector(".nav-list");

  mobileMenuButton.addEventListener("click", function () {
    const isExpanded = this.getAttribute("aria-expanded") === "true";
    this.setAttribute("aria-expanded", !isExpanded);
    navList.classList.toggle("active");

    // Change icon
    const icon = this.querySelector("i");
    if (isExpanded) {
      icon.classList.remove("fa-times");
      icon.classList.add("fa-bars");
    } else {
      icon.classList.remove("fa-bars");
      icon.classList.add("fa-times");
    }
  });

  // Smooth scrolling for anchor links
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();

      const targetId = this.getAttribute("href");
      if (targetId === "#") return;

      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        window.scrollTo({
          top: targetElement.offsetTop - 80,
          behavior: "smooth",
        });

        // Close mobile menu if open
        if (navList.classList.contains("active")) {
          mobileMenuButton.setAttribute("aria-expanded", "false");
          navList.classList.remove("active");
          const icon = mobileMenuButton.querySelector("i");
          icon.classList.remove("fa-times");
          icon.classList.add("fa-bars");
        }
      }
    });
  });

  // Add animation to cards when they come into view
  const observerOptions = {
    threshold: 0.1,
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("animate");
      }
    });
  }, observerOptions);

  document.querySelectorAll(".card, .match-card").forEach((card) => {
    observer.observe(card);
  });
});
