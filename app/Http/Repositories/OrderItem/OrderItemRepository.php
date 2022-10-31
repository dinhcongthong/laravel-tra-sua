<?php

namespace App\Http\Repositories\OrderItem;

use App\Models\OrderItem;
use App\Http\Repositories\BaseRepository;

class OrderItemRepository extends BaseRepository implements OrderItemRepositoryInterface {
    public function __construct () {
        parent::__construct();
    }

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return OrderItem::class;
    }
}
