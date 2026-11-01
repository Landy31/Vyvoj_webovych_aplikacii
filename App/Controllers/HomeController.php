<?php

namespace App\Controllers;

use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/** Handles the two static E-Clothing administration pages. */
class HomeController extends BaseController
{
    /**
     * Both pages are public in this assignment; authentication is not required.
     */
    public function authorize(Request $request, string $action): bool
    {
        return true;
    }

    /** Displays the administration overview. URL: ?c=Home&a=index */
    public function index(Request $request): Response
    {
        return $this->html();
    }

    /** Displays the add-product form. URL: ?c=Home&a=addProduct */
    public function addProduct(Request $request): Response
    {
        return $this->html();
    }
}
