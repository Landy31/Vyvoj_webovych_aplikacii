<?php
/** @var \Framework\Support\LinkGenerator $link */
?>
<div class="page-intro">
    <a class="back-link" href="<?= $link->url('home.index') ?>">← Späť na zoznam produktov</a>
    <div class="page-title-row">
        <div>
            <h1>Pridanie produktu</h1>
            <p class="page-description">Vyplňte údaje o oblečení a uložte nový produkt do obchodu.</p>
        </div>
        <p class="required-note"><span>*</span> Povinné polia</p>
    </div>
</div>

<form class="product-form" action="<?= $link->url('home.addProduct') ?>" method="get">
    <div class="form-layout">
        <section class="form-card product-details">
            <h2>Základné údaje</h2>

            <div class="field field-full">
                <label for="product-name">Názov produktu <span>*</span></label>
                <input id="product-name" name="product-name" type="text" value="Bavlnené tričko s krátkym rukávom" required>
            </div>

            <div class="field-row">
                <div class="field">
                    <label for="category">Kategória <span>*</span></label>
                    <select id="category" name="category" required>
                        <option selected>Tričká</option><option>Nohavice</option><option>Bundy</option><option>Mikiny</option><option>Doplnky</option>
                    </select>
                </div>
                <div class="field">
                    <label for="price">Cena <span>*</span></label>
                    <div class="input-with-suffix">
                        <input id="price" name="price" type="number" value="19.90" min="0" step="0.01" required>
                        <span>EUR</span>
                    </div>
                </div>
            </div>

            <div class="field field-full">
                <label for="description">Popis produktu <span>*</span></label>
                <textarea id="description" name="description" rows="4" required>Pohodlné tričko zo 100 % bavlny s okrúhlym výstrihom. Rovný strih a mäkký materiál na každodenné nosenie.</textarea>
            </div>

            <div class="section-divider"></div>
            <section class="stock-section">
                <h2>Veľkosť a sklad</h2>
                <div class="stock-grid">
                    <div class="field">
                        <label for="size">Veľkosť <span>*</span></label>
                        <select id="size" name="size" required>
                            <option>XS</option><option>S</option><option selected>M</option><option>L</option><option>XL</option><option>XXL</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="color">Farba <span>*</span></label>
                        <select id="color" name="color" required>
                            <option selected>Čierna</option><option>Biela</option><option>Modrá</option><option>Červená</option><option>Sivá</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="quantity">Skladové množstvo <span>*</span></label>
                        <div class="input-with-suffix">
                            <input id="quantity" name="quantity" type="number" value="25" min="0" required>
                            <span>ks</span>
                        </div>
                    </div>
                </div>
                <p class="field-help">Počet kusov na sklade pre zadanú veľkosť a farbu.</p>
            </section>
        </section>

        <section class="form-card photo-card">
            <h2>Fotografia <span>*</span></h2>
            <div class="photo-placeholder">
                <span class="image-symbol" aria-hidden="true"></span>
                <span class="photo-placeholder-label">Náhľad fotografie</span>
            </div>
            <label class="button button-primary upload-button" for="photo">↑ Nahrať fotografiu</label>
            <input class="file-input" id="photo" name="photo" type="file" accept="image/jpeg,image/png">
            <p class="file-status">Zatiaľ nie je vybraný žiadny súbor.</p>
            <p class="field-help">Vyberte fotografiu, ktorá zreteľne zobrazuje produkt. Formát JPG alebo PNG.</p>
        </section>
    </div>

    <div class="form-actions">
        <p>ⓘ Pred uložením doplňte fotografiu a všetky povinné polia.</p>
        <div class="action-buttons">
            <a class="button button-secondary" href="<?= $link->url('home.index') ?>">Zrušiť</a>
            <button class="button button-primary" type="button">Uložiť produkt</button>
        </div>
    </div>
</form>
