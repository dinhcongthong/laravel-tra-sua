<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Setting\PaymentMethod\PaymentMethodRepositoryInterface;
use App\Http\Traits\ImageUpload;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    use ImageUpload;

    const STATUS_LIST = [
        'active' => 'Áp dụng',
        'inactive' => 'Không áp dụng'
    ];

    private $paymentMethodRepository;

    public function __construct(PaymentMethodRepositoryInterface $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    public function index(Request $request) {
        $search = $request->search;
        $paymentMethods = $this->paymentMethodRepository->getAllBySearchData($search);
        return view('admin.setting.payment.index', ['paymentMethods' => $paymentMethods]);
    }

    public function getUpdate($id = 0) {
        $paymentMethod = $this->paymentMethodRepository->find($id);
        return view('admin.setting.payment.update', ['paymentMethod' => $paymentMethod, 'statuses' => self::STATUS_LIST]);
    }

    public function postUpdate(Request $request) {
        $id = $request->payment_method_id ?? 0;
        $paymentMethod = $this->paymentMethodRepository->find($id);
        $data = [
            'name' => $request->name,
            'status' => $request->status,
            'note' => $request->note,
        ];
        $galleryId = optional($paymentMethod)->gallery_id;
        $oldGalleryId = optional($paymentMethod)->gallery_id;
        if ($request->hasFile('payment_img')) {
            $image = $request->file('payment_img');
            $galleryId = $this->gallerySaveImageDir($image, config('filesystems.destination.payment_method'))->id;
        }
        $data['gallery_id'] = $galleryId ?? $paymentMethod->gallery_id;
        if (!is_null($paymentMethod)) {
            $paymentMethod->update($data);
            if ($oldGalleryId != $galleryId) {
                $this->deleteOldGallery($oldGalleryId);
            }
        } else {
            $this->paymentMethodRepository->create($data);
        }
        return redirect()->route('admin.settings.payment.index')->with('message', 'Bạn vừa mới cập nhật phương thức thanh toán thành công!');
    }
}
