<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact | ClanyEco Inspired</title>
    <meta
      name="description"
      content="Contact our environmental NGO for partnerships, volunteering, and donations."
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
        class="relative min-h-[40vh] flex items-center"
        style="background-image: url('https://images.unsplash.com/photo-1441974231531-c6227db76b6e?auto=format&fit=crop&w=1600&q=80'); background-size: cover; background-position: center;"
      >
        <div class="absolute inset-0 hero-overlay"></div>
        <div class="relative max-w-6xl mx-auto px-6 py-16 text-white">
          <p class="section-kicker text-xs uppercase tracking-widest text-white/70">Contact</p>
          <h1 class="text-4xl md:text-5xl font-semibold mt-4">Let’s collaborate on climate solutions</h1>
          <p class="mt-4 text-white/85 max-w-2xl">
            Reach out for partnerships, volunteering, or program support. We respond within two business days.
          </p>
        </div>
      </section>

      <section class="py-20">
        <div class="max-w-6xl mx-auto px-6 grid lg:grid-cols-[1.1fr,0.9fr] gap-12">
          <div id="contact-form" class="bg-white rounded-3xl p-8 shadow-soft" data-aos="fade-right">
            <h2 class="text-3xl font-semibold">Send a message</h2>
            <p class="mt-3 text-eco-dark/70">Tell us about your project, event, or collaboration idea.</p>
            <form class="mt-6 grid gap-4">
              <div class="grid sm:grid-cols-2 gap-4">
                <input type="text" placeholder="First name" class="px-4 py-3 rounded-xl bg-eco-light" />
                <input type="text" placeholder="Last name" class="px-4 py-3 rounded-xl bg-eco-light" />
              </div>
              <input type="email" placeholder="Email address" class="px-4 py-3 rounded-xl bg-eco-light" />
              <input type="text" placeholder="Organization" class="px-4 py-3 rounded-xl bg-eco-light" />
              <textarea
                rows="5"
                placeholder="How can we help?"
                class="px-4 py-3 rounded-xl bg-eco-light"
              ></textarea>
              <button type="submit" class="btn-eco px-6 py-3 rounded-full font-semibold">
                Send Message
              </button>
            </form>
          </div>
          <div class="space-y-6" data-aos="fade-left">
            <div class="bg-white rounded-2xl p-6 shadow-soft">
              <h3 class="font-semibold">Head Office</h3>
              <p class="mt-3 text-sm text-eco-dark/70">140 Greenway Blvd, Portland, OR 97204</p>
              <p class="mt-2 text-sm text-eco-dark/70">+1 (555) 010-2026</p>
              <p class="text-sm text-eco-dark/70">contact@clanyeco.org</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-soft">
              <h3 class="font-semibold">Regional Hubs</h3>
              <p class="mt-3 text-sm text-eco-dark/70">Nairobi • São Paulo • Jakarta • Vancouver</p>
              <p class="mt-2 text-sm text-eco-dark/70">partnerships@clanyeco.org</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-soft">
              <h3 class="font-semibold">Office Hours</h3>
              <p class="mt-3 text-sm text-eco-dark/70">Mon - Fri: 9:00 AM - 6:00 PM</p>
              <p class="text-sm text-eco-dark/70">Sat: 10:00 AM - 2:00 PM</p>
            </div>
          </div>
        </div>
      </section>

      <section class="py-16 bg-eco-light">
        <div class="max-w-6xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center">
          <div data-aos="fade-right">
            <p class="section-kicker text-xs uppercase text-eco-green font-semibold">Visit Us</p>
            <h2 class="text-3xl md:text-4xl font-semibold mt-3">Find our community hub</h2>
            <p class="mt-4 text-eco-dark/70">
              We host weekly workshops, volunteer orientations, and sustainable design meetups.
            </p>
          </div>
          <div class="rounded-3xl overflow-hidden shadow-soft" data-aos="fade-left">
            <iframe
              title="Map"
              src="https://maps.google.com/maps?q=Portland%20OR&t=&z=13&ie=UTF8&iwloc=&output=embed"
              class="w-full h-64"
              loading="lazy"
            ></iframe>
          </div>
        </div>
      </section>

      <section class="py-16">
        <div class="max-w-6xl mx-auto px-6">
          <div class="bg-eco-green rounded-3xl px-8 py-12 md:px-16 text-white flex flex-col md:flex-row items-center justify-between gap-8">
            <div>
              <h2 class="text-3xl md:text-4xl font-semibold">Ready to volunteer?</h2>
              <p class="mt-3 text-white/85">Join upcoming events and training sessions.</p>
            </div>
            <a href="{{ route('services') }}" class="bg-white text-eco-green px-6 py-3 rounded-full font-semibold">
              View Opportunities
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




