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

    public function optionCategoryIndex () {
        return 244;
    }

    public function index () {
        $optionCategory = $this->optionCategoryRepository->getAll();
        // return $optionCategory;
        return view('admin.option.index', ['optionCategory' => $optionCategory]);
    }

    public function postOption ($id, Request $request) {
        $optionCategory = $this->optionCategoryRepository->findOrFail($id);
        $optionCategory->name = $request->name;
        $optionCategory->save();
        return \sendResponse($optionCategory, 'thanhcong');
    }
}
