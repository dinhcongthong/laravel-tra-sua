<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Member\MemberRepositoryInterface;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    private $memberRepository;

    public function __construct(MemberRepositoryInterface $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    public function index () {

    }

    public function update (Request $request) {

    }
}
