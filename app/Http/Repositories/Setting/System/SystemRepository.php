<?php

namespace App\Http\Repositories\Setting\System;

use App\Models\System;
use App\Http\Repositories\BaseRepository;

class SystemRepository extends BaseRepository implements SystemRepositoryInterface {
    public function __construct () {
        parent::__construct();
    }

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return System::class;
    }
}
