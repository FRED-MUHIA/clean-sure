(() => {
  const menuToggle = document.getElementById("menu-toggle");
  const mobileMenu = document.getElementById("mobile-menu");

  if (menuToggle && mobileMenu) {
    menuToggle.addEventListener("click", () => {
      const isOpen = mobileMenu.classList.toggle("is-open");
      menuToggle.setAttribute("aria-expanded", String(isOpen));
    });
  }

  let revealObserver = null;
  const reveals = document.querySelectorAll("[data-reveal]");
  if (reveals.length) {
    revealObserver = new IntersectionObserver(
      (entries, obs) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("reveal-visible");
            obs.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.2 }
    );

    reveals.forEach((el) => revealObserver.observe(el));
  }

  const testimonials = Array.from(document.querySelectorAll(".testimonial"));
  const prevBtn = document.getElementById("testimonial-prev");
  const nextBtn = document.getElementById("testimonial-next");
  let index = 0;

  const showSlide = (newIndex) => {
    testimonials.forEach((slide, i) => {
      slide.classList.toggle("is-active", i === newIndex);
    });
  };

  if (testimonials.length) {
    showSlide(index);
    let interval = setInterval(() => {
      index = (index + 1) % testimonials.length;
      showSlide(index);
    }, 7000);

    const resetInterval = () => {
      clearInterval(interval);
      interval = setInterval(() => {
        index = (index + 1) % testimonials.length;
        showSlide(index);
      }, 7000);
    };

    if (prevBtn) {
      prevBtn.addEventListener("click", () => {
        index = (index - 1 + testimonials.length) % testimonials.length;
        showSlide(index);
        resetInterval();
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener("click", () => {
        index = (index + 1) % testimonials.length;
        showSlide(index);
        resetInterval();
      });
    }
  }

  const faqButtons = Array.from(document.querySelectorAll(".faq-item"));
  faqButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const content = button.nextElementSibling;
      if (!content || !content.classList.contains("faq-content")) return;
      const isOpen = content.classList.toggle("is-open");
      button.querySelector("i")?.classList.toggle("fa-plus", !isOpen);
      button.querySelector("i")?.classList.toggle("fa-minus", isOpen);
    });
  });

  const homeBlogGrid = document.getElementById("home-blog-grid");
  const homeBlogEmpty = document.getElementById("home-blog-empty");
  if (homeBlogGrid) {
    const resolveImage = (imagePath) => {
      if (!imagePath) return "";
      if (imagePath.startsWith("http://") || imagePath.startsWith("https://") || imagePath.startsWith("/")) {
        return imagePath;
      }
      return imagePath;
    };

    const createBlogCard = (post) => {
      const article = document.createElement("article");
      article.className = "blog-card";
      article.setAttribute("data-reveal", "");

      const imagePath = resolveImage(post.image || "");
      if (imagePath) {
        const img = document.createElement("img");
        img.src = imagePath;
        img.alt = post.title || "Blog post";
        img.loading = "lazy";
        article.appendChild(img);
      }

      const category = document.createElement("span");
      category.textContent = post.category || "Blog";
      article.appendChild(category);

      const heading = document.createElement("h3");
      const link = document.createElement("a");
      link.href = `/blog/${encodeURIComponent(post.id || "")}`;
      link.textContent = post.title || "Untitled Post";
      heading.appendChild(link);
      article.appendChild(heading);

      if (revealObserver) {
        revealObserver.observe(article);
      } else {
        article.classList.add("reveal-visible");
      }

      return article;
    };

    fetch("/data/blogs.json", { cache: "no-store" })
      .then((response) => response.json())
      .then((data) => {
        const posts = Array.isArray(data) ? data : [];
        posts.sort((a, b) => new Date(b.date || 0) - new Date(a.date || 0));
        const latest = posts.slice(0, 3);
        homeBlogGrid.innerHTML = "";
        latest.forEach((post) => {
          homeBlogGrid.appendChild(createBlogCard(post));
        });
        if (homeBlogEmpty) {
          homeBlogEmpty.hidden = latest.length > 0;
        }
      })
      .catch(() => {
        if (homeBlogEmpty) {
          homeBlogEmpty.hidden = false;
        }
      });
  }

})();
