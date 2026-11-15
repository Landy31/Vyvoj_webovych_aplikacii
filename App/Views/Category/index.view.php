<?php
/** @var array<int, array{category: \App\Models\Category, products: array}> $categoryRows */
/** @var \Framework\Support\LinkGenerator $link */
$escape = static fn($value): string => htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
?>
<div class="crud-page">
    <div class="crud-heading">
        <div>
            <p class="eyebrow">SPRÁVA OBCHODU</p>
            <h1>Kategórie</h1>
            <p class="page-description">Spravujte kategórie a produkty, ktoré do nich patria.</p>
        </div>
        <a class="button button-primary" href="<?= $link->url('category.add') ?>">＋ Pridať kategóriu</a>
    </div>

    <section class="crud-card" aria-labelledby="category-list-title">
        <div class="crud-card-heading">
            <div>
                <h2 id="category-list-title">Zoznam kategórií</h2>
                <p><?= count($categoryRows) ?> kategórií v databáze · vzťah 1:N s produktmi</p>
            </div>
        </div>

        <?php if ($categoryRows === []) : ?>
            <div class="empty-table-state">
                <div class="empty-table-icon">▦</div>
                <h3>Zatiaľ tu nie sú žiadne kategórie</h3>
                <p>Vytvorte kategóriu a priraďte k nej existujúce produkty.</p>
                <a class="button button-primary" href="<?= $link->url('category.add') ?>">Pridať prvú kategóriu</a>
            </div>
        <?php else : ?>
            <div class="table-responsive">
                <table class="product-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kategória</th>
                        <th>Popis</th>
                        <th>Prepojené produkty</th>
                        <th>Akcie</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($categoryRows as $row) : ?>
                        <?php $category = $row['category']; $products = $row['products']; ?>
                        <tr>
                            <td data-label="ID"><span class="id-chip">#<?= (int)$category->getId() ?></span></td>
                            <td data-label="Kategória"><strong><?= $escape($category->getName()) ?></strong></td>
                            <td data-label="Popis"><?= $escape($category->getDescription()) ?></td>
                            <td data-label="Prepojené produkty">
                                <div class="linked-products">
                                    <?php if ($products === []) : ?>
                                        <span class="muted-text">Žiadne produkty</span>
                                    <?php else : ?>
                                        <?php foreach ($products as $product) : ?>
                                            <a class="linked-product-chip" href="<?= $link->url('product.edit', ['id' => $product->getId()]) ?>"><?= $escape($product->getName()) ?></a>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td data-label="Akcie">
                                <div class="row-actions">
                                    <a class="button button-small button-secondary" href="<?= $link->url('category.edit', ['id' => $category->getId()]) ?>">Upraviť</a>
                                    <form method="post" action="<?= $link->url('category.delete') ?>" class="inline-form">
                                        <input type="hidden" name="id" value="<?= (int)$category->getId() ?>">
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
