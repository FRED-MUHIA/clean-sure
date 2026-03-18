(() => {
  const menuToggle = document.getElementById("menu-toggle");
  const mobileMenu = document.getElementById("mobile-menu");

  if (menuToggle && mobileMenu) {
    menuToggle.addEventListener("click", () => {
      mobileMenu.classList.toggle("hidden");
    });
  }

  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", (event) => {
      const targetId = anchor.getAttribute("href");
      if (!targetId || targetId.length < 2) return;
      const target = document.querySelector(targetId);
      if (!target) return;
      event.preventDefault();
      target.scrollIntoView({ behavior: "smooth", block: "start" });
    });
  });

  const counterElements = document.querySelectorAll("[data-count]");
  if (counterElements.length) {
    const animateCounter = (el) => {
      const target = Number(el.dataset.count || 0);
      const duration = 1600;
      const start = 0;
      const startTime = performance.now();

      const tick = (now) => {
        const progress = Math.min((now - startTime) / duration, 1);
        const value = Math.floor(start + (target - start) * progress);
        el.textContent = value.toLocaleString();
        if (progress < 1) {
          requestAnimationFrame(tick);
        }
      };

      requestAnimationFrame(tick);
    };

    const observer = new IntersectionObserver(
      (entries, obs) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            animateCounter(entry.target);
            obs.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.6 }
    );

    counterElements.forEach((el) => observer.observe(el));
  }

  const testimonials = document.querySelectorAll(".testimonial-slide");
  const prevBtn = document.getElementById("testimonial-prev");
  const nextBtn = document.getElementById("testimonial-next");
  let currentIndex = 0;

  const showSlide = (index) => {
    testimonials.forEach((slide, i) => {
      slide.classList.toggle("hidden", i !== index);
    });
  };

  const nextSlide = () => {
    currentIndex = (currentIndex + 1) % testimonials.length;
    showSlide(currentIndex);
  };

  if (testimonials.length) {
    showSlide(currentIndex);
    const interval = setInterval(nextSlide, 6000);

    if (prevBtn) {
      prevBtn.addEventListener("click", () => {
        currentIndex = (currentIndex - 1 + testimonials.length) % testimonials.length;
        showSlide(currentIndex);
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener("click", () => {
        nextSlide();
      });
    }

    window.addEventListener("blur", () => clearInterval(interval));
  }

  if (window.AOS) {
    window.AOS.init({
      duration: 800,
      easing: "ease-out-cubic",
      once: true,
      offset: 80,
    });
  }
})();
