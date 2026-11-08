<?php
/** @var \App\Models\Product[] $products */
/** @var \Framework\Support\LinkGenerator $link */
$escape = static fn($value): string => htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
?>
<div class="crud-page">
    <div class="crud-heading">
        <div>
            <p class="eyebrow">SPRÁVA OBCHODU</p>
            <h1>Produkty</h1>
            <p class="page-description">Zoznam produktov uložených v databáze E-Clothing.</p>
        </div>
        <a class="button button-primary" href="<?= $link->url('product.add') ?>">＋ Pridať produkt</a>
    </div>

    <section class="crud-card" aria-labelledby="product-list-title">
        <div class="crud-card-heading">
            <div>
                <h2 id="product-list-title">Zoznam produktov</h2>
                <p><?= count($products) ?> záznamov v databáze</p>
            </div>
        </div>

        <?php if ($products === []) : ?>
            <div class="empty-table-state">
                <div class="empty-table-icon">◇</div>
                <h3>Zatiaľ tu nie sú žiadne produkty</h3>
                <p>Pridajte prvý produkt a zobrazí sa v tomto zozname.</p>
                <a class="button button-primary" href="<?= $link->url('product.add') ?>">Pridať prvý produkt</a>
            </div>
        <?php else : ?>
            <div class="table-responsive">
                <table class="product-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Produkt</th>
                        <th>Kategória</th>
                        <th>Cena</th>
                        <th>Veľkosť / farba</th>
                        <th>Sklad</th>
                        <th>Akcie</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <td data-label="ID"><span class="id-chip">#<?= $product->getId() ?></span></td>
                            <td data-label="Produkt">
                                <strong><?= $escape($product->getName()) ?></strong>
                                <small class="table-description"><?= $escape($product->getDescription()) ?></small>
                            </td>
                            <td data-label="Kategória"><?= $escape($product->getCategory()) ?></td>
                            <td data-label="Cena"><strong><?= number_format((float)$product->getPrice(), 2, ',', ' ') ?> €</strong></td>
                            <td data-label="Veľkosť / farba"><?= $escape($product->getSize()) ?> · <?= $escape($product->getColor()) ?></td>
                            <td data-label="Sklad"><span class="stock-badge"><?= (int)$product->getStockQuantity() ?> ks</span></td>
                            <td data-label="Akcie">
                                <div class="row-actions">
                                    <a class="button button-small button-secondary" href="<?= $link->url('product.edit', ['id' => $product->getId()]) ?>">Upraviť</a>
                                    <form method="post" action="<?= $link->url('product.delete') ?>" class="inline-form">
                                        <input type="hidden" name="id" value="<?= $product->getId() ?>">
                                        <button class="button button-small button-danger" type="submit">Zmazať</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </section>
</div>
