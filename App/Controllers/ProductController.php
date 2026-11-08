<?php

namespace App\Controllers;

use App\Models\Product;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/** CRUD actions for products, implemented with the built-in Vaííčko ORM. */
class ProductController extends BaseController
{
    public function index(Request $request): Response
    {
        $products = Product::getAll(orderBy: '`id` DESC');
        return $this->html(['products' => $products]);
    }

    public function add(Request $request): Response
    {
        return $this->html(['product' => new Product(), 'errors' => []], 'form');
    }

    public function edit(Request $request): Response
    {
        $product = $this->getProductOr404((int)$request->value('id'));
        return $this->html(['product' => $product, 'errors' => []], 'form');
    }

    /** Create or update a product. Uses POST/Redirect/GET. */
    public function save(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new HttpException(405);
        }

        $id = (int)$request->post('id');
        $product = $id > 0 ? $this->getProductOr404($id) : new Product();

        $name = trim((string)$request->post('name'));
        $category = trim((string)$request->post('category'));
        $description = trim((string)$request->post('description'));
        $priceInput = str_replace(',', '.', trim((string)$request->post('price')));
        $size = trim((string)$request->post('size'));
        $color = trim((string)$request->post('color'));
        $stockInput = trim((string)$request->post('stockQuantity'));

        $product->setName($name);
        $product->setCategory($category);
        $product->setDescription($description);
        $product->setPrice($priceInput !== '' ? $priceInput : '0.00');
        $product->setSize($size);
        $product->setColor($color);
        $product->setStockQuantity(ctype_digit($stockInput) ? (int)$stockInput : 0);

        $errors = [];
        if ($name === '') {
            $errors[] = 'Názov produktu je povinný.';
        }
        if ($category === '') {
            $errors[] = 'Vyberte kategóriu produktu.';
        }
        if ($description === '') {
            $errors[] = 'Popis produktu je povinný.';
        }
        if ($size === '') {
            $errors[] = 'Vyberte veľkosť produktu.';
        }
        if ($color === '') {
            $errors[] = 'Vyberte farbu produktu.';
        }
        if (!is_numeric($priceInput) || (float)$priceInput < 0) {
            $errors[] = 'Cena musí byť nezáporné číslo.';
        }
        if ($stockInput === '' || !ctype_digit($stockInput)) {
            $errors[] = 'Skladové množstvo musí byť celé nezáporné číslo.';
        }

        if ($errors !== []) {
            return $this->html(['product' => $product, 'errors' => $errors], 'form');
        }

        $product->save();
        return $this->redirect($this->url('product.index'))->setStatusCode(303);
    }

    /** Delete a product. Deletion is only allowed through POST. */
    public function delete(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new HttpException(405);
        }

        $product = $this->getProductOr404((int)$request->post('id'));
        $product->delete();

        return $this->redirect($this->url('product.index'))->setStatusCode(303);
    }

    private function getProductOr404(int $id): Product
    {
        $product = Product::getOne($id);
        if ($product === null) {
            throw new HttpException(404);
        }
        return $product;
    }
}
