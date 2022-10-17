<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Store\StoreRepositoryInterface;
use App\Http\Repositories\StoreStatus\StoreStatusRepositoryInterface;
use App\Http\Requests\Admin\StoreRequest;
use App\Http\Traits\ImageUpload;

class StoreController extends Controller
{
    use ImageUpload;

    private $storeRepository;

    private $storeStatusRepository;

    public function __construct(
        StoreRepositoryInterface $storeRepository,
        StoreStatusRepositoryInterface $storeStatusRepository
    ) {
        $this->storeRepository = $storeRepository;
        $this->storeStatusRepository = $storeStatusRepository;
    }

    public function index()
    {
        $data = $this->storeRepository->getAll();
        return view('admin.store.index', ['stores' => $data]);
    }

    public function update(StoreRequest $request, $id = 0)
    {
        $galleryId = null;
        if ($request->hasFile('store_img')) {
            $image = $request->file('store_img');
            $galleryId = $this->gallerySaveImageDir($image, config('filesystems.destination.store'));
        }
        $storeStatus = $this->storeStatusRepository->getAll();
        $store = $this->storeRepository->find($id);
        if (is_null($store)) {
            $store = $this->storeRepository->initStore();
        }
        $store->name            = $request->name ?? $store->name;
        $store->address         = $request->address ?? $store->address;
        $store->note            = $request->note ?? $store->note;
        $store->store_status_id = $request->store_status_id ?? $store->store_status_id;
        $store->gallery_id       = $galleryId ?? $store->gallery_id;
        if ($request->isMethod('POST')) {
            $store->save();
            return redirect()->route('admin.stores.index');
        }
        return view('admin.store.update', ['store' => $store, 'storeStatus' => $storeStatus]);
    }
}
