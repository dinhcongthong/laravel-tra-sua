<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Option\OptionCategoryRepositoryInterface;
use App\Http\Repositories\Option\OptionRepositoryInterface;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    private $optionRepository;

    private $optionCategoryRepository;

    public function __construct(
        OptionRepositoryInterface $optionRepository,
        OptionCategoryRepositoryInterface $optionCategoryRepository
    )
    {
        $this->optionRepository = $optionRepository;
        $this->optionCategoryRepository = $optionCategoryRepository;
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
        return sendResponse(compact('optionCategoryId', 'productId'), 'thanh cong');
    }
}
