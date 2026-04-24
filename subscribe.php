<?php
require_once __DIR__ . '/config.php';

$status  = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name      = htmlspecialchars(trim($_POST['name']  ?? ''));
    $email     = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $interests = array_map('htmlspecialchars', $_POST['interests'] ?? []);

    if (!$name || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $status  = 'error';
        $message = 'Please enter a valid name and email address.';
    } else {
        $interestHtml = !empty($interests)
            ? '<ul style="margin:8px 0;padding-left:18px;font-size:14px;color:#374151;">'
              . implode('', array_map(fn($i) => "<li>{$i}</li>", $interests))
              . '</ul>'
            : '<p style="font-size:14px;color:#6B7280;">No specific interests selected.</p>';

        try {
            // Notify admin
            $mail = createMailer();
            $mail->addAddress(ADMIN_EMAIL, SITE_NAME . ' Team');
            $mail->isHTML(true);
            $mail->Subject = '[New Subscriber] ' . $name;
            $mail->Body    = "
                <div style='font-family:Inter,Arial,sans-serif;max-width:560px;margin:auto;padding:24px;'>
                  <h2 style='color:#4F46E5;margin:0 0 16px;'>New Subscriber</h2>
                  <table cellpadding='0' cellspacing='0' style='font-size:14px;color:#374151;'>
                    <tr><td style='padding:4px 0;font-weight:600;width:90px;'>Name:</td><td>{$name}</td></tr>
                    <tr><td style='padding:4px 0;font-weight:600;'>Email:</td><td>{$email}</td></tr>
                  </table>
                  <p style='font-size:14px;color:#374151;margin:12px 0 4px;'><strong>Interests:</strong></p>
                  {$interestHtml}
                  <hr style='border:none;border-top:1px solid #E5E7EB;margin:16px 0;'>
                  <p style='font-size:12px;color:#9CA3AF;'>Subscribed via " . SITE_NAME . " Subscribe Form</p>
                </div>";
            $mail->AltBody = "New subscriber: {$name} ({$email})";
            $mail->send();

            // Welcome email
            $welcome = createMailer();
            $welcome->addAddress($email, $name);
            $welcome->isHTML(true);
            $welcome->Subject = 'Welcome to ' . SITE_NAME . ' — You\'re subscribed!';
            $welcome->Body    = "
                <div style='font-family:Inter,Arial,sans-serif;max-width:560px;margin:auto;padding:24px;'>
                  <h2 style='color:#4F46E5;margin:0 0 12px;'>Welcome, {$name}!</h2>
                  <p style='font-size:14px;color:#374151;'>You've successfully subscribed to <strong>" . SITE_NAME . "</strong> updates. We'll keep you in the loop.</p>
                  <p style='font-size:14px;color:#374151;margin-top:12px;'><strong>Your selected topics:</strong></p>
                  {$interestHtml}
                  <hr style='border:none;border-top:1px solid #E5E7EB;margin:16px 0;'>
                  <p style='font-size:13px;color:#6B7280;'>To unsubscribe, reply to this email with <em>UNSUBSCRIBE</em>.</p>
                  <p style='font-size:14px;color:#374151;'>Cheers,<br><strong>" . SITE_NAME . " Team</strong></p>
                </div>";
            $welcome->AltBody = "Welcome to " . SITE_NAME . ", {$name}!\n\nYou are now subscribed to our updates.";
            $welcome->send();

            $status  = 'success';
            $message = "You're subscribed! Check your inbox for a welcome email.";
        } catch (\Exception $e) {
            $status  = 'error';
            $message = 'Something went wrong. Please try again later.';
        }
    }
}

// Subscription interest options — edit freely
$interest_options = [
    'news'      => ['label' => 'Latest News',      'desc' => 'Stay up to date with our announcements'],
    'products'  => ['label' => 'New Products',     'desc' => 'Be the first to know about new releases'],
    'tutorials' => ['label' => 'Tips & Tutorials', 'desc' => 'Guides, how-tos, and best practices'],
    'offers'    => ['label' => 'Exclusive Offers', 'desc' => 'Special deals and promotions'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Subscribe — <?= SITE_NAME ?></title>
  <meta name="description" content="Subscribe to <?= SITE_NAME ?> newsletter and stay updated with the latest news and offers.">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<div class="page-wrap">
  <a href="index.php" class="back-link">
    <i class="bi bi-arrow-left"></i> Back to home
  </a>

  <div class="card">

    <!-- Header -->
    <div class="card-header">
      <h1><i class="bi bi-bell"></i> Stay Updated</h1>
      <p>Subscribe to our newsletter and never miss an update.</p>
    </div>

    <!-- Nav tabs -->
    <nav class="page-nav" aria-label="Page navigation">
      <a href="contact.php" id="nav-contact">
        <i class="bi bi-envelope"></i> Contact Us
      </a>
      <a href="subscribe.php" class="active" id="nav-subscribe">
        <i class="bi bi-bell"></i> Subscribe
      </a>
    </nav>

    <!-- Alert -->
    <?php if ($status === 'success'): ?>
    <div class="alert alert-success" role="alert">
      <i class="bi bi-check-circle-fill"></i>
      <span><?= $message ?></span>
    </div>
    <?php elseif ($status === 'error'): ?>
    <div class="alert alert-error" role="alert">
      <i class="bi bi-exclamation-circle-fill"></i>
      <span><?= $message ?></span>
    </div>
    <?php endif; ?>

    <!-- Form -->
    <?php if ($status !== 'success'): ?>
    <form action="subscribe.php" method="POST" id="subscribe-form" novalidate>

      <div class="form-row">
        <div class="form-group">
          <label for="name">Full Name</label>
          <input type="text" id="name" name="name"
                 placeholder="John Doe"
                 value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
        </div>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email"
                 placeholder="john@example.com"
                 value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
        </div>
      </div>

      <div class="form-group">
        <label>I'm interested in (optional)</label>
        <div class="checkbox-group">
          <?php foreach ($interest_options as $key => $opt): ?>
          <label class="checkbox-item">
            <input type="checkbox" name="interests[]" value="<?= $key ?>"
              <?= in_array($key, $_POST['interests'] ?? []) ? 'checked' : '' ?>>
            <div>
              <div class="check-label"><?= $opt['label'] ?></div>
              <div class="check-desc"><?= $opt['desc'] ?></div>
            </div>
          </label>
          <?php endforeach; ?>
        </div>
      </div>

      <button type="submit" class="btn-submit" id="submit-btn">
        <i class="bi bi-bell"></i> Subscribe Now
      </button>

    </form>
    <?php else: ?>
    <div style="text-align:center;padding:16px 0;">
      <a href="subscribe.php" style="display:inline-flex;align-items:center;gap:5px;color:var(--accent);font-size:0.85rem;font-weight:500;text-decoration:none;">
        <i class="bi bi-arrow-left"></i> Subscribe with a different email
      </a>
    </div>
    <?php endif; ?>

    <!-- Footer -->
    <div class="card-footer">
      No spam, ever. Unsubscribe anytime. &middot;
      <a href="contact.php">Contact Us</a>
    </div>

  </div>
</div>

<script>
  document.getElementById('subscribe-form')?.addEventListener('submit', function() {
    const btn = document.getElementById('submit-btn');
    btn.disabled = true;
    btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Subscribing…';
  });
</script>

</body>
</html>
