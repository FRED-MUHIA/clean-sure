<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Services | ClanyEco Inspired</title>
    <meta
      name="description"
      content="Explore eco-friendly services including recycling, reforestation, and clean water programs."
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
        class="relative min-h-[45vh] flex items-center"
        style="background-image: url('https://images.unsplash.com/photo-1493810329807-1dc5c1b3f4a0?auto=format&fit=crop&w=1600&q=80'); background-size: cover; background-position: center;"
      >
        <div class="absolute inset-0 hero-overlay"></div>
        <div class="relative max-w-6xl mx-auto px-6 py-16 text-white">
          <p class="section-kicker text-xs uppercase tracking-widest text-white/70">Services</p>
          <h1 class="text-4xl md:text-5xl font-semibold mt-4">Programs designed for lasting impact</h1>
          <p class="mt-4 text-white/85 max-w-2xl">
            We deliver end-to-end programs that support environmental protection, clean energy, and community
            resilience.
          </p>
        </div>
      </section>

      <section class="py-20">
        <div class="max-w-6xl mx-auto px-6">
          <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl p-7 shadow-soft card-hover" data-aos="fade-up">
              <i class="fa-solid fa-recycle text-eco-green text-2xl"></i>
              <h3 class="mt-4 font-semibold">Recycling Programs</h3>
              <p class="mt-3 text-sm text-eco-dark/70">
                Neighborhood recycling hubs with training and logistics support.
              </p>
            </div>
            <div class="bg-white rounded-2xl p-7 shadow-soft card-hover" data-aos="fade-up" data-aos-delay="80">
              <i class="fa-solid fa-tree text-eco-green text-2xl"></i>
              <h3 class="mt-4 font-semibold">Tree Planting</h3>
              <p class="mt-3 text-sm text-eco-dark/70">
                Climate-smart reforestation guided by local ecological data.
              </p>
            </div>
            <div class="bg-white rounded-2xl p-7 shadow-soft card-hover" data-aos="fade-up" data-aos-delay="160">
              <i class="fa-solid fa-water text-eco-green text-2xl"></i>
              <h3 class="mt-4 font-semibold">Clean Water Access</h3>
              <p class="mt-3 text-sm text-eco-dark/70">
                Safe water systems with maintenance and community ownership.
              </p>
            </div>
            <div class="bg-white rounded-2xl p-7 shadow-soft card-hover" data-aos="fade-up">
              <i class="fa-solid fa-solar-panel text-eco-green text-2xl"></i>
              <h3 class="mt-4 font-semibold">Renewable Energy</h3>
              <p class="mt-3 text-sm text-eco-dark/70">
                Solar microgrids that power schools, clinics, and homes.
              </p>
            </div>
            <div class="bg-white rounded-2xl p-7 shadow-soft card-hover" data-aos="fade-up" data-aos-delay="80">
              <i class="fa-solid fa-book-open text-eco-green text-2xl"></i>
              <h3 class="mt-4 font-semibold">Eco Education</h3>
              <p class="mt-3 text-sm text-eco-dark/70">
                Workshops and curriculum co-created with educators.
              </p>
            </div>
            <div class="bg-white rounded-2xl p-7 shadow-soft card-hover" data-aos="fade-up" data-aos-delay="160">
              <i class="fa-solid fa-hand-holding-heart text-eco-green text-2xl"></i>
              <h3 class="mt-4 font-semibold">Volunteer Mobilization</h3>
              <p class="mt-3 text-sm text-eco-dark/70">
                Campaigns that inspire action and build environmental leadership.
              </p>
            </div>
          </div>
        </div>
      </section>

      <section class="py-20 bg-eco-light">
        <div class="max-w-6xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center">
          <div data-aos="fade-right">
            <p class="section-kicker text-xs uppercase text-eco-green font-semibold">How It Works</p>
            <h2 class="text-3xl md:text-4xl font-semibold mt-3">A collaborative delivery model</h2>
            <p class="mt-4 text-eco-dark/70">
              We partner with local organizations, measure impact, and scale proven solutions with continual
              learning.
            </p>
          </div>
          <div class="grid gap-6" data-aos="fade-left">
            <div class="bg-white rounded-2xl p-6 shadow-soft">
              <h3 class="font-semibold">1. Assess & Co-Design</h3>
              <p class="mt-2 text-sm text-eco-dark/70">We identify local needs and develop solutions together.</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-soft">
              <h3 class="font-semibold">2. Launch & Support</h3>
              <p class="mt-2 text-sm text-eco-dark/70">On-the-ground delivery with training and toolkits.</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-soft">
              <h3 class="font-semibold">3. Measure & Scale</h3>
              <p class="mt-2 text-sm text-eco-dark/70">Data-driven reporting to amplify successful programs.</p>
            </div>
          </div>
        </div>
      </section>

      <section class="py-16">
        <div class="max-w-6xl mx-auto px-6">
          <div class="bg-eco-green rounded-3xl px-8 py-12 md:px-16 text-white flex flex-col md:flex-row items-center justify-between gap-8">
            <div>
              <h2 class="text-3xl md:text-4xl font-semibold">Need a tailored program?</h2>
              <p class="mt-3 text-white/85">Tell us about your community goals and we will build a plan.</p>
            </div>
            <a href="{{ route('contact') }}" class="bg-white text-eco-green px-6 py-3 rounded-full font-semibold">
              Request a Consult
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




