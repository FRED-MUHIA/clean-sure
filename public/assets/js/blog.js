(() => {
  const postsContainer = document.getElementById("blog-posts");
  const emptyState = document.getElementById("blog-empty");
  const searchInput = document.getElementById("blog-search");
  const categoriesContainer = document.getElementById("blog-categories");

  if (!postsContainer) return;

  let posts = [];
  let activeCategory = "All";

  const stripHtml = (html) => {
    const temp = document.createElement("div");
    temp.innerHTML = html;
    return temp.textContent || temp.innerText || "";
  };

  const normalize = (text) => (text || "").toLowerCase();

  const renderCategories = () => {
    const categories = new Set(posts.map((post) => post.category || "General"));
    const items = ["All", ...Array.from(categories)];
    categoriesContainer.innerHTML = "";
    items.forEach((cat) => {
      const btn = document.createElement("button");
      btn.type = "button";
      btn.className = "category-pill" + (cat === activeCategory ? " is-active" : "");
      btn.textContent = cat;
      btn.addEventListener("click", () => {
        activeCategory = cat;
        renderPosts();
        renderCategories();
      });
      categoriesContainer.appendChild(btn);
    });
  };

  const renderPosts = () => {
    const query = normalize(searchInput?.value);
    const filtered = posts.filter((post) => {
      const matchesCategory = activeCategory === "All" || (post.category || "General") === activeCategory;
      const haystack = normalize(post.title) + " " + normalize(post.excerpt) + " " + normalize(stripHtml(post.content || ""));
      const matchesSearch = !query || haystack.includes(query);
      return matchesCategory && matchesSearch;
    });

    postsContainer.innerHTML = "";
    filtered.forEach((post) => {
      const card = document.createElement("article");
      card.className = "blog-card-large";
      const image = post.image ? `<img src="${post.image}" alt="${post.title || "Blog image"}" />` : "";
      card.innerHTML = `
        ${image}
        <div class="blog-card-body">
          <span>${post.category || "General"}</span>
          <h3>${post.title || ""}</h3>
          <p>${post.excerpt || stripHtml(post.content || "").slice(0, 120)}</p>
          <a class="blog-readmore" href="/blog/${encodeURIComponent(post.id || "")}">Read more</a>
        </div>
      `;
      postsContainer.appendChild(card);
    });

    emptyState.hidden = filtered.length > 0;
  };

  const loadPosts = async () => {
    try {
      const response = await fetch("/data/blogs.json", { cache: "no-store" });
      const data = await response.json();
      posts = Array.isArray(data) ? data : [];
      posts.sort((a, b) => new Date(b.date || 0) - new Date(a.date || 0));
      renderCategories();
      renderPosts();
    } catch (err) {
      emptyState.hidden = false;
    }
  };

  if (searchInput) {
    searchInput.addEventListener("input", () => renderPosts());
  }

  loadPosts();
})();
