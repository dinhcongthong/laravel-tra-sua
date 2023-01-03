<?php

namespace App\Http\Repositories\Member;

use App\Models\User;
use App\Http\Repositories\BaseRepository;

class MemberRepository extends BaseRepository implements MemberRepositoryInterface {
    public function __construct () {
        parent::__construct();
    }

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }
}
