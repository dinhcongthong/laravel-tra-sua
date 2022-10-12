<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Weidner\Goutte\GoutteFacade;

class ProductController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
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
        $imgArr = $crawler->filter('a.item-wrapper img')->each(function ($node) {
            return $node->attr("src");
        });
        dd($imgArr);

        $products = [];
        foreach ($nameArr as $key => $name) {
            $products[$key]['name'] = $name;
            $products[$key]['price'] = $priceArr[$key];
            $products[$key]['description'] = $desArr[$key];
            $products[$key]['image'] = $imgArr[$key];
        }
        return $products;
        dd($products);
        return 'this is test product controllersfsdfsds';
        return view('admin.product.index');
    }
}
