<?php

namespace App\Http\Repositories\Setting\PaymentMethod;

use App\Models\PaymentMethod;
use App\Http\Repositories\BaseRepository;

class PaymentMethodRepository extends BaseRepository implements PaymentMethodRepositoryInterface {
    public function __construct () {
        parent::__construct();
    }

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return PaymentMethod::class;
    }
}
