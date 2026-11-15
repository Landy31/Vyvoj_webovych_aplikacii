<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/** CRUD for categories, including assigning Products in the 1:N relationship. */
class CategoryController extends BaseController
{
    public function authorize(Request $request, string $action): bool
    {
        return true;
    }

    public function index(Request $request): Response
    {
        $categories = Category::getAll(orderBy: '`name` ASC');
        $categoryRows = [];

        foreach ($categories as $category) {
            // Category::getAllRelated(Product::class) follows products.categoryId.
            $categoryRows[] = [
                'category' => $category,
                'products' => $category->getAllRelated(Product::class),
            ];
        }

        return $this->html(['categoryRows' => $categoryRows]);
    }

    public function add(Request $request): Response
    {
        return $this->html([
            'category' => new Category(),
            'products' => Product::getAll(orderBy: '`name` ASC'),
            'selectedProductIds' => [],
            'errors' => [],
        ], 'form');
    }

    public function edit(Request $request): Response
    {
        $category = $this->getCategoryOr404((int)$request->value('id'));
        $relatedProducts = $category->getAllRelated(Product::class);
        $selectedProductIds = array_map(
            static fn(Product $product): int => (int)$product->getId(),
            $relatedProducts
        );

        return $this->html([
            'category' => $category,
            'products' => Product::getAll(orderBy: '`name` ASC'),
            'selectedProductIds' => $selectedProductIds,
            'errors' => [],
        ], 'form');
    }

    /** Save the category and update the products.categoryId relationships. */
    public function save(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new HttpException(405);
        }

        $id = (int)$request->post('id');
        $category = $id > 0 ? $this->getCategoryOr404($id) : new Category();
        $name = trim((string)$request->post('name'));
        $description = trim((string)$request->post('description'));
        $rawProductIds = $request->post('productIds');
        $selectedProductIds = is_array($rawProductIds)
            ? array_values(array_unique(array_filter(array_map('intval', $rawProductIds), static fn(int $value): bool => $value > 0)))
            : [];

        $category->setName($name);
        $category->setDescription($description);

        $errors = [];
        if ($name === '') {
            $errors[] = 'Názov kategórie je povinný.';
        }

        if ($errors !== []) {
            return $this->html([
                'category' => $category,
                'products' => Product::getAll(orderBy: '`name` ASC'),
                'selectedProductIds' => $selectedProductIds,
                'errors' => $errors,
            ], 'form');
        }

        $category->save();
        $categoryId = (int)$category->getId();

        // Only update rows whose assignment changes. A selected product is moved
        // from its previous category to this one; unchecked products in this
        // category become unassigned (categoryId = NULL).
        foreach (Product::getAll(orderBy: '`id` ASC') as $product) {
            $isSelected = in_array((int)$product->getId(), $selectedProductIds, true);
            $belongsHere = $product->getCategoryId() === $categoryId;

            if ($isSelected && !$belongsHere) {
                $product->setCategoryId($categoryId);
                $product->save();
            } elseif (!$isSelected && $belongsHere) {
                $product->setCategoryId(null);
                $product->save();
            }
        }

        return $this->redirect($this->url('category.index'))->setStatusCode(303);
    }

    /** The database FK uses ON DELETE SET NULL, so linked products are preserved. */
    public function delete(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new HttpException(405);
        }

        $category = $this->getCategoryOr404((int)$request->post('id'));
        $category->delete();
        return $this->redirect($this->url('category.index'))->setStatusCode(303);
    }

    private function getCategoryOr404(int $id): Category
    {
        $category = Category::getOne($id);
        if ($category === null) {
            throw new HttpException(404);
        }
        return $category;
    }
}
