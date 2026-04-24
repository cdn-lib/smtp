<?php require_once __DIR__ . '/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= SITE_NAME ?> Mailer Kit — PHP SMTP Email Library</title>
  <meta name="description" content="A lightweight, ready-to-integrate PHP SMTP email kit. Includes Contact Us and Subscribe pages powered by PHPMailer.">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<!-- ── Top Nav ── -->
<nav class="top-nav">
  <div class="nav-inner">
    <a href="index.php" class="nav-brand">
      <i class="bi bi-envelope-fill"></i>
      <?= SITE_NAME ?> Mailer
    </a>
    <div class="nav-links">
      <a href="#features">Features</a>
      <a href="#pages">Pages</a>
      <a href="#setup">Setup</a>
      <a href="contact.php" class="btn-nav">
        <i class="bi bi-send"></i> Try Demo
      </a>
    </div>
  </div>
</nav>

<!-- ── Hero ── -->
<header class="hero">
  <div class="hero-badge">
    <i class="bi bi-box-seam"></i> Open Source · PHPMailer Based
  </div>
  <h1>PHP SMTP Email Kit — Ready to Integrate</h1>
  <p>
    A lightweight, professional email integration kit built on PHPMailer.
    Drop it into any PHP project, configure one file, and you're done.
  </p>
  <div class="hero-actions">
    <a href="contact.php" class="btn-primary">
      <i class="bi bi-envelope"></i> Contact Us Page
    </a>
    <a href="subscribe.php" class="btn-secondary">
      <i class="bi bi-bell"></i> Subscribe Page
    </a>
    <a href="https://github.com" target="_blank" rel="noopener" class="btn-secondary">
      <i class="bi bi-github"></i> View on GitHub
    </a>
  </div>
</header>

<!-- ── Features ── -->
<section class="section" id="features">
  <div class="section-label">Features</div>
  <h2>Everything you need, nothing you don't</h2>
  <p>Minimal footprint, clean code — easy to read, easy to modify.</p>

  <div class="feature-grid">
    <div class="feature-card">
      <div class="feature-icon"><i class="bi bi-gear-fill"></i></div>
      <h3>Single Config File</h3>
      <p>All SMTP settings live in <code>config.php</code>. Change one file to fully integrate with any mail server.</p>
    </div>
    <div class="feature-card">
      <div class="feature-icon"><i class="bi bi-shield-check"></i></div>
      <h3>Input Sanitization</h3>
      <p>All user inputs are sanitized and validated before sending. XSS-safe HTML output via <code>htmlspecialchars()</code>.</p>
    </div>
    <div class="feature-card">
      <div class="feature-icon"><i class="bi bi-reply-fill"></i></div>
      <h3>Auto-Reply Emails</h3>
      <p>Contact form sends an automatic reply to the visitor. Subscribe form sends a welcome email instantly.</p>
    </div>
    <div class="feature-card">
      <div class="feature-icon"><i class="bi bi-phone"></i></div>
      <h3>Fully Responsive</h3>
      <p>Works on all screen sizes — desktop, tablet, and mobile. No heavy frameworks, just clean CSS.</p>
    </div>
    <div class="feature-card">
      <div class="feature-icon"><i class="bi bi-palette"></i></div>
      <h3>Easy Theming</h3>
      <p>All colors are defined as CSS variables in <code>style.css</code>. Change your brand color in one place.</p>
    </div>
    <div class="feature-card">
      <div class="feature-icon"><i class="bi bi-lightning-charge-fill"></i></div>
      <h3>Lightweight</h3>
      <p>No heavy JS frameworks. Minimal CSS. Loads fast on all connections including mobile data.</p>
    </div>
  </div>
</section>

<!-- ── Pages overview ── -->
<section class="section" id="pages">
  <div class="section-label">Included Pages</div>
  <h2>Two ready-to-use email pages</h2>
  <p>Both pages share the same config and stylesheet — fully consistent UX.</p>

  <div class="pages-grid">
    <a href="contact.php" class="page-card">
      <div class="page-card-top">
        <div class="page-card-icon"><i class="bi bi-envelope-open"></i></div>
        <h3>contact.php</h3>
      </div>
      <p>Professional Contact Us form. Messages are delivered to your admin email. Visitor receives an automatic reply with a 24–48 hour response window.</p>
      <span class="card-link"><i class="bi bi-arrow-right"></i> Open page</span>
    </a>
    <a href="subscribe.php" class="page-card">
      <div class="page-card-top">
        <div class="page-card-icon"><i class="bi bi-bell"></i></div>
        <h3>subscribe.php</h3>
      </div>
      <p>Newsletter subscribe form with customizable interest checkboxes. Admin gets notified and subscriber receives a branded welcome email.</p>
      <span class="card-link"><i class="bi bi-arrow-right"></i> Open page</span>
    </a>
  </div>
</section>

