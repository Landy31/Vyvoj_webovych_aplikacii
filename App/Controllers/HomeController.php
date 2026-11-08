<?php

namespace App\Controllers;

use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/** Main dashboard controller. */
class HomeController extends BaseController
{
    public function authorize(Request $request, string $action): bool
    {
        return true;
    }

    public function index(Request $request): Response
    {
        return $this->html();
    }

    /** Keep the previous URL working, but send users to the real product form. */
    public function addProduct(Request $request): Response
    {
        return $this->redirect($this->url('product.add'));
    }
}
