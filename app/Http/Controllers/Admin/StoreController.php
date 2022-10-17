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

    public function getUpdate($id = 0)
    {
        $storeStatus = $this->storeStatusRepository->getAll();
        $store = $this->storeRepository->find($id);
        return view('admin.store.update', ['store' => $store, 'storeStatus' => $storeStatus]);
    }
    public function postUpdate(StoreRequest $request, $id = 0)
    {
        $store = $this->storeRepository->find($id);
        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'note' => $request->note,
            'store_status_id' => $request->store_status_id,
        ];
        $galleryId = optional($store)->gallery_id;
        if ($request->hasFile('store_img')) {
            $image = $request->file('store_img');
            $galleryId = $this->gallerySaveImageDir($image, config('filesystems.destination.store'));
            if (!is_null($store)) {
                dd(2342);
                $this->deleteOldGallery($store->gallery_id, config('filesystems.destination.store'));
            }
        } else if (!$request->hasFile('store_img') && is_null($store)) {
            return back()->withInput()->withErrors(['errors' => 'Vui long nhap hinh anh']);
        }
        $data['gallery_id'] = $galleryId ?? $store->gallery_id;
        $result = !is_null($store) ? $store->update($data) : $this->storeRepository->create($data);
        if ($result)
            return redirect()->route('admin.stores.index')->with(['status' => 'Ban vua moi cap nhat cua hang thanh cong']);
        return redirect()->back()->withInput()->withErrors(['errors' => 'Co loi trong qua trinh xu ly.']);
    }

    public function delete ($id) {
        $this->storeRepository->delete($id);
        return redirect()->route('admin.stores.index')->with(['status' => 'Ban vua moi xoa thanh cong 1 cua hang!']);
    }
}
