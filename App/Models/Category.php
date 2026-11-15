<?php

namespace App\Models;

use Framework\Core\Model;

/** Category entity. One category can be related to many products through products.categoryId. */
class Category extends Model
{
    protected static ?string $tableName = 'categories';

    protected static ?array $fillable = ['name', 'description'];

    protected ?int $id = null;
    protected ?string $name = null;
    protected ?string $description = null;

    public function getId(): ?int { return $this->id; }
    public function getName(): ?string { return $this->name; }
    public function getDescription(): ?string { return $this->description; }

    public function setName(string $name): void { $this->name = $name; }
    public function setDescription(string $description): void { $this->description = $description; }
}
