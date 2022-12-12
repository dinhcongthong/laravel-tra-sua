<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Option\OptionCategoryRepositoryInterface;
use App\Http\Repositories\Product\ProductRepositoryInterface;
use App\Http\Repositories\ProductStatus\ProductStatusRepository;
use App\Http\Repositories\Store\StoreRepositoryInterface;
use App\Http\Requests\ProductRequest;
use App\Http\Traits\ImageUpload;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ImageUpload;

    private $productRepository;

    private $storeRepository;

    private $productStatusRepository;

    private $optionCategoryRepository;


    public function __construct(
        ProductRepositoryInterface $productRepository,
        StoreRepositoryInterface $storeRepository,
        ProductStatusRepository $productStatusRepository,
        OptionCategoryRepositoryInterface $optionCategoryRepository
    ) {
        $this->productRepository = $productRepository;
        $this->storeRepository = $storeRepository;
        $this->productStatusRepository = $productStatusRepository;
        $this->optionCategoryRepository = $optionCategoryRepository;
    }

    public function index(Request $request)
    {
        $products = $this->productRepository->getAllBySearchData($request->search);
        return view('admin.product.index', ['products' => $products]);
    }

    public function getUpdateFromStore($storeId, $productId = 0)
    {
        $store = $this->storeRepository->findOrFail($storeId);
        $product = $this->productRepository->findDetail($productId);
        $productStatus = $this->productStatusRepository->getAll();
        $optionCategories = $this->optionCategoryRepository->getAll();

        return view('admin.product.update', compact(
            'store',
            'product',
            'productStatus',
            'optionCategories'
        ));
    }

    public function postUpdate(ProductRequest $request)
    {
        return $request->all();
        $id = $request->product_id ?? 0;
        $product = $this->productRepository->find($id);
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'product_status_id' => $request->product_status_id,
            'crawl_id' => $request->crawl_id,
            'store_id' => $request->store_id
        ];
        $galleryId = optional($product)->gallery_id;
        $oldGalleryId = optional($product)->gallery_id;
        if ($request->hasFile('product_img')) {
            $image = $request->file('product_img');
            $galleryId = $this->gallerySaveImageDir($image, config('filesystems.destination.product'))->id;
        }
        $data['gallery_id'] = $galleryId ?? $product->gallery_id;
        if (!is_null($product)) {
            $product->update($data);
            if ($oldGalleryId != $galleryId) {
                $this->deleteOldGallery($oldGalleryId, config('filesystems.destination.product'));
            }
        } else {
            $this->productRepository->create($data);
        }
        return redirect()->back()->with('message', 'San pham cua ban da duoc cap nhat thanh cong!');
    }

    public function delete ($productId) {
        $product = $this->productRepository->findOrFail($productId);
        $product->delete();
        return true;
    }
}
