<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Setting\PaymentMethod\PaymentMethodRepositoryInterface;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    private $paymentMethodRepository;

    public function __construct(PaymentMethodRepositoryInterface $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    public function index() {
        return 'day la payment method setting';
    }

    public function getUpdate($id = 0) {
        return $id;
    }

    public function postUpdate(Request $request) {
        return $request->all();
    }
}
