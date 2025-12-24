<?php
$basePath = "../../";
// Handle Form Submission
$statusMsg = '';
$statusType = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recaptchaSecret = '6LeFgzQsAAAAABpeB2KCvPyXHzyQESd-SUlILm5w';
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Verify Recaptcha
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
    $responseData = json_decode($verifyResponse);

    if ($responseData->success) {
        // Recaptcha validated
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $subject = htmlspecialchars($_POST['subject']);
        $message = htmlspecialchars($_POST['message']);

        // In a real scenario, send email here. For now, show success.
        // mail($to, $subject, $message, $headers);

        $statusMsg = "TRANSMISSION SUCCESSFUL. DATA PACKETS RECEIVED.";
        $statusType = "status-operational";
    } else {
        $statusMsg = "SECURITY ALERT. RECAPTCHA VALIDATION FAILED.";
        $statusType = "status-critical";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONTACT | Central.Enterprises</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sora:wght@800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../../assets/titan.css?v=8">
    <script src="../../assets/theme-toggle.js?v=7" defer></script>
    <script src="../../assets/cookies.js?v=5" defer></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body data-theme="titan-dark">
    <div class="grid-bg"></div>

    <?php include '../../includes/cookies_banner.php'; ?>

    <nav>
        <div class="grid-container">
            <div class="nav-content">
                <div class="logo">
                    <a href="/" style="text-decoration:none; color:inherit">CENTRAL ENTERPRISES</a>
                </div>
                <button id="theme-toggle" class="theme-btn" title="Toggle Theme"></button>
            </div>
        </div>
    </nav>

    <main>
        <header class="hero">
            <div class="grid-container">
                <h1 class="hero-title">INITIATE <br>SECURE UPLINK.</h1>
                <div class="hero-desc">
                    Direct operational channel to Central Enterprises core command.
                    Encrypted transmission protocols active.
                </div>
            </div>
        </header>

        <section class="section">
            <div class="grid-container">
                <div class="section-meta">TRANSMISSION DATA</div>
                <div class="section-content">

                    <?php if ($statusMsg): ?>
                        <div class="<?= $statusType ?>"
                            style="margin-bottom: 2rem; border: 1px solid currentColor; padding: 1rem;">
                            <?= $statusMsg ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="span-8" style="grid-column: span 12;">
                            <div class="titan-form-group">
                                <label class="titan-label">IDENTITY (NAME)</label>
                                <input type="text" name="name" class="titan-input" required>
                            </div>

                            <div class="titan-form-group">
                                <label class="titan-label">ORIGIN POINT (EMAIL)</label>
                                <input type="email" name="email" class="titan-input" required>
                            </div>

                            <div class="titan-form-group">
                                <label class="titan-label">SUBJECT VECTOR</label>
                                <input type="text" name="subject" class="titan-input" required>
                            </div>

                            <div class="titan-form-group">
                                <label class="titan-label">DATA PAYLOAD (MESSAGE)</label>
                                <textarea name="message" class="titan-input" rows="6" required
                                    style="resize: vertical;"></textarea>
                            </div>

                            <div class="titan-form-group">
                                <label class="titan-label">SECURITY VERIFICATION</label>
                                <div class="g-recaptcha" data-sitekey="6LeFgzQsAAAAAGB8-alUu_JHZbcVHj7xhdnGpooS"></div>
                            </div>

                            <button type="submit" class="btn-institutional primary">
                                TRANSMIT DATA <span class="arrow">→</span>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </section>

    </main>

    <?php include '../../includes/footer.php'; ?>
</body>

</html>