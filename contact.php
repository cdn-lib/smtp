<?php
require_once __DIR__ . '/config.php';

$status  = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = htmlspecialchars(trim($_POST['name']    ?? ''));
    $email   = filter_var(trim($_POST['email']   ?? ''), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject'] ?? ''));
    $body    = htmlspecialchars(trim($_POST['body']    ?? ''));

    if (!$name || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$subject || !$body) {
        $status  = 'error';
        $message = 'Please fill in all fields with valid information.';
    } else {
        try {
            // Send message to admin
            $mail = createMailer();
            $mail->addAddress(ADMIN_EMAIL, SITE_NAME . ' Team');
            $mail->isHTML(true);
            $mail->Subject = '[Contact] ' . $subject;
            $mail->Body    = "
                <div style='font-family:Inter,Arial,sans-serif;max-width:560px;margin:auto;padding:24px;'>
                  <h2 style='color:#4F46E5;margin:0 0 16px;'>New Contact Message</h2>
                  <table cellpadding='0' cellspacing='0' style='font-size:14px;color:#374151;'>
                    <tr><td style='padding:4px 0;font-weight:600;width:90px;'>Name:</td><td>{$name}</td></tr>
                    <tr><td style='padding:4px 0;font-weight:600;'>Email:</td><td>{$email}</td></tr>
                    <tr><td style='padding:4px 0;font-weight:600;'>Subject:</td><td>{$subject}</td></tr>
                  </table>
                  <hr style='border:none;border-top:1px solid #E5E7EB;margin:16px 0;'>
                  <p style='font-size:14px;color:#374151;white-space:pre-line;'>{$body}</p>
                  <hr style='border:none;border-top:1px solid #E5E7EB;margin:16px 0;'>
                  <p style='font-size:12px;color:#9CA3AF;'>Sent via " . SITE_NAME . " Contact Form</p>
                </div>";
            $mail->AltBody = "Name: {$name}\nEmail: {$email}\nSubject: {$subject}\n\n{$body}";
            $mail->send();

            // Auto-reply to sender
            $reply = createMailer();
            $reply->addAddress($email, $name);
            $reply->isHTML(true);
            $reply->Subject = 'We received your message — ' . SITE_NAME;
            $reply->Body    = "
                <div style='font-family:Inter,Arial,sans-serif;max-width:560px;margin:auto;padding:24px;'>
                  <h2 style='color:#4F46E5;margin:0 0 12px;'>Thanks for reaching out, {$name}!</h2>
                  <p style='font-size:14px;color:#374151;'>We've received your message and will get back to you within <strong>24–48 hours</strong>.</p>
                  <blockquote style='border-left:3px solid #E5E7EB;margin:16px 0;padding:8px 16px;color:#6B7280;font-size:14px;'>{$body}</blockquote>
                  <p style='font-size:14px;color:#374151;'>Best regards,<br><strong>" . SITE_NAME . " Team</strong></p>
                </div>";
            $reply->AltBody = "Hi {$name},\n\nWe received your message and will reply within 24–48 hours.\n\n— " . SITE_NAME . " Team";
            $reply->send();

            $status  = 'success';
            $message = "Your message has been sent! We'll get back to you within 24–48 hours.";
        } catch (\Exception $e) {
            $status  = 'error';
            $message = 'Failed to send your message. Please try again later.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us — <?= SITE_NAME ?></title>
  <meta name="description" content="Get in touch with <?= SITE_NAME ?>. We usually respond within 24–48 hours.">
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
      <h1><i class="bi bi-envelope-open"></i> Contact Us</h1>
      <p>Have a question or need help? Drop us a message and we'll get back to you.</p>
    </div>

    <!-- Nav tabs -->
    <nav class="page-nav" aria-label="Page navigation">
      <a href="contact.php" class="active" id="nav-contact">
        <i class="bi bi-envelope"></i> Contact Us
      </a>
      <a href="subscribe.php" id="nav-subscribe">
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
    <form action="contact.php" method="POST" id="contact-form" novalidate>

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
        <label for="subject">Subject</label>
        <input type="text" id="subject" name="subject"
               placeholder="How can we help you?"
               value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>" required>
      </div>

      <div class="form-group">
        <label for="body">Message</label>
        <textarea id="body" name="body"
                  placeholder="Describe your question or issue in detail..."
                  required><?= htmlspecialchars($_POST['body'] ?? '') ?></textarea>
      </div>

      <button type="submit" class="btn-submit" id="submit-btn">
        <i class="bi bi-send"></i> Send Message
      </button>

    </form>

    <!-- Footer -->
    <div class="card-footer">
      Prefer email? Write directly to
      <a href="mailto:<?= ADMIN_EMAIL ?>"><?= ADMIN_EMAIL ?></a>
    </div>

  </div>
</div>

<script>
  document.getElementById('contact-form').addEventListener('submit', function() {
    const btn = document.getElementById('submit-btn');
    btn.disabled = true;
    btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Sending…';
  });
</script>

</body>
</html>
