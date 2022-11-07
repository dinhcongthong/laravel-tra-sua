<?php

namespace App\Http\Controllers\Admin\Store;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Store\StoreRepositoryInterface;
use App\Http\Repositories\StoreStatus\StoreStatusRepositoryInterface;
use App\Http\Requests\StoreRequest;
use App\Http\Traits\ImageUpload;
use Illuminate\Http\Request;

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

    public function index(Request $request)
    {
        $searchData = $request->search;
        $data = $this->storeRepository->getAllBySearchData($searchData);
        return view('admin.store.index', ['stores' => $data]);
    }

    public function getUpdate($id = 0)
    {
        $storeStatus = $this->storeStatusRepository->getAll();
        $store = $this->storeRepository->find($id);
        return view('admin.store.update', ['store' => $store, 'storeStatus' => $storeStatus]);
    }
    public function postUpdate(StoreRequest $request)
    {
        $id = $request->store_id ?? 0;
        $store = $this->storeRepository->find($id);
        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'note' => $request->note,
            'store_status_id' => $request->store_status_id,
        ];
        $galleryId = optional($store)->gallery_id;
        $oldGalleryId = optional($store)->gallery_id;
        if ($request->hasFile('store_img')) {
            $image = $request->file('store_img');
            $galleryId = $this->gallerySaveImageDir($image, config('filesystems.destination.store'))->id;
        }
        $data['gallery_id'] = $galleryId ?? $store->gallery_id;
        if (!is_null($store)) {
            $store->update($data);
            if ($oldGalleryId != $galleryId) {
                $this->deleteOldGallery($oldGalleryId, config('filesystems.destination.store'));
            }
        } else {
            $this->storeRepository->create($data);
        }
        return redirect()->route('admin.stores.index')->with('message', 'Ban vua moi cap nhat cua hang thanh cong!');
    }

    public function delete ($id) {
        $this->storeRepository->delete($id);
        return redirect()->route('admin.stores.index')->with(['status' => 'Ban vua moi xoa thanh cong 1 cua hang!']);
    }
}
