<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Us | ClanyEco Inspired</title>
    <meta
      name="description"
      content="Learn about our environmental mission, values, and community partnerships."
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;500;600;700&family=Sora:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          eco: {
            green: "#4aa400",
            light: "#f6f6ee",
            dark: "#1f1f1f",
          },
        },
      },
    },
  };
</script>
  </head>
  <body>
    <header class="site-header">
      <div class="container nav-shell">
        <a class="logo" href="/assets/uploads/Untitledx-2_1773153044.png">
          <img class="logo-image" src="/assets/uploads/goxxx_errads-02_1773153239.png" alt="Cleansure logo" />
          Cleansure
        </a>

        <nav class="nav-links" aria-label="Primary">
          <div class="nav-item has-dropdown">
            <button type="button">Home <i class="fa-solid fa-angle-down"></i></button>
            <div class="dropdown">
              <a href="#">Small Cleaning company</a>
              <a href="#">Big Cleaning company</a>
            </div>
          </div>
          <div class="nav-item has-dropdown">
            <button type="button">Services <i class="fa-solid fa-angle-down"></i></button>
            <div class="dropdown">
              <a href="/services">House cleaning</a>
              <a href="/services">Office cleaning</a>
              <a href="/services">Deep cleaning</a>
              <a href="/services">Move in out cleaning</a>
              <a href="/services">Post construction cleaning</a>
              <a href="/services">Recurring cleaning</a>
            </div>
          </div>
          <div class="nav-item has-dropdown">
            <button type="button">About us <i class="fa-solid fa-angle-down"></i></button>
            <div class="dropdown">
              <a href="/about">Who we are</a>
              <a href="/about">Cleaning process</a>
              <a href="/about">Customer reviews</a>
            </div>
          </div>
          <a href="/contact" class="nav-link">Contact us</a>
          <a href="/pricing" class="nav-link">Pricing</a>
          <a href="/blog" class="nav-link">Blog</a>
        </nav>

        <div class="nav-actions">
          <a class="phone-pill" href="tel:+11805678990"><i class="fa-solid fa-phone"></i> + 1 (180) 567-8990</a>
          <button class="icon-btn" aria-label="Search">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
          <a href="/contact" class="btn btn-primary">Free Quote</a>
        </div>

        <button
          id="menu-toggle"
          class="menu-toggle"
          aria-label="Toggle navigation"
          aria-expanded="false"
        >
          <i class="fa-solid fa-bars"></i>
        </button>
      </div>

      <div id="mobile-menu" class="mobile-menu">
        <div class="mobile-section">
          <p>Home</p>
              <a href="#">Small Cleaning company</a>
              <a href="#">Big Cleaning company</a>
        </div>
        <div class="mobile-section">
          <p>Services</p>
              <a href="/services">House cleaning</a>
              <a href="/services">Office cleaning</a>
              <a href="/services">Deep cleaning</a>
              <a href="/services">Move in out cleaning</a>
              <a href="/services">Post construction cleaning</a>
              <a href="/services">Recurring cleaning</a>
        </div>
        <div class="mobile-section">
          <p>About us</p>
              <a href="/about">Who we are</a>
              <a href="/about">Cleaning process</a>
              <a href="/about">Customer reviews</a>
        </div>
        <a href="/contact">Contact us</a>
        <a href="/pricing">Pricing</a>
        <a href="/blog">Blog</a>
        <a href="/contact" class="btn btn-primary">Free Quote</a>
      </div>
    </header>

    <main>
      <section
        class="relative min-h-[50vh] flex items-center"
        style="background-image: url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1600&q=80'); background-size: cover; background-position: center;"
      >
        <div class="absolute inset-0 hero-overlay"></div>
        <div class="relative max-w-6xl mx-auto px-6 py-20 text-white">
          <p class="section-kicker text-xs uppercase tracking-widest text-white/70">About Us</p>
          <h1 class="text-4xl md:text-5xl font-semibold mt-4">Building climate resilience together</h1>
          <p class="mt-4 text-white/85 max-w-2xl">
            We connect people, policy, and planet-friendly innovation to protect natural ecosystems and uplift
            communities.
          </p>
        </div>
      </section>

      <section class="py-20">
        <div class="max-w-6xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center">
          <div data-aos="fade-right">
            <p class="section-kicker text-xs uppercase text-eco-green font-semibold">Our Story</p>
            <h2 class="text-3xl md:text-4xl font-semibold mt-3">From local action to global impact</h2>
            <p class="mt-4 text-eco-dark/70">
              ClanyEco began with a small coastal restoration project and grew into a multi-region network of
              conservation leaders, educators, and volunteers. We believe thriving ecosystems start with
              empowered communities.
            </p>
            <div class="mt-6 grid sm:grid-cols-2 gap-4">
              <div class="bg-white rounded-2xl p-5 shadow-soft">
                <h3 class="text-xl font-semibold">40+</h3>
                <p class="text-sm text-eco-dark/70">Partner regions</p>
              </div>
              <div class="bg-white rounded-2xl p-5 shadow-soft">
                <h3 class="text-xl font-semibold">120K</h3>
                <p class="text-sm text-eco-dark/70">Trees planted</p>
              </div>
            </div>
          </div>
          <div class="relative" data-aos="fade-left">
            <img
              src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=900&q=80"
              alt="Team working on environmental project"
              class="rounded-3xl shadow-soft"
              loading="lazy"
            />
          </div>
        </div>
      </section>

      <section class="py-20 bg-eco-light">
        <div class="max-w-6xl mx-auto px-6">
          <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl p-8 shadow-soft card-hover" data-aos="fade-up">
              <i class="fa-solid fa-leaf text-eco-green text-2xl"></i>
              <h3 class="mt-5 font-semibold">Purpose</h3>
              <p class="mt-3 text-sm text-eco-dark/70">Restore biodiversity and safeguard natural resources.</p>
            </div>
            <div class="bg-white rounded-2xl p-8 shadow-soft card-hover" data-aos="fade-up" data-aos-delay="80">
              <i class="fa-solid fa-handshake text-eco-green text-2xl"></i>
              <h3 class="mt-5 font-semibold">Partnership</h3>
              <p class="mt-3 text-sm text-eco-dark/70">Co-designing solutions with community leadership.</p>
            </div>
            <div class="bg-white rounded-2xl p-8 shadow-soft card-hover" data-aos="fade-up" data-aos-delay="160">
              <i class="fa-solid fa-chart-line text-eco-green text-2xl"></i>
              <h3 class="mt-5 font-semibold">Transparency</h3>
              <p class="mt-3 text-sm text-eco-dark/70">Measuring impact with clear data and open reporting.</p>
            </div>
          </div>
        </div>
      </section>

      <section class="py-20">
        <div class="max-w-6xl mx-auto px-6">
          <div class="flex items-center justify-between flex-wrap gap-6" data-aos="fade-up">
            <div>
              <p class="section-kicker text-xs uppercase text-eco-green font-semibold">Leadership</p>
              <h2 class="text-3xl md:text-4xl font-semibold mt-3">Meet our core team</h2>
            </div>
            <a href="{{ route('contact') }}" class="text-sm font-semibold text-eco-green">Join the team</a>
          </div>
          <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl p-6 shadow-soft card-hover" data-aos="zoom-in">
              <img
                src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=600&q=80"
                alt="Executive Director"
                class="rounded-2xl h-56 w-full object-cover"
                loading="lazy"
              />
              <h3 class="mt-4 font-semibold">Avery Kim</h3>
              <p class="text-sm text-eco-dark/70">Executive Director</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-soft card-hover" data-aos="zoom-in" data-aos-delay="80">
              <img
                src="https://images.unsplash.com/photo-1544723795-3fb6469f5b39?auto=format&fit=crop&w=600&q=80"
                alt="Impact Strategist"
                class="rounded-2xl h-56 w-full object-cover"
                loading="lazy"
              />
              <h3 class="mt-4 font-semibold">Noah Lee</h3>
              <p class="text-sm text-eco-dark/70">Impact Strategist</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-soft card-hover" data-aos="zoom-in" data-aos-delay="160">
              <img
                src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=600&q=80"
                alt="Programs Lead"
                class="rounded-2xl h-56 w-full object-cover"
                loading="lazy"
              />
              <h3 class="mt-4 font-semibold">Priya Patel</h3>
              <p class="text-sm text-eco-dark/70">Programs Lead</p>
            </div>
          </div>
        </div>
      </section>

      <section class="py-16">
        <div class="max-w-6xl mx-auto px-6">
          <div class="bg-eco-green rounded-3xl px-8 py-12 md:px-16 text-white flex flex-col md:flex-row items-center justify-between gap-8">
            <div>
              <h2 class="text-3xl md:text-4xl font-semibold">Ready to take action with us?</h2>
              <p class="mt-3 text-white/85">
                Partner with ClanyEco for sustainable projects in your region.
              </p>
            </div>
            <a href="{{ route('contact') }}" class="bg-white text-eco-green px-6 py-3 rounded-full font-semibold">
              Contact Us
            </a>
          </div>
        </div>
      </section>
    </main>

    <footer class="site-footer">
      <div class="container footer-shell">
        <div class="footer-top">
          <div class="footer-cta">
            <h2>Our Goal is to Wow You With Every Clean</h2>
            <a href="{{ route('contact') }}" class="btn btn-primary">Get a Free Quote</a>
          </div>
          <div class="footer-newsletter">
            <p class="section-label">Subscribe to Our Newsletter</p>
            <form>
              <input type="email" placeholder="Enter our email address" />
              <button type="submit" class="btn btn-green">Subscrible</button>
            </form>
          </div>
        </div>

        <div class="footer-grid">
          <div>
            <h4>Services</h4>
            <div class="footer-links">
              <a href="{{ route('services') }}">House cleaning</a>
              <a href="{{ route('services') }}">Office cleaning</a>
              <a href="{{ route('services') }}">Apartment cleaning</a>
              <a href="{{ route('services') }}">Airbnb cleaning</a>
              <a href="{{ route('services') }}">Deep cleaning</a>
              <a href="{{ route('services') }}">Move in out cleaning</a>
              <a href="{{ route('services') }}">Post construction cleaning</a>
              <a href="{{ route('services') }}">Recurring cleaning</a>
            </div>
          </div>
          <div>
            <h4>Contact Info</h4>
            <p>72 Kneeland St, Suite 305, New York, MA 02111</p>
            <div class="footer-phone">
              <span><i class="fa-solid fa-phone"></i></span>
              + 1 (180) 567-8990
            </div>
            <a class="footer-email" href="mailto:contact@clanyeco.com">contact@clanyeco.com</a>
          </div>
          <div>
            <h4>Working hours</h4>
            <p>Mon – Fri: 9.00am – 8.00pm</p>
            <p>Saturday: 10.00am – 8.00pm</p>
            <p>Sunday: 10.00am – 4.00pm</p>
          </div>
        </div>

        <div class="footer-bottom">
          <p>© 2026 VamTam. All Rights Reserved</p>
          <div class="footer-socials">
            <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
          </div>
        </div>
      </div>
    </footer>

        <script src="{{ asset('assets/js/home.js') }}"></script>
  </body>
</html>




