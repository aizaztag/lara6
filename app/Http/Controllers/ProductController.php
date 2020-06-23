<?php

namespace App\Http\Controllers;

use App\Contract\ProductContract;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    protected $productRepository;

    public function __construct(ProductContract $productRepository)
    {
          $this->productRepository = $productRepository;
    }

    public function index()
    {
        $product  = $this->productRepository->find(0);
        if(!$product) $this->showErrorPage(404 , 'page not found');
        dd($product);

    }

    public function edit($id)
    {
        $product = $this->productRepository->findProductById($id);
        if(!$product) $this->showErrorPage(404 , 'page not found');
        //echo '<pre>' ; print_r($product); die;
        $this->setPageTitle('Products', 'Edit Product');
        return view('products.edit', compact('product'));
    }
}
