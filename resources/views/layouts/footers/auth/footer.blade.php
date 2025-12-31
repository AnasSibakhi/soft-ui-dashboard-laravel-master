<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

<footer class="footer">
  <div class="container">
    <div class="footer-content">
      <p class="footer-desc">Unlock your potential with expert online courses.</p>

      <nav class="footer-nav" aria-label="Footer navigation">
        <div class="nav-group" role="navigation" aria-labelledby="explore-label">
          <h4 id="explore-label">Explore</h4>
          <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/courses">Courses</a></li>
            <li><a href="/tracks">Tracks</a></li>
          </ul>
        </div>
        <div class="nav-group" role="navigation" aria-labelledby="support-label">
          <h4 id="support-label">Support</h4>
          <ul>
            <li><a href="/contact">Contact</a></li>
            <li><a href="/privacy">Privacy Policy</a></li>
          </ul>
        </div>
      </nav>

      <div class="footer-social" aria-label="Social media links">
        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
      </div>
    </div>

    <div class="footer-bottom">
      <p>© {{ date('Y') }} Edvanta. All rights reserved.</p>
    </div>
  </div>
</footer>

<style>
  .footer {
    background: linear-gradient(135deg, #0a0c14, #1c2433);
    color: #aab8c2;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    padding: 1rem 2rem;
    border-top-left-radius: 1.5rem;
    border-top-right-radius: 1.5rem;
    box-shadow: 0 -6px 20px rgba(0, 0, 0, 0.7);
    user-select: none;
    font-size: 0.85rem;
  }

  .container {
    max-width: 1140px;
    margin: 0 auto;
  }

  .footer-content {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #22303f;
    align-items: center;
  }

  .footer-desc {
    flex: 1 1 240px;
    max-width: 280px;
    font-weight: 300;
    font-size: 0.9rem;
    line-height: 1.5;
    color: #8899aa;
    font-style: italic;
    margin: 0;
    letter-spacing: 0.02em;
  }

  .footer-nav {
    display: flex;
    gap: 3rem;
    flex-wrap: wrap;
  }

  .nav-group h4 {
    margin-bottom: 0.5rem;
    color: #7b8ea0;
    font-weight: 700;
    font-size: 1rem;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    font-family: 'Segoe UI Semibold', Tahoma, Geneva, Verdana, sans-serif;
  }

  .nav-group ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .nav-group ul li {
    margin-bottom: 0.4rem;
  }

  .nav-group ul li a {
    color: #8ea4bf;
    text-decoration: none;
    font-weight: 400;
    font-size: 0.87rem;
    padding: 0.15rem 0.3rem;
    border-radius: 4px;
    display: inline-block;
    transition:
      color 0.3s ease,
      background-color 0.3s ease,
      box-shadow 0.3s ease,
      transform 0.25s ease;
  }

  .nav-group ul li a:hover {
    color: #5ea7ff;
    background-color: rgba(94, 167, 255, 0.15);
    box-shadow: 0 0 8px rgba(94, 167, 255, 0.6);
    transform: translateY(-2px);
  }

  .footer-social {
    display: flex;
    gap: 1.5rem;
    flex: 0 0 auto;
  }

  .footer-social a {
    font-size: 1.4rem;
    color: #8ea4bf;
    transition: color 0.3s ease, transform 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #1d2a44;
    box-shadow:
      inset 0 0 6px rgba(255, 255, 255, 0.06),
      0 3px 7px rgba(0, 0, 0, 0.4);
  }

  .footer-social a:hover {
    color: #5ea7ff;
    background: #1a5edc;
    transform: scale(1.2) translateY(-3px);
    box-shadow:
      inset 0 0 10px #5ea7ff,
      0 6px 14px rgba(94, 167, 255, 0.8);
  }

  .footer-bottom {
    text-align: center;
    margin-top: 0.7rem;
    color: #637d9b;
    font-size: 0.7rem;
    font-weight: 300;
    letter-spacing: 0.03em;
  }

  @media (max-width: 768px) {
    .footer-content {
      flex-direction: column;
      align-items: center;
      text-align: center;
      gap: 1.75rem;
    }

    .footer-desc {
      max-width: 100%;
      font-style: normal;
      font-weight: 400;
      font-size: 0.9rem;
      letter-spacing: normal;
    }
  }
</style>
