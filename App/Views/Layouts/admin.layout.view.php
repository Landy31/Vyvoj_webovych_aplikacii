<?php
/** @var string $contentHTML */
/** @var \Framework\Support\LinkGenerator $link */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= App\Configuration::APP_NAME ?> | Administrácia</title>
    <link rel="stylesheet" href="<?= $link->asset('css/e-clothing.css') ?>">
</head>
<body>
<header class="topbar">
    <a class="brand" href="<?= $link->url('home.index') ?>">
        <img src="<?= $link->asset('images/logo.png') ?>" alt="E-Clothing logo" class="brand-logo">
        <span class="brand-name">E-Clothing</span>
        <span class="brand-section">Administrácia</span>
    </a>
    <div class="account-area">
        <span class="avatar" aria-hidden="true">JN</span>
        <div class="account-copy"><strong>Jana Nováková</strong><small>Administrátorka</small></div>
        <span class="logout-link">Administrácia</span>
    </div>
</header>
<div class="app-layout">
    <aside class="sidebar">
        <p class="sidebar-heading">SPRÁVA OBCHODU</p>
        <nav class="side-nav" aria-label="Hlavná navigácia">
            <a href="<?= $link->url('home.index') ?>"><span class="nav-icon" aria-hidden="true">⌂</span> Prehľad</a>
            <a href="<?= $link->url('product.index') ?>"><span class="nav-icon" aria-hidden="true">◇</span> Produkty</a>
            <a href="<?= $link->url('product.add') ?>"><span class="nav-icon" aria-hidden="true">＋</span> Pridať produkt</a>
            <a href="#objednavky"><span class="nav-icon" aria-hidden="true">▤</span> Objednávky</a>
            <a href="#sklad"><span class="nav-icon" aria-hidden="true">▦</span> Skladové zásoby</a>
            <a href="#nastavenia"><span class="nav-icon" aria-hidden="true">⚙</span> Nastavenia</a>
        </nav>
    </aside>
    <main class="main-content">
        <?= $contentHTML ?>
    </main>
</div>
</body>
</html>
