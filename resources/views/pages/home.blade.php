<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ClanyEco | Cleaning Services</title>
    <meta
      name="description"
      content="Sparkly residential and commercial cleaning services with instant pricing and vetted teams."
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
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}" />
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
<section class="hero">
        <div class="container">
          <div class="hero-shell">
            <img class="hero-image" src="/assets/uploads/aagnnna_1773129895.jpg" alt="Professional cleaner holding cleaning supplies" loading="eager" data-src-original="assets/uploads/aagnnna_1773129895.jpg">
            <div class="hero-overlay"></div>

            <div class="hero-card" data-reveal="">
              <h1>
                Sparkly Residential
                <span>and Commercial</span>
                Cleaning Services Nairobi Kenya</h1>
              <p>
                Stop wasting your precious free time cleaning, relax while we make
                your home sparkle!
              </p>
              <div class="hero-actions">
                <a href="{{ route('contact') }}" class="btn btn-primary">Free Quote</a>
                <a href="{{ route('services') }}" class="btn btn-outline">Our Services</a>
              </div>
              <div class="hero-features">
                <span><i class="fa-solid fa-circle-check"></i> Professional</span>
                <span><i class="fa-solid fa-circle-check"></i> Friendly</span>
                <span><i class="fa-solid fa-circle-check"></i> Convenient</span>
              </div>
              <img class="leaf-bloom uploaded-image" src="/assets/uploads/Untitledx-2_1773130575.png" alt="Leaf accent" data-src-original="assets/uploads/Untitledx-2_1773130575.png">
            </div>

            <div class="hero-rating" data-reveal="">
              <div class="rating-score">4.8</div>
              <div>
                <div class="rating-stars">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star-half-stroke"></i>
                </div>
                <p>480 Reviews</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="how-it-works">
        <div class="container">
          <p class="section-label">How it works</p>
          <h2>Quick and Easy</h2>
          <div class="steps">
            <article class="step-card" data-reveal="">
              <div class="step-visual">
                <span class="leaf-accent" aria-hidden="true"></span>
                <i class="fa-regular fa-calendar-check"></i>
              </div>
              <h3>Free Quote</h3>
              <p>Tell us about your home and choose the date you want.</p>
            </article>
            <article class="step-card" data-reveal="">
              <div class="step-visual">
                <span class="leaf-accent" aria-hidden="true"></span>
                <i class="fa-solid fa-spray-can-sparkles"></i>
              </div>
              <h3>Clean</h3>
              <p>Our seasoned team of full-time cleaners will transform your home.</p>
            </article>
            <article class="step-card" data-reveal="">
              <div class="step-visual">
                <span class="leaf-accent" aria-hidden="true"></span>
                <i class="fa-regular fa-face-smile"></i>
              </div>
              <h3>Relax</h3>
              <p>Sit back and enjoy how amazing your home or business looks now.</p>
            </article>
          </div>
        </div>
      </section>

      <section class="who-we-are">
        <div class="container split">
          <div class="split-content" data-reveal="">
            <p class="section-label">Who we are</p>
            <h2>We Are the Best Option for a Sparkling Home</h2>
            <p>
              At Clany Eco, our mission is to provide the most convenient platform for connecting
              you with exceptional, professional cleaners who deliver outstanding results.
            </p>
            <ul class="check-list">
              <li>We always keep you up to date on your cleaning</li>
              <li>The cleaners treat your home like their own home</li>
            </ul>
            <a href="{{ route('about') }}" class="btn btn-outline">Learn More</a>
          </div>
          <div class="split-image" data-reveal="">
            <img src="/assets/uploads/97c9ad6327_1773154603.jpg" alt="Cleaner wiping a countertop" loading="lazy" data-src-original="assets/uploads/97c9ad6327_1773154603.jpg">
          </div>
        </div>
      </section>

      <section class="why-choose">
        <div class="container">
          <p class="section-label">Why Choose Us</p>
          <h2>We Are Experienced & We Have Expert Teams</h2>
          <div class="feature-grid" data-reveal>
            <article class="feature-card">
              <span class="feature-icon"><i class="fa-regular fa-calendar-check"></i></span>
              <h3>Free Quote & Instant Pricing</h3>
              <p>Get instant pricing and get your free quote cleaning all online.</p>
            </article>
            <article class="feature-card">
              <span class="feature-icon"><i class="fa-solid fa-spray-can-sparkles"></i></span>
              <h3>Equipment & Supplies Provided</h3>
              <p>Our cleaners provide all the essential equipment & supplies.</p>
            </article>
            <article class="feature-card">
              <span class="feature-icon"><i class="fa-regular fa-face-smile"></i></span>
              <h3>100% Satisfaction Guarantee</h3>
              <p>If you’re not happy with your cleaning, we’ll be back to fix the missed areas for free.</p>
            </article>
            <article class="feature-card">
              <span class="feature-icon"><i class="fa-solid fa-user-shield"></i></span>
              <h3>Vetted & Background Checked Cleaners</h3>
              <p>Our cleaners go through a rigorous hiring process to make sure your home is in safe hands.</p>
            </article>
          </div>
          <div class="stats">
            <div>
              <span class="stat-number">15+</span>
              <span class="stat-label">years experience</span>
            </div>
            <div>
              <span class="stat-number">10+</span>
              <span class="stat-label">homes cleaned last year</span>
            </div>
            <div>
              <span class="stat-number">500+</span>
              <span class="stat-label">saved hours for our clients</span>
            </div>
            <div>
              <span class="stat-number">95%</span>
              <span class="stat-label">of our clients hire us again</span>
            </div>
          </div>
          <a href="{{ route('about') }}" class="btn btn-outline">Cleaning Process</a>
        </div>
      </section>

      <section class="our-services">
        <div class="container">
          <p class="section-label">Our services</p>
          <h2>Here’s What We Can Do for You</h2>
          <div class="service-grid">
            <article class="service-card" data-reveal>
              <div class="service-media">
                <img
                  src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=800&q=80"
                  alt="House Cleaning"
                  loading="lazy"
                />
                <span class="service-icon"><i class="fa-solid fa-house"></i></span>
              </div>
              <div class="service-body">
                <h3><span>House</span> <span>Cleaning</span></h3>
                <a class="service-cta" href="{{ route('services') }}">
                  Learn more <span class="cta-arrow"><i class="fa-solid fa-arrow-right"></i></span>
                </a>
              </div>
            </article>
            <article class="service-card" data-reveal>
              <div class="service-media">
                <img
                  src="https://images.unsplash.com/photo-1527515637462-daf7f6f4d0f9?auto=format&fit=crop&w=800&q=80"
                  alt="Office Cleaning"
                  loading="lazy"
                />
                <span class="service-icon"><i class="fa-solid fa-building"></i></span>
              </div>
              <div class="service-body">
                <h3><span>Office</span> <span>Cleaning</span></h3>
                <a class="service-cta" href="{{ route('services') }}">
                  Learn more <span class="cta-arrow"><i class="fa-solid fa-arrow-right"></i></span>
                </a>
              </div>
            </article>
            <article class="service-card" data-reveal>
              <div class="service-media">
                <img
                  src="https://images.unsplash.com/photo-1497366672149-e5e4b4b07f1a?auto=format&fit=crop&w=800&q=80"
                  alt="Deep Cleaning"
                  loading="lazy"
                />
                <span class="service-icon"><i class="fa-solid fa-soap"></i></span>
              </div>
              <div class="service-body">
                <h3><span>Deep</span> <span>Cleaning</span></h3>
                <a class="service-cta" href="{{ route('services') }}">
                  Learn more <span class="cta-arrow"><i class="fa-solid fa-arrow-right"></i></span>
                </a>
              </div>
            </article>
            <article class="service-card" data-reveal>
              <div class="service-media">
                <img
                  src="https://images.unsplash.com/photo-1501074589045-037f83f1fd45?auto=format&fit=crop&w=800&q=80"
                  alt="Move In Out Cleaning"
                  loading="lazy"
                />
                <span class="service-icon"><i class="fa-solid fa-truck-moving"></i></span>
              </div>
              <div class="service-body">
                <h3><span>Move In Out</span> <span>Cleaning</span></h3>
                <a class="service-cta" href="{{ route('services') }}">
                  Learn more <span class="cta-arrow"><i class="fa-solid fa-arrow-right"></i></span>
                </a>
              </div>
            </article>
          </div>
        </div>
      </section>

      <section class="testimonials">
        <div class="container">
          <p class="section-label">Testimonials</p>
          <h2>Empowering Thousands of Users and Enterprises</h2>
          <div class="testimonial-shell" data-reveal>
            <div class="testimonial-track">
              <article class="testimonial is-active">
                <p>
                  “Amazing and highly efficient, met all my expectations and more, they were there on time
                  and left my duplex in pristine conditions. Thank Clany Eco.”
                </p>
                <div class="testimonial-meta">
                  <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=100&q=80" alt="Jessica" />
                  <div>
                    <strong>Jessica Clark</strong>
                    <span>Customer</span>
                  </div>
                </div>
              </article>
              <article class="testimonial">
                <p>
                  “Amazing and highly efficient, met all my expectations and more, they were there on time
                  and left my duplex in pristine conditions. Thank Clany Eco.”
                </p>
                <div class="testimonial-meta">
                  <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=100&q=80" alt="Carlos" />
                  <div>
                    <strong>Carlos Moya</strong>
                    <span>Customer</span>
                  </div>
                </div>
              </article>
              <article class="testimonial">
                <p>
                  “Clany Eco provided an exceptional cleaning experience that truly exceeded my expectations.
                  Their team was punctual and professional, and left my duplex spotless.”
                </p>
                <div class="testimonial-meta">
                  <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=100&q=80" alt="Jessica" />
                  <div>
                    <strong>Jessica Clark</strong>
                    <span>Customer</span>
                  </div>
                </div>
              </article>
              <article class="testimonial">
                <p>
                  “I highly recommend Clany Eco for reliable and efficient cleaning services! Amazing and highly
                  efficient, met all my expectations and more.”
                </p>
                <div class="testimonial-meta">
                  <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=100&q=80" alt="Carlos" />
                  <div>
                    <strong>Carlos Moya</strong>
                    <span>Customer</span>
                  </div>
                </div>
              </article>
            </div>
            <div class="testimonial-controls">
              <button type="button" id="testimonial-prev" aria-label="Previous">
                <i class="fa-solid fa-arrow-left"></i>
              </button>
              <button type="button" id="testimonial-next" aria-label="Next">
                <i class="fa-solid fa-arrow-right"></i>
              </button>
            </div>
            <div class="testimonial-badge">
              <span>4.8</span>
              <p>480 Google reviews</p>
            </div>
          </div>
        </div>
      </section>

      <section class="quote">
        <div class="container">
          <p class="section-label">Get your free estimate</p>
          <h2>Get a Quote</h2>
          <div class="quote-grid" data-reveal>
            <div class="quote-form-card">
              <form class="quote-form">
                <label>
                  Your name
                  <input type="text" placeholder="John Smith" />
                </label>
                <label>
                  Email
                  <input type="email" placeholder="e.g. john@youremail.com" />
                </label>
                <label>
                  Phone
                  <input type="tel" placeholder="e.g. (1) 23 4567 891" />
                </label>
                <label>
                  Total square footage
                  <input type="text" placeholder="e.g. 120" />
                </label>
                <label class="full">
                  Choose a service
                  <select>
                    <option>Select</option>
                    <option>House cleaning</option>
                    <option>Office cleaning</option>
                    <option>Deep cleaning</option>
                    <option>Move in out cleaning</option>
                    <option>Post Construction Cleaning</option>
                    <option>Recurring Cleaning</option>
                  </select>
                </label>
                <label class="consent full">
                  <input type="checkbox" />
                  By submitting this form, you agree to the processing of your personal data in accordance with the
                  General Data Protection Regulation and our Privacy Policy.
                </label>
                <button type="submit" class="btn btn-dark full">I’d Like a Quote</button>
              </form>
            </div>
            <div class="quote-aside">
              <div class="quote-image">
                <img
                  src="https://images.unsplash.com/photo-1527515637462-daf7f6f4d0f9?auto=format&fit=crop&w=900&q=80"
                  alt="Professional cleaners"
                  loading="lazy"
                />
              </div>
              <div class="quote-note">
                <div class="note-header">
                  <span class="note-check"><i class="fa-solid fa-check"></i></span>
                  <h3>100% Satisfaction Guarantee</h3>
                </div>
                <p>
                  Your satisfaction is our top priority! We proudly offer a 100% Happiness Guarantee on all our cleanings.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="faqs">
        <div class="container">
          <p class="section-label">FAQS</p>
          <h2>Frequently Asked Questions</h2>
          <div class="faq-card">
            <div class="faq-highlight">
              <h3>Looking for the cleaning service in New York? Contact us now!</h3>
              <div class="faq-phone">
                <span class="phone-dot"><i class="fa-solid fa-phone"></i></span>
                + 1 (180) 567-8990
              </div>
            </div>
            <div class="faq-list">
              <button class="faq-item">
                <span>What's included in a clean?</span>
                <i class="fa-solid fa-plus"></i>
              </button>
              <div class="faq-content">
                The cost of house cleaning can vary depending on factors such as the size of the property, its current
                condition, and the specific services you request. At Clany Eco, we offer a no-obligation over-the-phone
                quote to help you determine the cost of your cleaning service quickly and easily. Contact us today to
                learn more!
              </div>
              <button class="faq-item">
                <span>How much does it cost to clean my home?</span>
                <i class="fa-solid fa-plus"></i>
              </button>
              <div class="faq-content">
                Our Cleaning Service provides a comprehensive and thorough process that goes beyond regular upkeep. Our
                experienced team will hand-wipe all surfaces, scrub away build-up, dust hard-to-reach areas, wash
                baseboards, and vacuum furniture and upholstery.
              </div>
              <button class="faq-item">
                <span>Are the cleaning supplies included?</span>
                <i class="fa-solid fa-plus"></i>
              </button>
              <div class="faq-content">
                We provide all supplies unless you would prefer for us to use your own. Please leave a note upon checkout
                for any special requests.
              </div>
              <button class="faq-item">
                <span>What time do you offer cleaning services?</span>
                <i class="fa-solid fa-plus"></i>
              </button>
              <div class="faq-content">
                You can book a cleaning with us 7 days a week. Typically cleanings take place between 8AM to 6PM, Monday
                to Sunday. If you need an earlier or later schedule, please contact support so we can accommodate.
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="blog">
        <div class="container">
          <p class="section-label">From our blog</p>
          <h2>Cleaning Tips From Pros</h2>
          <div class="blog-grid" id="home-blog-grid"></div>
          <p id="home-blog-empty" class="blog-empty" hidden>No blog posts yet.</p>
          <div class="blog-actions">
            <a href="{{ route('blog.index') }}" class="btn btn-outline">More Tips</a>
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
            
              <input type="email" placeholder="Enter our email address">
              <button type="submit" class="btn btn-green">Subscrible</button>
            
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
          <p>© 2026 Cleansure. All Rights Reserved</p>
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
