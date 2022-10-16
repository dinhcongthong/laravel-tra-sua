<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Store\StoreRepositoryInterface;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    private $storeRepository;

    public function __construct(StoreRepositoryInterface $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function index () {
        $data = $this->storeRepository->getAll();
        return view('admin.store.index', ['stores' => $data]);
    }

    public function update(Request $request, $id = 0) {
        $store = $this->storeRepository->find($id);
        if (is_null($store)) {
            $store = $this->storeRepository->initStore();
        }
        return view('admin.store.update', ['store' => $store]);
    }
}
