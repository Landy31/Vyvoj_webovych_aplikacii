<?php
/** @var \App\Models\Product $product */
/** @var string[] $errors */
/** @var \Framework\Support\LinkGenerator $link */
$escape = static fn($value): string => htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$isEdit = $product->getId() !== null;
$categories = ['Tričká', 'Nohavice', 'Bundy', 'Mikiny', 'Šaty', 'Doplnky'];
$sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
$colors = ['Čierna', 'Biela', 'Modrá', 'Červená', 'Sivá', 'Žltá', 'Zelená'];
?>
<div class="crud-page">
    <div class="page-intro">
        <a class="back-link" href="<?= $link->url('product.index') ?>">← Späť na zoznam produktov</a>
        <div class="page-title-row">
            <div>
                <h1><?= $isEdit ? 'Úprava produktu' : 'Pridanie produktu' ?></h1>
                <p class="page-description">Vyplňte údaje o oblečení a uložte ich do databázy obchodu.</p>
            </div>
            <p class="required-note"><span>*</span> Povinné polia</p>
        </div>
    </div>

    <?php if ($errors !== []) : ?>
        <div class="crud-alert" role="alert">
            <strong>Skontrolujte zadané údaje:</strong>
            <ul><?php foreach ($errors as $error) : ?><li><?= $escape($error) ?></li><?php endforeach; ?></ul>
        </div>
    <?php endif; ?>

    <form class="product-form" method="post" action="<?= $link->url('product.save') ?>">
        <input type="hidden" name="id" value="<?= $product->getId() ?? '' ?>">
        <div class="form-layout">
            <section class="form-card product-details">
                <h2>Základné údaje</h2>
                <div class="field field-full">
                    <label for="name">Názov produktu <span>*</span></label>
                    <input id="name" name="name" type="text" maxlength="150" value="<?= $escape($product->getName()) ?>" required>
                </div>
                <div class="field-row">
                    <div class="field">
                        <label for="category">Kategória <span>*</span></label>
                        <select id="category" name="category" required>
                            <option value="">Vyberte kategóriu</option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $escape($category) ?>"<?= $product->getCategory() === $category ? ' selected' : '' ?>><?= $escape($category) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field">
                        <label for="price">Cena <span>*</span></label>
                        <div class="input-with-suffix">
                            <input id="price" name="price" type="number" min="0" step="0.01" value="<?= $product->getPrice() !== null ? $escape(number_format($product->getPrice(), 2, '.', '')) : '' ?>" required>
                            <span>EUR</span>
                        </div>
                    </div>
                </div>
                <div class="field field-full">
                    <label for="description">Popis produktu <span>*</span></label>
                    <textarea id="description" name="description" rows="4" maxlength="2000" required><?= $escape($product->getDescription()) ?></textarea>
                </div>
                <div class="section-divider"></div>
                <section class="stock-section">
                    <h2>Veľkosť a sklad</h2>
                    <div class="stock-grid">
                        <div class="field">
                            <label for="size">Veľkosť <span>*</span></label>
                            <select id="size" name="size" required>
                                <option value="">Vyberte</option>
                                <?php foreach ($sizes as $size) : ?>
                                    <option value="<?= $escape($size) ?>"<?= $product->getSize() === $size ? ' selected' : '' ?>><?= $escape($size) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="field">
                            <label for="color">Farba <span>*</span></label>
                            <select id="color" name="color" required>
                                <option value="">Vyberte</option>
                                <?php foreach ($colors as $color) : ?>
                                    <option value="<?= $escape($color) ?>"<?= $product->getColor() === $color ? ' selected' : '' ?>><?= $escape($color) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="field">
                            <label for="stockQuantity">Skladové množstvo <span>*</span></label>
                            <div class="input-with-suffix">
                                <input id="stockQuantity" name="stockQuantity" type="number" min="0" step="1" value="<?= $product->getStockQuantity() !== null ? (int)$product->getStockQuantity() : '' ?>" required>
                                <span>ks</span>
                            </div>
                        </div>
                    </div>
                    <p class="field-help">Počet kusov na sklade pre zadanú veľkosť a farbu.</p>
                </section>
            </section>

            <aside class="form-card photo-card">
                <h2>Fotografia</h2>
                <div class="photo-placeholder">
                    <span class="image-symbol" aria-hidden="true"></span>
                    <span class="photo-placeholder-label">Fotografia nie je súčasťou tejto databázovej úlohy</span>
                </div>
                <p class="field-help">V tejto verzii sa ukladajú údaje o produkte. Nahrávanie obrázkov bude možné doplniť neskôr.</p>
            </aside>
        </div>

        <div class="form-actions">
            <p>ⓘ Údaje sa uložia do databázovej tabuľky products.</p>
            <div class="action-buttons">
                <a class="button button-secondary" href="<?= $link->url('product.index') ?>">Zrušiť</a>
                <button class="button button-primary" type="submit"><?= $isEdit ? 'Uložiť zmeny' : 'Uložiť produkt' ?></button>
            </div>
        </div>
    </form>
</div>
