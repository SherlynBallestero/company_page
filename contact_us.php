<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$alert = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recaptchaSecret = '6LfIrwksAAAAAO36BTAA-UFlDXP8DjdhIHcRkXnG';
    $recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';
    if (empty($recaptchaResponse)) {
        $alert = '<div class="rs-alert rs-alert--danger" role="alert">CAPTCHA required. Please check the box.</div>';
    } else {
        $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptchaData = [
            'secret' => $recaptchaSecret,
            'response' => $recaptchaResponse,
            'remoteip' => $_SERVER['REMOTE_ADDR'] ?? ''
        ];
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($recaptchaData)
            ]
        ];
        $context = stream_context_create($options);
        $recaptchaResult = file_get_contents($recaptchaUrl, false, $context);
        $recaptchaResultJson = json_decode($recaptchaResult);

        if (!$recaptchaResultJson || !$recaptchaResultJson->success) {
            $alert = '<div class="rs-alert rs-alert--danger" role="alert">CAPTCHA verification failed. Please try again.</div>';
        } else {
            $to = "hello@rensher.com";
            $name = strip_tags($_POST["name"] ?? '');
            $email = strip_tags($_POST["email"] ?? '');
            $business = strip_tags($_POST["business"] ?? '');
            $phone = strip_tags($_POST["phone"] ?? '');
            $plan = strip_tags($_POST["plan"] ?? '');
            $project_type = strip_tags($_POST["project_type"] ?? '');
            $intent = strip_tags($_POST["intent"] ?? '');
            $comments = strip_tags($_POST["comments"] ?? '');

            $intentLabel = 'inquiry';
            if ($intent === 'offer') { $intentLabel = 'offer'; }
            elseif ($intent === 'request') { $intentLabel = 'request'; }

            $subject = "Appointment Inquiry";
            if ($plan !== '') {
                $subject = "Quote request — " . $plan;
            }

            $body = "Name: $name\nEmail: $email\nBusiness: $business\nPhone: $phone\nPlan: $plan\nProject type: $project_type\nIntent: $intentLabel\nComments: $comments";
            $headers = "From: hello@rensher.com\r\n";
            $headers .= "Reply-To: $email\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

            $companySent = mail($to, $subject, $body, $headers);

            $userSubject = "Thank you for your inquiry - RenSher Enterprises";
            $userBody = "Dear $name,\n\nThank you for contacting RenSher Enterprises LLC. We appreciate your interest in our services.\n\nSomeone from our team will reach out to you shortly.\nIf you have any immediate questions, feel free to reply to this email.\n\nBest regards,\nThe RenSher Team\n--------\nRenSher Enterprises LLC\nCustom Web Development & More\nFlorida, USA\n+1-561-360-0081\nhello@rensher.com";
            $userHeaders = "From: hello@rensher.com\r\n";
            $userHeaders .= "Content-Type: text/plain; charset=UTF-8\r\n";

            $userSent = mail($email, $userSubject, $userBody, $userHeaders);

            if ($companySent && $userSent) {
                $alert = '<div class="rs-alert rs-alert--success" role="status">Message sent successfully! You will receive a confirmation email shortly.</div>';
            } elseif ($companySent) {
                $alert = '<div class="rs-alert rs-alert--warning" role="status">Message sent to us, but confirmation email failed. We will contact you soon.</div>';
            } else {
                $alert = '<div class="rs-alert rs-alert--danger" role="alert">Error sending message. Please try again or email RenSherEnterprisesLLC@gmail.com.</div>';
            }
        }
    }
}
$prefill_plan = isset($_GET['plan']) ? htmlspecialchars($_GET['plan'], ENT_QUOTES, 'UTF-8') : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-256P0XXK8Q"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-256P0XXK8Q');
  </script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact — RenSher Enterprises</title>
  <meta name="description" content="Contact RenSher Enterprises LLC for a custom website quote in Florida or across the USA.">
  <link rel="canonical" href="https://www.rensher.com/contact_us.php">
  <link rel="icon" href="/favicon_io/android-chrome-192x192.png" sizes="192x192" type="image/png">
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" href="/favicon_io/apple-touch-icon.png" sizes="180x180">
  <meta name="theme-color" content="#0B1F2A">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;600;700&family=IBM+Plex+Mono:wght@500;600&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/rs-tokens.css">
  <link rel="stylesheet" href="assets/css/rs-base.css">
  <link rel="stylesheet" href="assets/css/rs-components.css">
  <link rel="stylesheet" href="assets/css/rs-pages.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
  <a class="rs-skip" href="#main">Skip to content</a>
  <header class="rs-header">
    <div class="rs-wrap rs-header__inner">
      <a class="rs-wordmark" href="index.html">
        <strong>RenSher</strong>
        <span>Enterprises LLC</span>
      </a>
      <button class="rs-nav-toggle" type="button" aria-expanded="false" aria-controls="rs-nav" data-rs-nav-toggle>Menu</button>
      <nav class="rs-nav" id="rs-nav" aria-label="Primary">
        <ul class="rs-nav__links">
        <li><a href="index.html">Home</a></li>
        <li><a href="offers.html">Offers</a></li>
        <li><a href="portfolio.html">Projects</a></li>
        <li><a href="contact_us.php" aria-current="page">Contact</a></li>
        </ul>
        <a class="rs-btn" href="mailto:RenSherEnterprisesLLC@gmail.com?subject=Free%20quote%20-%20RenSher&body=Hi%20RenSher%2C%0A%0ABusiness%3A%0ALocation%3A%0APlan%20interest%20(Basic%2FStandard%2FPremium%2FCustom)%3A%0AProject%20type%20(Website%20%2F%20E-commerce%20%2F%20Portfolio)%3A%0A%0AThanks%21">Get a free quote</a>
      </nav>
    </div>
  </header>
  <main id="main">
    <section class="rs-hero">
      <div class="rs-wrap">
        <h1>Contact</h1>
        <p>Prefer email? Use <a href="mailto:RenSherEnterprisesLLC@gmail.com?subject=Free%20quote%20-%20RenSher&body=Hi%20RenSher%2C%0A%0ABusiness%3A%0ALocation%3A%0APlan%20interest%20(Basic%2FStandard%2FPremium%2FCustom)%3A%0AProject%20type%20(Website%20%2F%20E-commerce%20%2F%20Portfolio)%3A%0A%0AThanks%21">Get a free quote</a>. Or call <a href="tel:+15613600081">+1 (561) 360-0081</a>. You can also send the form below.</p>
      </div>
    </section>
    <section class="rs-section">
      <div class="rs-wrap" style="max-width:560px;">
        <?php echo $alert; ?>
        <div class="rs-card">
          <form id="contactForm" class="rs-form" method="POST" action="">
            <fieldset style="border:1px solid var(--rs-mist);border-radius:10px;padding:16px;margin-bottom:16px;">
              <legend style="font-weight:600;padding:0 6px;">Intent</legend>
              <label style="font-weight:500;"><input type="radio" name="intent" value="request" required> Ask for a service</label><br>
              <label style="font-weight:500;"><input type="radio" name="intent" value="offer"> Offer a service</label>
            </fieldset>

            <label for="name">Name</label>
            <input type="text" id="name" name="name" required autocomplete="name">

            <label for="business">Business</label>
            <input type="text" id="business" name="business" autocomplete="organization">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required autocomplete="email">

            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone" autocomplete="tel">

            <label for="plan">Plan interest</label>
            <select id="plan" name="plan">
              <option value="">Select…</option>
              <option value="Basic Plan">Basic</option>
              <option value="Standard Plan">Standard</option>
              <option value="Premium Plan">Premium</option>
              <option value="Custom">Custom</option>
            </select>

            <label for="project_type">Project type</label>
            <select id="project_type" name="project_type">
              <option value="">Select…</option>
              <option>Website</option>
              <option>E-commerce</option>
              <option>Portfolio</option>
              <option>Other</option>
            </select>

            <label for="comments">Notes</label>
            <textarea id="comments" name="comments" rows="4" placeholder="What should the site do?"></textarea>

            <div class="g-recaptcha" data-sitekey="6LfIrwksAAAAAL2V5ZJ4FwPTaYbCFJ9Xa26rrkFN" data-callback="onRecaptchaSuccess" data-expired-callback="onRecaptchaExpired"></div>

            <div class="rs-actions">
              <button type="submit" id="submitBtn" class="rs-btn" disabled>Send message</button>
              <a class="rs-btn rs-btn--secondary" href="mailto:RenSherEnterprisesLLC@gmail.com?subject=Free%20quote%20-%20RenSher&body=Hi%20RenSher%2C%0A%0ABusiness%3A%0ALocation%3A%0APlan%20interest%20(Basic%2FStandard%2FPremium%2FCustom)%3A%0AProject%20type%20(Website%20%2F%20E-commerce%20%2F%20Portfolio)%3A%0A%0AThanks%21">Or email a free quote</a>
            </div>
          </form>
        </div>
      </div>
    </section>

  </main>
  <footer class="rs-footer">
    <div class="rs-wrap">
      <div class="rs-footer__grid">
        <div class="rs-footer__meta">
          <p style="margin:0 0 8px;color:var(--rs-fog);font-family:var(--font-display);font-size:1.15rem;"><strong>RenSher Enterprises LLC</strong></p>
          <p style="margin:0;">Florida, USA<br>
          <a href="mailto:RenSherEnterprisesLLC@gmail.com">RenSherEnterprisesLLC@gmail.com</a><br>
          <a href="tel:+15613600081">+1 (561) 360-0081</a></p>
        </div>
        <ul class="rs-footer__nav">
          <li><a href="privacy.html">Privacy</a></li>
          <li><a href="terms.html">Terms</a></li>
          <li><a href="FAQ.html">FAQ</a></li>
          <li><a href="contact_us.php">Contact</a></li>
        </ul>
      </div>
      <p class="rs-footer__copy">&copy; RenSher Enterprises LLC. All rights reserved.</p>
    </div>
  </footer>
  <script>
    (function(){
      var btn = document.querySelector('[data-rs-nav-toggle]');
      var nav = document.getElementById('rs-nav');
      if (!btn || !nav) return;
      btn.addEventListener('click', function(){
        var open = nav.classList.toggle('is-open');
        btn.setAttribute('aria-expanded', open ? 'true' : 'false');
      });
    })();
  </script>
  <script>
    function onRecaptchaSuccess(){ document.getElementById('submitBtn').disabled = false; }
    function onRecaptchaExpired(){ document.getElementById('submitBtn').disabled = true; }
    (function(){
      var plan = <?php echo json_encode($prefill_plan); ?>;
      var sel = document.getElementById('plan');
      if (plan && sel) {
        for (var i=0;i<sel.options.length;i++){
          if (sel.options[i].value.toLowerCase().indexOf(plan.toLowerCase()) !== -1) { sel.selectedIndex = i; break; }
        }
      }
      document.getElementById('contactForm').addEventListener('submit', function(e){
        if (typeof grecaptcha !== 'undefined' && grecaptcha.getResponse().length === 0) {
          e.preventDefault();
          alert('Please complete the CAPTCHA before submitting.');
        }
      });
    })();
  </script>
</body>
</html>
