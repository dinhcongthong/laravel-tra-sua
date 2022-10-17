<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Weidner\Goutte\GoutteFacade;

class ProductController extends Controller
{
    private $productRepositoryInterface;

    public function __construct (ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    public function index()
    {
        return view('admin.product.index');
    }

    public function createFromStore (Request $request) {
        return $request->all();
    }

    public function update (Request $request) {
        return $request->all();
        $crawler = GoutteFacade::request('GET', 'https://phuclong.com.vn/category/thuc-uong');

        $nameArr = $crawler->filter('div.item-name')->each(function ($node) {
            return $node->text();
        });

        $priceArr = $crawler->filter('div.item-price')->each(function ($node) {
            return $node->text();
        });
        $desArr = $crawler->filter('div.item-desc')->each(function ($node) {
            return $node->text();
        });
        $imgArr = $crawler->filter('div.product-item')->each(function ($node) {
            return $node->filter('a.item-wrapper img')->attr('data-original');
        });

        $products = [];
        foreach ($nameArr as $key => $name) {
            $products[$key]['name'] = $name;
            $products[$key]['price'] = $priceArr[$key];
            $products[$key]['description'] = $desArr[$key];
            $products[$key]['image'] = $imgArr[$key];
        }

    }
}
