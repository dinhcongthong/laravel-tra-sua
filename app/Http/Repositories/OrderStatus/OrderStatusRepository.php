<?php

namespace App\Http\Repositories\OrderStatus;

use App\Http\Repositories\BaseRepository;;
use App\Models\OrderStatus;

class OrderStatusRepository extends BaseRepository implements OrderStatusRepositoryInterface {
    public function __construct () {
        parent::__construct();
    }

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return OrderStatus::class;
    }
}
