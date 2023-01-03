<?php
namespace App\Http\Repositories\Member;

use App\Http\Repositories\RepositoryInterface;

interface MemberRepositoryInterface extends RepositoryInterface
{
    public function getModel();
}
