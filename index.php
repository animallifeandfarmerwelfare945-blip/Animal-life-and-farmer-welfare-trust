<?php
require_once __DIR__ . '/security.php';
require_once __DIR__ . '/content-helper.php';
$homePage = pageContent('home', 'Dedicated to the service of the voiceless and farmers', 'Dedicated to the service of the voiceless and farmers');
$contentFile = __DIR__ . '/content-data.json';
$contentData = is_readable($contentFile) ? json_decode(file_get_contents($contentFile), true) : [];
$members = $contentData['members'] ?? [];
$counterFile = __DIR__ . '/visitor-count.txt';
$visitorCount = 0;
$counterHandle = fopen($counterFile, 'c+');

if ($counterHandle !== false) {
    flock($counterHandle, LOCK_EX);
    $visitorCount = (int) trim(stream_get_contents($counterHandle));

    if (!isset($_COOKIE['site_visitor_counted'])) {
        $visitorCount++;
        ftruncate($counterHandle, 0);
        rewind($counterHandle);
        fwrite($counterHandle, (string) $visitorCount);
        setcookie('site_visitor_counted', '1', time() + 86400, '/', '', false, true);
    }

    flock($counterHandle, LOCK_UN);
    fclose($counterHandle);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Animal life and farmer welfare trust</title>
    
    <!-- HARD SYNCHRONIZED PHP CACHE BYPASS LINK (Fights browser memory lock) -->
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>

    <!-- PHP FIXED: Server-side dynamic header component inclusion wrapper -->
    <?php include 'header.php'; ?>

    <!-- 1. PREMIUM ANIMATED HERO SLIDER CONTAINER WITH LESS TRANSPARENCY & BOTTOM CURVE -->
    <section class="hero" id="home">
        <div class="hero-gallery" aria-hidden="true">
            <img src="gallery/animal-care.jpg" alt="">
            <img src="gallery/farm-animal.jpg" alt="">
            <img src="gallery/farmland.jpg" alt="">
        </div>
        <?php if ($homePage['photo']): ?>
        <div class="hero-photo-overlay" aria-hidden="true" style="background-image:url('<?php echo htmlspecialchars($homePage['photo'], ENT_QUOTES, 'UTF-8'); ?>');"></div>
        <?php endif; ?>
        <h1 id="text-hero-title"><?php echo htmlspecialchars($homePage['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
        <p id="text-hero-desc"><?php echo htmlspecialchars($homePage['description'], ENT_QUOTES, 'UTF-8'); ?></p>
        <a href="donation.php" class="hero-btn" id="text-hero-btn">Donate Now</a>
        <div class="visitor-badge">👁 Total Visitors: <strong><?php echo number_format($visitorCount); ?></strong></div>

        <!-- Premium SVG Wave Layout Curve Shape -->
        <div class="hero-curve">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>

    <!-- MAIN UNIFIED FLUID LAYOUT WORKSPACE CONTAINER -->
    <main class="main-container">
        
        <!-- 2. ABOUT US NARRATIVE DESCRIPTION BLOCK -->
        <section id="about" style="margin-bottom: 60px; text-align: center;">
            <h2 class="section-title" id="text-about-title">About Us</h2>
            <p id="text-about-desc" style="max-width: 850px; margin: 0 auto; color: #4a5568; font-size: 17px; line-height: 1.8;">
                Animal life and farmer welfare trust is a community-focused non-profit organization working for the protection, treatment and dignity of animals. Alongside animal welfare, the trust supports farmers with practical guidance, awareness and welfare initiatives so that people, animals and rural communities can grow together.
            </p>
            <div class="trust-details">
                <a class="trust-detail-card trust-detail-link" href="animal-care.php">
                    <span class="trust-detail-icon">🐾</span>
                    <h3>Animal Care</h3>
                    <p>Medical support, rescue assistance, food and safe shelter for injured, sick and abandoned animals.</p>
                    <span class="trust-detail-cta">Learn more →</span>
                </a>
                <a class="trust-detail-card trust-detail-link" href="farmer-welfare.php">
                    <span class="trust-detail-icon">🌾</span>
                    <h3>Farmer Welfare</h3>
                    <p>Awareness, guidance and community support that help farmers build safer and more sustainable livelihoods.</p>
                    <span class="trust-detail-cta">Learn more →</span>
                </a>
                <a class="trust-detail-card trust-detail-link" href="our-mission.php">
                    <span class="trust-detail-icon">🤝</span>
                    <h3>Our Mission</h3>
                    <p>To create a compassionate society where every animal is protected and every rural family is respected.</p>
                    <span class="trust-detail-cta">Learn more →</span>
                </a>
            </div>
            <div class="leadership-block">
                <div class="leadership-heading">
                    <span class="detail-kicker">People Behind The Trust</span>
                    <h3>Our Founders and Members</h3>
                    <p>Our work grows through the care, ideas and commitment of people who serve animals, farmers and the wider community.</p>
                </div>
                <div class="about-team">
                    <?php foreach ($members as $member): ?>
                    <?php $memberName = trim((string) ($member['name'] ?? 'Member')); ?>
                    <?php $memberRole = trim((string) ($member['role'] ?? 'Member')); ?>
                    <?php $memberBio = trim((string) ($member['bio'] ?? '')); ?>
                    <?php $memberPhoto = trim((string) ($member['photo'] ?? '')); ?>
                    <?php $safePhoto = $memberPhoto !== '' ? $memberPhoto : 'logo.png'; ?>
                    <article class="about-member">
                        <div class="about-member-photo" style="background-image: url('<?php echo htmlspecialchars($safePhoto, ENT_QUOTES, 'UTF-8'); ?>'); background-repeat: no-repeat; background-size: cover; background-position: center top;" onerror="this.style.backgroundImage='url(\'logo.png\')';"></div>
                        <div class="about-member-body">
                            <h3><?php echo htmlspecialchars($memberName, ENT_QUOTES, 'UTF-8'); ?></h3>
                            <small><?php echo htmlspecialchars($memberRole, ENT_QUOTES, 'UTF-8'); ?></small>
                            <p><?php echo htmlspecialchars($memberBio, ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
                <p class="member-photo-note">Member details can be updated from the administrator dashboard after login.</p>
            </div>
        </section>

        <section id="volunteer" style="margin-bottom: 60px; text-align: center; padding: 40px 20px; background: linear-gradient(135deg, #faf8f3, #faf5e6); border-radius: 16px;">
            <h2 class="section-title">Become a Volunteer</h2>
            <p style="max-width: 700px; margin: 0 auto 24px; color: #3e4f5c; font-size: 16px; line-height: 1.7;">
                Join us in serving animals and farmers. Fill the volunteer registration form and be part of the change.
            </p>
            <a href="volunteer-signup.php" class="donate-btn" style="display:inline-flex;">
                <span>🤲</span> <span class="btn-text">Register as Volunteer</span>
            </a>
        </section>

        <!-- 3. COMPLIANCE & LEGAL TRANSPARENCY CARDS SECTION -->
        <section id="compliance" style="margin-bottom: 60px;">
            <h2 class="section-title" id="text-comp-title">Compliance & Transparency</h2>
            <p style="text-align: center; color: #718096; margin-bottom: 30px; font-size: 15px;">Hum transparency me vishwas rakhte hain. Corporate aur individual donors ke liye humare saare registrations poore hain.</p>
            
            <div class="grid-layout">
                <div class="info-card">
                    <h3>Form 10AC</h3>
                    <p id="text-c1">Trust registration aur tax exemptions ke liye approved status.</p>
                </div>
                <div class="info-card">
                    <h3>80G Registration</h3>
                    <p id="text-c2">Donors ko donation par tax me chhoot (exemption) milti hai.</p>
                </div>
                <div class="info-card">
                    <h3>12A Registration</h3>
                    <p id="text-c3">Trust ki income ko tax-free rakhne ke liye regulatory approval.</p>
                </div>
                <div class="info-card">
                    <h3>CSR-1 Registered</h3>
                    <p id="text-c4">Companies se Corporate Social Responsibility (CSR) funds lene ke liye eligible.</p>
                </div>
            </div>
        </section>

        <!-- 4. CONTACT INFRASTRUCTURE & REGIONAL BANK DETAILS GRID PANEL -->
        <section id="contact">
            <h2 class="section-title" id="text-contact-title">Sampark & Donation</h2>
            <div class="contact-wrapper">
                <!-- Left Column Details block sheets -->
                <div class="contact-info">
                    <h3 id="text-info-heading">Trust Details</h3>
                    <p><strong>📍 Office Address:</strong> 140, Dariyai Khera, Unnao, Uttar Pradesh</p>
                    <p><strong>📞 Phone Number:</strong> <a href="tel:+919454750743">+91 9454750743</a></p>
                    <p><strong>✉ Email Address:</strong> animalLifeandFarmerwelfare@gmail.com</p>
                    <br>
                    <h3 id="text-bank-heading">Bank Account Details</h3>
                    <p><strong>Bank Account Name:</strong> Animal life and farmer welfare trust</p>
                    <p><strong>Bank:</strong> UCO Bank</p>
                    <p><strong>Account No:</strong> 22640110147214</p>
                    <p><strong>IFSC Code:</strong> UCBA002264</p>
                </div>

                <!-- Right Column Interactive Feed Form Area -->
                <div class="contact-form">
                    <h3 id="text-form-heading">Connect With Us</h3>
                    <form id="contact-message-form">
                        <div class="form-field">
                            <label for="form-name">Your Name</label>
                            <input type="text" id="form-name" placeholder="Enter your name" required>
                        </div>
                        <div class="form-field">
                            <label for="form-email">Email</label>
                            <input type="email" id="form-email" placeholder="Enter your email" required>
                        </div>
                        <div class="form-field">
                            <label for="form-mobile">Mobile Number</label>
                            <input type="tel" id="form-mobile" inputmode="tel" placeholder="Enter your mobile number" required>
                        </div>
                        <div class="form-field">
                            <label for="form-msg">Message</label>
                            <div class="message-input-wrap">
                                <textarea id="form-msg" rows="4" placeholder="Write your message" required></textarea>
                                <button type="button" class="voice-input-button" id="voice-input-button" aria-label="Dictate message" title="Dictate message">
                                    <span aria-hidden="true">🎙</span> <span class="voice-input-label">Use microphone</span>
                                </button>
                            </div>
                            <p id="voice-input-status" class="voice-input-status" role="status" aria-live="polite"></p>
                        </div>
                        <div class="captcha-row">
                            <label for="form-captcha">Captcha: <strong id="captcha-question"></strong></label>
                            <input type="text" id="form-captcha" inputmode="numeric" autocomplete="off" placeholder="Code likhein" required>
                        </div>
                        <p id="contact-form-status" class="contact-form-status" role="status" aria-live="polite"></p>
                        <button type="submit" id="text-form-btn">Send Message</button>
                    </form>
                </div>

            </div>
        </section>

    </main>

    <?php include 'footer.php'; ?>

    <!-- ==========================================================================
       DYNAMICS ROUTING LOGIC ENGINE & PORTAL DROP-DOWN TOGGLE BINDERS
       ========================================================================== -->
    <script>
        // Bind interactive portal elements as soon as browser DOM loading cycle finishes
        document.addEventListener("DOMContentLoaded", function() {
            // Highlight current homepage layout tab as active state menu item
            if(document.querySelector('.nav-home')) {
                document.querySelector('.nav-home').classList.add('active');
            }

            // Interactive Portal login toggle events intercept trigger parameters
            const portalBtn = document.getElementById('portal-btn-trigger');
            const dropdownMenu = document.getElementById('portalDropdownMenu');

            if (portalBtn && dropdownMenu) {
                portalBtn.addEventListener('click', function(event) {
                    event.stopPropagation();
                    dropdownMenu.classList.toggle('show-portal');
                });
            }
            
            // Sync values with cloud dataset sheets if URL configurations are populated
            if(GLOBAL_SHEETS_API_URL !== "YOUR_GOOGLE_APPS_SCRIPT_WEB_APP_URL_HERE") {
                syncGlobalSiteContent();
            }

            const messageForm = document.getElementById('contact-message-form');
            const captchaQuestion = document.getElementById('captcha-question');
            const captchaInput = document.getElementById('form-captcha');
            const formStatus = document.getElementById('contact-form-status');
            let captchaAnswer = 0;

            function createCaptcha() {
                const firstNumber = Math.floor(Math.random() * 8) + 2;
                const secondNumber = Math.floor(Math.random() * 8) + 1;
                captchaAnswer = firstNumber + secondNumber;
                captchaQuestion.textContent = `${firstNumber} + ${secondNumber} = ?`;
                captchaInput.value = '';
            }

            if (messageForm) {
                createCaptcha();
                messageForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    formStatus.textContent = '';

                    if (Number(captchaInput.value.trim()) !== captchaAnswer) {
                        formStatus.textContent = 'Captcha galat hai. Dobara try karein.';
                        formStatus.className = 'contact-form-status error';
                        createCaptcha();
                        captchaInput.focus();
                        return;
                    }

                    const name = document.getElementById('form-name').value.trim();
                    const email = document.getElementById('form-email').value.trim();
                    const mobile = document.getElementById('form-mobile').value.trim();
                    const message = document.getElementById('form-msg').value.trim();
                    const sheetsEndpoint = typeof GLOBAL_SHEETS_API_URL === 'string' ? GLOBAL_SHEETS_API_URL : '';
                    if (!sheetsEndpoint || sheetsEndpoint === 'YOUR_GOOGLE_APPS_SCRIPT_WEB_APP_URL_HERE') {
                        formStatus.textContent = 'Google Sheet API abhi configure nahi hai.';
                        formStatus.className = 'contact-form-status error';
                        return;
                    }

                    const formData = new URLSearchParams({
                        action: 'appendMessage',
                        name: name,
                        email: email,
                        mobile: mobile,
                        message: message,
                        submittedAt: new Date().toISOString()
                    });
                    const submitButton = document.getElementById('text-form-btn');
                    submitButton.disabled = true;
                    submitButton.textContent = 'Saving...';

                    fetch(sheetsEndpoint, { method: 'POST', mode: 'no-cors', body: formData })
                        .then(function() {
                            formStatus.textContent = 'We received your message.';
                            formStatus.className = 'contact-form-status success';
                            messageForm.reset();
                            createCaptcha();
                        })
                        .catch(function() {
                            formStatus.textContent = 'Message save nahi ho saka. Dobara try karein.';
                            formStatus.className = 'contact-form-status error';
                        })
                        .finally(function() {
                            submitButton.disabled = false;
                            submitButton.textContent = 'Send Message';
                        });
                });
            }

            const voiceButton = document.getElementById('voice-input-button');
            const voiceStatus = document.getElementById('voice-input-status');
            const messageInput = document.getElementById('form-msg');
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

            if (voiceButton && voiceStatus && messageInput) {
                if (!SpeechRecognition) {
                        voiceButton.disabled = true;
                        voiceStatus.textContent = 'Voice input is not supported in this browser.';
                } else {
                        const recognition = new SpeechRecognition();
                        let messageBeforeListening = '';
                        let isListening = false;

                        recognition.lang = navigator.language || 'en-IN';
                        recognition.interimResults = true;
                        recognition.continuous = false;

                        voiceButton.addEventListener('click', function() {
                            if (isListening) {
                                recognition.stop();
                                return;
                            }

                            messageBeforeListening = messageInput.value.trim();
                            voiceStatus.textContent = 'Listening... speak your message.';
                            try {
                                recognition.start();
                            } catch (error) {
                                voiceStatus.textContent = 'Microphone could not be started. Please try again.';
                            }
                        });

                        recognition.onstart = function() {
                            isListening = true;
                            voiceButton.classList.add('is-listening');
                            voiceButton.querySelector('.voice-input-label').textContent = 'Stop listening';
                        };

                        recognition.onresult = function(event) {
                            let transcript = '';
                            for (let index = event.resultIndex; index < event.results.length; index += 1) {
                                transcript += event.results[index][0].transcript;
                            }
                            messageInput.value = messageBeforeListening
                                ? messageBeforeListening + ' ' + transcript.trim()
                                : transcript.trim();
                        };

                        recognition.onerror = function(event) {
                            const statusMessages = {
                                'not-allowed': 'Microphone permission was denied.',
                                'no-speech': 'No speech was detected. Please try again.',
                                'audio-capture': 'No microphone was found.'
                            };
                            voiceStatus.textContent = statusMessages[event.error] || 'Voice input failed. Please try again.';
                        };

                        recognition.onend = function() {
                            isListening = false;
                            voiceButton.classList.remove('is-listening');
                            voiceButton.querySelector('.voice-input-label').textContent = 'Use microphone';
                            if (!voiceStatus.textContent || voiceStatus.textContent === 'Listening... speak your message.') {
                                voiceStatus.textContent = 'Voice input finished.';
                            }
                        };
                }
            }
        });

        // Global browser document overlay frame checker to collapse floating dropcards if clicked outside
        window.addEventListener('click', function() {
            const dropdownMenu = document.getElementById('portalDropdownMenu');
            if (dropdownMenu && dropdownMenu.classList.contains('show-portal')) {
                dropdownMenu.classList.remove('show-portal');
            }
        });

        // Dynamic cloud properties variables loading interface logic mapping block
        function syncGlobalSiteContent() {
            fetch('content-data.json?cacheBust=' + Date.now())
                .then(res => {
                    if (!res.ok) throw new Error('Site settings could not be loaded');
                    return res.json();
                })
                .then(data => {
                    const settings = data && data.settings ? data.settings : {};
                    const logoUrl = settings.logoUrl || 'logo.png';
                    const logoWidth = Math.max(24, Math.min(240, Number(settings.logoWidth) || 52));
                    const logoHeight = Math.max(24, Math.min(240, Number(settings.logoHeight) || 52));
                    const rootStyle = document.documentElement.style;
                    rootStyle.setProperty('--site-logo-width', logoWidth + 'px');
                    rootStyle.setProperty('--site-logo-height', logoHeight + 'px');
                    const logo = document.querySelector('.logo-img');
                    if (logo) logo.src = logoUrl;
                })
                .catch(error => console.error("Site Settings Sync Failure:", error));
        }

        // Google Translate Web Component simple translation initialization hooks 
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,hi',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }

        (function(){
            const track = document.querySelector('.about-team');
            if (!track) return;
            let timer = null;
            const delay = 2200;
            const getStep = () => {
                const card = track.querySelector('.about-member');
                if (!card) return 282;
                return card.offsetWidth + 22;
            };
            const scrollOne = () => {
                const max = track.scrollWidth - track.clientWidth;
                let next = track.scrollLeft + getStep();
                if (next >= max - 1) next = 0;
                track.scrollTo({ left: next, behavior: 'smooth' });
            };
            const start = () => { if (!timer) timer = setInterval(scrollOne, delay); };
            const stop = () => { if (timer) { clearInterval(timer); timer = null; } };
            track.addEventListener('mouseenter', stop);
            track.addEventListener('mouseleave', start);
            track.addEventListener('touchstart', stop, { passive: true });
            track.addEventListener('touchend', () => setTimeout(start, 1200));
            start();
        })();
    </script>
</body>
</html>
