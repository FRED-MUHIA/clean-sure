<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pricing | ClanyEco</title>
    <meta
      name="description"
      content="Transparent cleaning plans for homes and offices with flexible one-time and recurring pricing."
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
        class="relative min-h-[48vh] flex items-center"
        style="background-image: url('https://images.unsplash.com/photo-1563453392212-326f5e854473?auto=format&fit=crop&w=1800&q=80'); background-size: cover; background-position: center;"
      >
        <div class="absolute inset-0 hero-overlay"></div>
        <div class="relative max-w-6xl mx-auto px-6 py-16 text-white">
          <p class="section-kicker text-xs uppercase tracking-widest text-white/70">Pricing</p>
          <h1 class="text-4xl md:text-5xl font-semibold mt-4">Flexible plans for every type of clean</h1>
          <p class="mt-4 text-white/85 max-w-2xl">
            Simple, transparent packages inspired by modern cleaning brands. Choose the plan that fits your space,
            frequency, and service level.
          </p>
          <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ route('contact') }}" class="btn btn-primary">Get Exact Quote</a>
            <a href="#plans" class="btn btn-outline" style="border-color: #ffffff; color: #ffffff;">See Plans</a>
          </div>
        </div>
      </section>

      <section id="plans" class="py-20 bg-[#f6f6ee]">
        <div class="max-w-6xl mx-auto px-6">
          <div class="text-center max-w-3xl mx-auto">
            <p class="section-kicker text-xs uppercase tracking-widest text-eco-green">Plans & Packages</p>
            <h2 class="text-3xl md:text-4xl font-semibold mt-3">Choose your cleaning experience</h2>
            <p class="mt-4 text-eco-dark/70">
              Pricing starts here, then we tailor based on size, condition, and extras.
            </p>
          </div>

          <div class="mt-12 grid lg:grid-cols-3 gap-7">
            <article class="bg-white rounded-3xl p-7 shadow-soft border border-[#ecf0e1]" data-reveal>
              <p class="text-sm uppercase tracking-widest text-eco-green font-semibold">Starter</p>
              <h3 class="text-2xl font-semibold mt-3">Eco Refresh</h3>
              <p class="text-4xl font-semibold mt-4">$119 <span class="text-base font-normal text-eco-dark/60">/ visit</span></p>
              <p class="mt-2 text-sm text-eco-dark/65">For apartments and small homes that need routine care.</p>
              <ul class="mt-6 space-y-3 text-sm text-eco-dark/80">
                <li><i class="fa-solid fa-check text-eco-green"></i> Kitchen wipe-down and sanitizing</li>
                <li><i class="fa-solid fa-check text-eco-green"></i> Bathroom refresh (1-2 bathrooms)</li>
                <li><i class="fa-solid fa-check text-eco-green"></i> Vacuum + mop all floors</li>
                <li><i class="fa-solid fa-check text-eco-green"></i> Dusting reachable surfaces</li>
              </ul>
              <a href="{{ route('contact') }}" class="btn btn-outline w-full mt-7">Choose Starter</a>
            </article>

            <article class="bg-white rounded-3xl p-7 shadow-soft border-2 border-eco-green relative" data-reveal>
              <span class="absolute -top-3 right-6 bg-eco-green text-white text-xs font-semibold uppercase tracking-wider px-3 py-1 rounded-full">Most Popular</span>
              <p class="text-sm uppercase tracking-widest text-eco-green font-semibold">Standard</p>
              <h3 class="text-2xl font-semibold mt-3">Essential Care</h3>
              <p class="text-4xl font-semibold mt-4">$189 <span class="text-base font-normal text-eco-dark/60">/ visit</span></p>
              <p class="mt-2 text-sm text-eco-dark/65">Best for family homes needing deeper, consistent cleaning.</p>
              <ul class="mt-6 space-y-3 text-sm text-eco-dark/80">
                <li><i class="fa-solid fa-check text-eco-green"></i> Everything in Eco Refresh</li>
                <li><i class="fa-solid fa-check text-eco-green"></i> Detailed baseboard and surface dusting</li>
                <li><i class="fa-solid fa-check text-eco-green"></i> Bedroom linen change (on request)</li>
                <li><i class="fa-solid fa-check text-eco-green"></i> Spot-clean doors and switches</li>
              </ul>
              <a href="{{ route('contact') }}" class="btn btn-primary w-full mt-7">Choose Essential</a>
            </article>

            <article class="bg-white rounded-3xl p-7 shadow-soft border border-[#ecf0e1]" data-reveal>
              <p class="text-sm uppercase tracking-widest text-eco-green font-semibold">Premium</p>
              <h3 class="text-2xl font-semibold mt-3">Deep Reset</h3>
              <p class="text-4xl font-semibold mt-4">$289 <span class="text-base font-normal text-eco-dark/60">/ visit</span></p>
              <p class="mt-2 text-sm text-eco-dark/65">For move-ins, move-outs, or seasonal deep cleaning days.</p>
              <ul class="mt-6 space-y-3 text-sm text-eco-dark/80">
                <li><i class="fa-solid fa-check text-eco-green"></i> Everything in Essential Care</li>
                <li><i class="fa-solid fa-check text-eco-green"></i> Inside appliance cleaning</li>
                <li><i class="fa-solid fa-check text-eco-green"></i> Window interior detailing</li>
                <li><i class="fa-solid fa-check text-eco-green"></i> Extra attention high-touch points</li>
              </ul>
              <a href="{{ route('contact') }}" class="btn btn-outline w-full mt-7">Choose Premium</a>
            </article>
          </div>

          <p class="mt-8 text-sm text-eco-dark/60 text-center">
            Need office or post-construction pricing? <a href="{{ route('contact') }}" class="text-eco-green font-semibold">Request a custom proposal</a>.
          </p>
        </div>
      </section>

      <section class="py-20">
        <div class="max-w-6xl mx-auto px-6">
          <div class="grid lg:grid-cols-2 gap-10 items-start">
            <div data-reveal>
              <p class="section-kicker text-xs uppercase tracking-widest text-eco-green">What is Included</p>
              <h2 class="text-3xl md:text-4xl font-semibold mt-3">Compare package coverage</h2>
              <p class="mt-4 text-eco-dark/70">
                Every plan uses eco-friendly products, insured teams, and detailed checklists.
              </p>
              <ul class="mt-6 space-y-3 text-eco-dark/80">
                <li><i class="fa-solid fa-shield-heart text-eco-green"></i> Fully insured and vetted professionals</li>
                <li><i class="fa-solid fa-leaf text-eco-green"></i> Family-safe, eco-conscious supplies</li>
                <li><i class="fa-solid fa-calendar-check text-eco-green"></i> Easy rescheduling and recurring discounts</li>
              </ul>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-soft overflow-x-auto" data-reveal>
              <table class="w-full text-sm">
                <thead>
                  <tr class="text-left border-b">
                    <th class="py-2">Service Item</th>
                    <th class="py-2">Starter</th>
                    <th class="py-2">Essential</th>
                    <th class="py-2">Premium</th>
                  </tr>
                </thead>
                <tbody class="text-eco-dark/80">
                  <tr class="border-b"><td class="py-3">Kitchen & Bath</td><td>Core</td><td>Detailed</td><td>Detailed+</td></tr>
                  <tr class="border-b"><td class="py-3">Bedrooms & Living Areas</td><td>Core</td><td>Detailed</td><td>Detailed+</td></tr>
                  <tr class="border-b"><td class="py-3">Inside Appliances</td><td>-</td><td>Optional</td><td>Included</td></tr>
                  <tr class="border-b"><td class="py-3">Interior Windows</td><td>-</td><td>-</td><td>Included</td></tr>
                  <tr><td class="py-3">Priority Scheduling</td><td>-</td><td>Yes</td><td>Yes</td></tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>

      <section class="py-20 bg-eco-light">
        <div class="max-w-4xl mx-auto px-6">
          <div class="text-center mb-10" data-reveal>
            <p class="section-kicker text-xs uppercase tracking-widest text-eco-green">FAQ</p>
            <h2 class="text-3xl md:text-4xl font-semibold mt-3">Pricing questions, answered</h2>
          </div>

          <div class="space-y-4" data-reveal>
            <button class="faq-item" type="button">
              <span>Do you offer recurring discounts?</span>
              <i class="fa-solid fa-plus"></i>
            </button>
            <div class="faq-content">
              <p>Yes. Weekly and bi-weekly recurring plans receive lower per-visit rates compared to one-time bookings.</p>
            </div>

            <button class="faq-item" type="button">
              <span>Can I customize what is included?</span>
              <i class="fa-solid fa-plus"></i>
            </button>
            <div class="faq-content">
              <p>Absolutely. We can add or remove tasks and adjust duration to match your home, budget, and priorities.</p>
            </div>

            <button class="faq-item" type="button">
              <span>Is there a cancellation fee?</span>
              <i class="fa-solid fa-plus"></i>
            </button>
            <div class="faq-content">
              <p>Cancellations are free with at least 24 hours notice. Late changes may include a small service fee.</p>
            </div>
          </div>
        </div>
      </section>

      <section class="py-20">
        <div class="max-w-6xl mx-auto px-6">
          <div class="bg-white rounded-3xl px-8 py-10 md:px-12 md:py-14 shadow-soft border border-[#ecf0e1] text-center" data-reveal>
            <p class="section-kicker text-xs uppercase tracking-widest text-eco-green">Ready to book?</p>
            <h2 class="text-3xl md:text-4xl font-semibold mt-3">Get your personalized quote in minutes</h2>
            <p class="mt-4 text-eco-dark/70 max-w-2xl mx-auto">
              Tell us your space details and preferred schedule. We will send a fixed quote and recommended package.
            </p>
            <div class="mt-8 flex flex-wrap gap-3 justify-center">
              <a href="{{ route('contact') }}" class="btn btn-primary">Start Free Quote</a>
              <a href="tel:+11805678990" class="btn btn-outline">Call +1 (180) 567-8990</a>
            </div>
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




