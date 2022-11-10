<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Setting\PaymentMethod\PaymentMethodRepositoryInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $paymentMethodRepository;

    public function __construct(
        PaymentMethodRepositoryInterface $paymentMethodRepository
    ) {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    public function getPaymentMethodActive() {
        $paymentMethod = $this->paymentMethodRepository->getActiveItems();
        return sendResponse($paymentMethod, 'Thành công');
    }
}
