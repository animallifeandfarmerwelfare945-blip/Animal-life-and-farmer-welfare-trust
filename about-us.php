<?php
require_once __DIR__ . '/security.php';
require_once __DIR__ . '/content-helper.php';
$content = siteContent();
$members = $content['members'] ?? [];
$page = pageContent('about', 'Animal life and farmer welfare trust', 'A community-focused trust working for animals, farmers and compassionate rural communities');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Animal life and farmer welfare trust</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <style>
        .about-page { max-width: 1120px; margin: 0 auto; padding: 55px 30px 80px; }
        .about-hero { position: relative; overflow: hidden; padding: 64px 30px; border-radius: 14px; color: #fff; text-align: center; background: linear-gradient(135deg, #0f1c2e, #0f1c2e); box-shadow: 0 12px 28px rgba(15,28,46,0.16); }
        .about-hero-photo { position: absolute; inset: 0; background-size: cover; background-position: center; opacity: 0.25; z-index: 0; }
        .about-hero .detail-kicker, .about-hero h1, .about-hero .about-tagline, .about-hero .about-sankalp, .about-hero p { position: relative; z-index: 1; }
        .about-hero h1 { margin: 10px auto 14px; font-size: 42px; }
        .about-tagline { display: inline-block; margin: 4px auto 18px; padding: 8px 18px; border: 1px solid rgba(255,255,255,.45); border-radius: 999px; color: #d4a853; font-size: 18px; font-weight: 700; }
        .about-sankalp { max-width: 820px; margin: 0 auto 22px; color: rgba(255,255,255,.9); font-size: 15px; font-weight: 600; line-height: 1.7; }
        .about-hero p { max-width: 760px; margin: 0 auto; font-size: 18px; line-height: 1.7; opacity: .94; }
        .about-section { margin-top: 46px; }
        .about-section h2 { margin-bottom: 14px; color: #0f1c2e; font-size: 30px; }
        .about-section > p { color: #3e4f5c; font-size: 17px; line-height: 1.8; }
        .about-pillars { display: grid; grid-template-columns: repeat(3, 1fr); gap: 22px; margin-top: 28px; }
        .about-pillar { padding: 26px; border-top: 4px solid #d4a853; border-radius: 10px; background: #fff; box-shadow: 0 8px 20px rgba(15,28,46,.06); }
        .about-pillar span { font-size: 30px; }
        .about-pillar h3 { margin: 12px 0 8px; color: #0f1c2e; }
        .about-pillar p { color: #4a5568; line-height: 1.7; }
        .about-pillar-link { display: block; color: inherit; text-decoration: none; transition: transform .2s ease, box-shadow .2s ease; }
        .about-pillar-link:hover { transform: translateY(-4px); box-shadow: 0 14px 28px rgba(15,28,46,.12); }
        .about-pillar-link strong { display: inline-block; margin-top: 14px; color: #8c6a2e; font-size: 14px; }
        .about-values { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; margin-top: 22px; }
        .about-value { padding: 20px 22px; border-left: 4px solid #d4a853; background: #fdf9ed; color: #4a5568; line-height: 1.7; }
        .about-value strong { display: block; margin-bottom: 4px; color: #6d4a13; }
        .about-team { display: grid; grid-template-columns: repeat(3, 1fr); gap: 22px; margin-top: 26px; }
        .about-member { overflow: hidden; border: 1px solid #dce9e7; border-radius: 12px; background: #fff; box-shadow: 0 8px 20px rgba(15,28,46,.07); }
        .about-member-photo { width: 142px; height: 142px; margin: 22px auto 0; border: 3px solid #fff; border-radius: 50%; background-position: center; background-size: cover; box-shadow: 0 5px 18px rgba(15,28,46,.14); }
        .about-member-body { padding: 20px; text-align: center; }
        .about-member-body small { color: #8c6a2e; font-weight: 800; text-transform: uppercase; }
        .about-member-body h3 { margin: 7px 0; color: #0f1c2e; }
        .about-member-body p { color: #4a5568; font-size: 14px; line-height: 1.65; }
        .about-cta { display: flex; justify-content: center; gap: 22px; align-items: center; margin-top: 42px; }
        @media (max-width: 850px) { .about-pillars, .about-team { grid-template-columns: 1fr; max-width: 430px; margin-left: auto; margin-right: auto; } }
        @media (max-width: 600px) { .about-page { padding: 30px 18px 55px; } .about-hero { padding: 44px 20px; } .about-hero h1 { font-size: 32px; } .about-values { grid-template-columns: 1fr; } .about-cta { flex-direction: column; } }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="about-page">
        <section class="about-hero">
            <?php if ($page['photo']): ?>
            <div class="about-hero-photo" aria-hidden="true" style="background-image:url('<?php echo htmlspecialchars($page['photo'], ENT_QUOTES, 'UTF-8'); ?>');"></div>
            <?php endif; ?>
            <span class="detail-kicker">Who We Are</span>
            <h1>Animal life and farmer welfare trust</h1>
            <div class="about-tagline">सेवा ही हमारा धर्म है</div>
            <p class="about-sankalp">हमारा संकल्प: मानव सेवा, पशु कल्याण, किसान कल्याण और सामाजिक उत्थान</p>
            <p><?php echo htmlspecialchars($page['description'], ENT_QUOTES, 'UTF-8'); ?></p>
        </section>

        <section class="about-section">
            <h2>Our Story</h2>
            <p>Animal life and farmer welfare trust is a non-profit, community-focused organization dedicated to the care and protection of animals and the welfare of farmers. We believe compassion becomes meaningful when it reaches the ground through rescue support, awareness, practical guidance and community participation.</p>
            <div class="about-pillars">
                <a class="about-pillar about-pillar-link" href="animal-care.php"><span>🐾</span><h3>Animal Care</h3><p>Support for injured, sick, abandoned and vulnerable animals through rescue assistance, medical guidance, food and shelter.</p><strong>Read more →</strong></a>
                <a class="about-pillar about-pillar-link" href="farmer-welfare.php"><span>🌾</span><h3>Farmer Welfare</h3><p>Awareness and practical community support for farmers and rural families who work hard to sustain our communities.</p><strong>Read more →</strong></a>
                <a class="about-pillar about-pillar-link" href="our-mission.php"><span>🤝</span><h3>Community Action</h3><p>Working with volunteers, families and local supporters to build a kinder and more responsible society.</p><strong>Read more →</strong></a>
            </div>
        </section>

        <section class="about-section">
            <h2>What We Believe</h2>
            <div class="about-values">
                <div class="about-value"><strong>Compassion</strong>Every animal deserves kindness, safety and a chance to recover.</div>
                <div class="about-value"><strong>Dignity</strong>Every farmer, volunteer and community member should be treated with respect.</div>
                <div class="about-value"><strong>Responsibility</strong>Small, consistent actions can prevent suffering and create lasting change.</div>
                <div class="about-value"><strong>Transparency</strong>We value honest communication and responsible use of support.</div>
            </div>
        </section>

        <section class="about-section">
            <h2>Our Founders and Trust Members</h2>
            <p>The trust grows through the commitment of people who bring leadership, care and local knowledge to this mission.</p>
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
        </section>

        <div class="about-cta"><a class="hero-btn" href="donation.php">Support Our Work</a><a class="text-link" href="index.php#contact">Contact the Trust</a></div>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>