<!-- ── Setup guide ── -->
<section class="section" id="setup">
  <div class="section-label">Quick Setup</div>
  <h2>Up and running in 3 steps</h2>
  <p>No database required. Just PHP and Composer.</p>

  <!-- Step 1 -->
  <h3 style="font-size:1rem;font-weight:600;color:var(--text-primary);margin:0 0 10px;display:flex;align-items:center;gap:8px;">
    <span style="display:inline-flex;align-items:center;justify-content:center;width:24px;height:24px;background:var(--accent);color:#fff;border-radius:50%;font-size:0.78rem;font-weight:700;flex-shrink:0;">1</span>
    Install dependencies
  </h3>
  <div class="code-block" style="margin-bottom:24px;">
    <div class="code-block-header"><span>Terminal</span></div>
    <pre>composer require phpmailer/phpmailer</pre>
  </div>

  <!-- Step 2 -->
  <h3 style="font-size:1rem;font-weight:600;color:var(--text-primary);margin:0 0 10px;display:flex;align-items:center;gap:8px;">
    <span style="display:inline-flex;align-items:center;justify-content:center;width:24px;height:24px;background:var(--accent);color:#fff;border-radius:50%;font-size:0.78rem;font-weight:700;flex-shrink:0;">2</span>
    Edit <code style="font-family:monospace;font-size:0.9rem;">config.php</code>
  </h3>
  <div class="code-block" style="margin-bottom:24px;">
    <div class="code-block-header"><span>config.php</span></div>
    <pre><span class="c">// Your SMTP credentials</span>
<span class="f">define</span>(<span class="s">'SMTP_USERNAME'</span>, <span class="s">'your-email@gmail.com'</span>);
<span class="f">define</span>(<span class="s">'SMTP_PASSWORD'</span>, <span class="s">'your-app-password'</span>);
<span class="f">define</span>(<span class="s">'ADMIN_EMAIL'</span>,   <span class="s">'admin@yourcompany.com'</span>);
<span class="f">define</span>(<span class="s">'SITE_NAME'</span>,     <span class="s">'Your Company'</span>);</pre>
  </div>

  <!-- Step 3 -->
  <h3 style="font-size:1rem;font-weight:600;color:var(--text-primary);margin:0 0 10px;display:flex;align-items:center;gap:8px;">
    <span style="display:inline-flex;align-items:center;justify-content:center;width:24px;height:24px;background:var(--accent);color:#fff;border-radius:50%;font-size:0.78rem;font-weight:700;flex-shrink:0;">3</span>
    Deploy and open the pages
  </h3>
  <p style="font-size:0.9rem;color:var(--text-secondary);margin-bottom:24px;">
    Upload all files to your web server. Visit <code style="font-family:monospace;font-size:0.85rem;background:var(--accent-light);color:var(--accent-text);padding:2px 6px;border-radius:4px;">/contact.php</code> and <code style="font-family:monospace;font-size:0.85rem;background:var(--accent-light);color:var(--accent-text);padding:2px 6px;border-radius:4px;">/subscribe.php</code> to test.
  </p>

  <!-- Config table -->
  <h3 style="font-size:1rem;font-weight:600;color:var(--text-primary);margin:0 0 14px;">Configuration Reference</h3>
  <div style="overflow-x:auto;">
    <table class="config-table">
      <thead>
        <tr>
          <th>Constant</th>
          <th>Default</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><code>SMTP_HOST</code></td>
          <td><code>smtp.gmail.com</code></td>
          <td>Your SMTP server hostname</td>
        </tr>
        <tr>
          <td><code>SMTP_PORT</code></td>
          <td><code>465</code></td>
          <td>465 (SSL) or 587 (TLS)</td>
        </tr>
        <tr>
          <td><code>SMTP_USERNAME</code></td>
          <td>—</td>
          <td>Your SMTP login email</td>
        </tr>
        <tr>
          <td><code>SMTP_PASSWORD</code></td>
          <td>—</td>
          <td>App password (not your login password)</td>
        </tr>
        <tr>
          <td><code>SMTP_FROM_NAME</code></td>
          <td>—</td>
          <td>Sender display name in email clients</td>
        </tr>
        <tr>
          <td><code>SMTP_ENCRYPTION</code></td>
          <td><code>ssl</code></td>
          <td><code>ssl</code> or <code>tls</code></td>
        </tr>
        <tr>
          <td><code>ADMIN_EMAIL</code></td>
          <td>—</td>
          <td>Inbox that receives contact messages</td>
        </tr>
        <tr>
          <td><code>SITE_NAME</code></td>
          <td>—</td>
          <td>Displayed in email subjects and footers</td>
        </tr>
        <tr>
          <td><code>SITE_URL</code></td>
          <td>—</td>
          <td>Your website URL (used in email templates)</td>
        </tr>
      </tbody>
    </table>
  </div>
</section>

<!-- ── Footer ── -->
<footer class="site-footer">
  Built with <i class="bi bi-heart-fill" style="color:#EF4444;font-size:0.8rem;"></i> using
  <a href="https://github.com/PHPMailer/PHPMailer" target="_blank" rel="noopener">PHPMailer</a>
  &middot;
  <a href="https://github.com" target="_blank" rel="noopener"><i class="bi bi-github"></i> GitHub</a>
  &middot;
  <a href="contact.php">Contact</a>
  &middot;
  <a href="subscribe.php">Subscribe</a>
</footer>

</body>
</html>
