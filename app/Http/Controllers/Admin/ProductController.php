<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Repositories\Product\ProductRepositoryInterface;
use App\Http\Repositories\Store\StoreRepositoryInterface;
use App\Http\Traits\ImageUpload;
use Illuminate\Http\Request;
use Weidner\Goutte\GoutteFacade;

class ProductController extends Controller
{
    use ImageUpload;

    const ACTIVE_STATUS = 1;
    const INACTIVE_STATUS = 0;

    private $productRepository;

    private $storeRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        StoreRepositoryInterface $storeRepository
    ) {
        $this->productRepository = $productRepository;
        $this->storeRepository = $storeRepository;
    }

    public function index()
    {
        return view('admin.product.index');
    }

    public function getUpdateFromStore($storeId = 0, Request $request)
    {
        return $request->all();
        $store = $this->storeRepository->find($storeId);
        // $product = $this->productRepository->find($productId);
        // return view('admin.product.update', ['store' => $store, 'product' => $product]);
    }

    public function postUpdate(Request $request)
    {
        return $request->all();
    }

    public function getCrawler ($storeId, Request $request) {
        $store = $this->storeRepository->getProducts($storeId);
        $products = $this->productRepository->getByStore($storeId);
        return view('admin.product.crawler', ['store' => $store, 'products' => $products]);
    }

    public function postCrawler (Request $request) {
        $crawlUrl = $request->crawl_url;
        $crawler = GoutteFacade::request('GET', $crawlUrl);

        $crawler->filter('div.product-item')->each(function ($node) use ($request) {
            $imageUrl = $node->filter('a.item-wrapper img')->attr('data-original');
            $galleryId = $this->gallerySaveImageUrl($imageUrl)->id;
            $crawlId = null;
            if ($node->filter('div.item-info button.add-to-cart')->count()) {
                $crawlId = $node->filter('div.item-info button.add-to-cart')->attr('data-id');
            }
            $data = [
                'name' => $node->filter('div.item-name')->text(),
                'store_id' => $request->store_id,
                'crawl_id' => $crawlId,
                'price' => $node->filter('div.item-price')->text(),
                'description' => $node->filter('div.item-desc')->text(),
                'gallery_id' => $galleryId,
                'product_status_id' => self::ACTIVE_STATUS
            ];
            $this->productRepository->create($data);
        });

        return redirect()->route('admin.products.get_crawler', $request->store_id);
    }

    public function delete ($productId) {
        $product = $this->productRepository->findOrFail($productId);
        $product->delete();
        return true;
    }
}
