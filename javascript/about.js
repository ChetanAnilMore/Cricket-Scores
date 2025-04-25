document.addEventListener("DOMContentLoaded", function () {
  // Animate statistics numbers
  const statNumbers = document.querySelectorAll(".stat-number");

  const animateNumbers = () => {
    statNumbers.forEach((stat) => {
      const target = parseInt(stat.getAttribute("data-count"));
      const duration = 2000; // Animation duration in ms
      const step = target / (duration / 16); // 60fps
      let current = 0;

      const updateNumber = () => {
        current += step;
        if (current < target) {
          stat.textContent = Math.floor(current);
          requestAnimationFrame(updateNumber);
        } else {
          stat.textContent = target;
        }
      };

      // Only animate when element is in viewport
      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            updateNumber();
            observer.unobserve(entry.target);
          }
        });
      });

      observer.observe(stat);
    });
  };

  animateNumbers();

  // Mobile menu toggle (same as main script)
  const mobileMenuButton = document.querySelector(".mobile-menu-button");
  const navList = document.querySelector(".nav-list");

  if (mobileMenuButton && navList) {
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
  }
});
