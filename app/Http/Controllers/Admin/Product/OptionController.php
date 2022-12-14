<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Option\OptionCategoryRepositoryInterface;
use App\Http\Repositories\Option\OptionRepositoryInterface;
use App\Http\Repositories\ProductOption\ProductOptionRepositoryInterface;
use App\Models\Option;
use App\Models\ProductOption;
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
    ) {
        $this->optionRepository = $optionRepository;
        $this->optionCategoryRepository = $optionCategoryRepository;
        $this->productOptionRepository = $productOptionRepository;
    }

    public function index()
    {
        $optionCategory = $this->optionCategoryRepository->getAll();
        return view('admin.option.index', ['optionCategory' => $optionCategory]);
    }

    public function postOptionCategory($id = 0, Request $request)
    {
        return $this->postUpdate($id, $request, $this->optionCategoryRepository);
    }

    public function postNewOption (Request $request) {
        $data = $request->except('_token');
        return sendResponse(compact('data'), 'Thành công!');
    }

    public function postUpdateOption($id = 0, Request $request)
    {
        return $this->postUpdate($id, $request, $this->optionRepository);
    }

    private function postUpdate($id, Request $request, $repository)
    {
        $Object = $repository->findOrNew($id);
        $Object->name = $request->name;
        $Object->save();
        return \sendResponse($Object, 'thanhcong');
    }

    public function getOptionContent($optionCategoryId, $productId)
    {
        $result = $this->optionRepository->getOptionContent($optionCategoryId, $productId);

        return sendResponse(compact('result'), 'Thành công!');
    }

    public function postOptionContent(Request $request, $productId)
    {
        foreach ($request->price as $key => $item) {
            if (!is_null($item)) {
                $data = [];
                $data['product_id'] = $productId;
                $data['price'] = $item;
                $data['option_id'] = $request->id[$key];
                $this->productOptionRepository->updateOrCreate([
                    'product_id' => $productId,
                    'option_id' => $request->id[$key]
                ], $data);
            }
        }
        return sendResponse($data, 'Thành công!');
    }

    public function categoryDelete ($categoryId) {
        $optionIds = $this->optionRepository->getIdsByCategory($categoryId);

        if (!empty($optionIds)) {
            $this->optionDelete($optionIds);
        }
        $this->optionCategoryRepository->delete($categoryId);
        return sendResponse(compact('categoryId'), 'Thành công!');
    }

    public function optionDelete (array $optionIds) {
        try {
            foreach ($optionIds as $optionId) {
                $this->productOptionRepository->deleteByOptionId($optionId);
                $this->optionRepository->delete($optionId);
            }
            return sendResponse([], 'Thành công');
        } catch (\Exception $e) {
            return sendResponse([$e->getMessage()], 'Thất bại');
        }
    }
}
