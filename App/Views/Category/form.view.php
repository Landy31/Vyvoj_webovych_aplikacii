<?php
/** @var \App\Models\Category $category */
/** @var \App\Models\Product[] $products */
/** @var int[] $selectedProductIds */
/** @var string[] $errors */
/** @var \Framework\Support\LinkGenerator $link */
$escape = static fn($value): string => htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$isEdit = $category->getId() !== null;
?>
<div class="crud-page">
    <div class="page-intro">
        <a class="back-link" href="<?= $link->url('category.index') ?>">← Späť na zoznam kategórií</a>
        <div class="page-title-row">
            <div>
                <h1><?= $isEdit ? 'Úprava kategórie' : 'Pridanie kategórie' ?></h1>
                <p class="page-description">Vyplňte údaje kategórie a priraďte k nej produkty.</p>
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

    <form class="product-form" method="post" action="<?= $link->url('category.save') ?>">
        <input type="hidden" name="id" value="<?= $category->getId() ?? '' ?>">
        <section class="form-card category-details-card">
            <h2>Základné údaje</h2>
            <div class="field field-full">
                <label for="name">Názov kategórie <span>*</span></label>
                <input id="name" name="name" type="text" maxlength="80" value="<?= $escape($category->getName()) ?>" required>
            </div>
            <div class="field field-full">
                <label for="description">Popis kategórie</label>
                <textarea id="description" name="description" rows="3" maxlength="1000"><?= $escape($category->getDescription()) ?></textarea>
            </div>
        </section>

        <section class="form-card assignment-card">
            <div class="assignment-heading">
                <div>
                    <h2>Prepojené produkty</h2>
                    <p>Jedna kategória môže obsahovať viacero produktov (vzťah 1:N).</p>
                </div>
                <span class="relation-badge">1 kategória : N produktov</span>
            </div>

            <?php if ($products === []) : ?>
                <p class="empty-assignment">V databáze zatiaľ nie sú produkty. Najskôr pridajte produkt.</p>
            <?php else : ?>
                <div class="assignment-list">
                    <?php foreach ($products as $product) : ?>
                        <?php $currentCategory = $product->getOneRelated(\App\Models\Category::class); ?>
                        <label class="assignment-product">
                            <input type="checkbox" name="productIds[]" value="<?= (int)$product->getId() ?>"<?= in_array((int)$product->getId(), $selectedProductIds, true) ? ' checked' : '' ?>>
                            <span class="assignment-product-copy">
                                <strong><?= $escape($product->getName()) ?></strong>
                                <small>
                                    <?= $escape($product->getSize()) ?> · <?= $escape($product->getColor()) ?>
                                    <?php if ($currentCategory !== null && $currentCategory->getId() !== $category->getId()) : ?>
                                        · aktuálne: <?= $escape($currentCategory->getName()) ?> (po výbere sa presunie)
                                    <?php elseif ($currentCategory !== null) : ?>
                                        · aktuálne priradené sem
                                    <?php else : ?>
                                        · bez kategórie
                                    <?php endif; ?>
                                </small>
                            </span>
                        </label>
                    <?php endforeach; ?>
                </div>
                <p class="field-help">Zaškrtnuté produkty budú patriť do tejto kategórie. Produkt môže patriť iba do jednej kategórie; pri výbere sa presunie z pôvodnej.</p>
            <?php endif; ?>
        </section>

        <div class="form-actions">
            <p>ⓘ Odškrtnuté produkty, ktoré patria do tejto kategórie, budú odpojené.</p>
            <div class="action-buttons">
                <a class="button button-secondary" href="<?= $link->url('category.index') ?>">Zrušiť</a>
                <button class="button button-primary" type="submit"><?= $isEdit ? 'Uložiť zmeny' : 'Uložiť kategóriu' ?></button>
            </div>
        </div>
    </form>
</div>
