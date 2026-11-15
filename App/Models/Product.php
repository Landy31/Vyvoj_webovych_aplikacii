<?php

namespace App\Models;

use Framework\Core\Model;

/** Product entity related to Category by the categoryId foreign key. */
class Product extends Model
{
    protected static ?string $tableName = 'products';

    protected static ?array $fillable = [
        'categoryId',
        'name',
        'description',
        'price',
        'size',
        'color',
        'stockQuantity',
    ];

    protected ?int $id = null;
    protected ?int $categoryId = null;
    protected ?string $name = null;
    protected ?string $description = null;
    protected ?string $price = null;
    protected ?string $size = null;
    protected ?string $color = null;
    protected ?int $stockQuantity = null;

    public function getId(): ?int { return $this->id; }
    public function getCategoryId(): ?int { return $this->categoryId; }
    public function getName(): ?string { return $this->name; }
    public function getDescription(): ?string { return $this->description; }
    public function getPrice(): ?string { return $this->price; }
    public function getSize(): ?string { return $this->size; }
    public function getColor(): ?string { return $this->color; }
    public function getStockQuantity(): ?int { return $this->stockQuantity; }

    public function setCategoryId(?int $categoryId): void { $this->categoryId = $categoryId; }
    public function setName(string $name): void { $this->name = $name; }
    public function setDescription(string $description): void { $this->description = $description; }
    public function setPrice(string $price): void { $this->price = $price; }
    public function setSize(string $size): void { $this->size = $size; }
    public function setColor(string $color): void { $this->color = $color; }
    public function setStockQuantity(int $stockQuantity): void { $this->stockQuantity = $stockQuantity; }
}
