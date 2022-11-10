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

    public function getAllBySearchData($searchData) {
        return $this->model->with(['getImage'])
            ->where('name', 'like', '%' . $searchData . '%')
            ->orWhere('created_at', 'like', '%' . $searchData . '%')
            ->orWhere('updated_at', 'like', '%' . $searchData . '%')
            ->paginate(15);
    }

    public function getActiveItems () {
        return $this->model->with(['getImage:id,name,url'])->whereStatus('active')->get(['id', 'name', 'status', 'gallery_id', 'note']);
    }
}
