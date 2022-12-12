<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Option\OptionCategoryRepositoryInterface;
use App\Http\Repositories\Option\OptionRepositoryInterface;
use App\Http\Repositories\ProductOption\ProductOptionRepositoryInterface;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    private $optionRepository;

    private $optionCategoryRepository;

    private $productOptionRepository;

    public function __construct(
        OptionRepositoryInterface $optionRepository,
        OptionCategoryRepositoryInterface $optionCategoryRepository,
        ProductOptionRepositoryInterface  $productOptionRepository
    )
    {
        $this->optionRepository = $optionRepository;
        $this->optionCategoryRepository = $optionCategoryRepository;
        $this->productOptionRepository = $productOptionRepository;
    }

    public function index () {
        $optionCategory = $this->optionCategoryRepository->getAll();
        return view('admin.option.index', ['optionCategory' => $optionCategory]);
    }

    public function postOptionCategory ($id, Request $request) {
        return $this->postUpdate($id, $request, $this->optionCategoryRepository);
    }

    public function postOption ($id, Request $request) {
        return $this->postUpdate($id, $request, $this->optionRepository);

    }

    private function postUpdate($id, Request $request, $repository) {
        $Object = $repository->findOrFail($id);
        $Object->name = $request->name;
        $Object->save();
        return \sendResponse($Object, 'thanhcong');
    }

    public function getOptionContent($optionCategoryId, $productId) {
        $result = $this->optionRepository->getOptionContent($optionCategoryId, $productId);

        return sendResponse(compact('result'), 'Thành công!');
    }

    // Đang sai đừng lưu
    public function postOptionContent (Request $request, $productId) {
        foreach ($request->price as $key => $item) {
            if (!is_null($item)) {
                $data = [];
                $data['product_id'] = $productId;
                $data['price'] = $item;
                $data['option_id'] = $request->id[$key];
                $this->productOptionRepository->updateOrCreate($data, $data);
            }
        }
        return sendResponse($data, 'Thành công!');
    }
}
