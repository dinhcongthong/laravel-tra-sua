<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Setting\System\SystemRepositoryInterface;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    private $systemRepository;

    public function __construct(SystemRepositoryInterface $systemRepository)
    {
        $this->systemRepository = $systemRepository;
    }

    public function index () {
        return 'day la system setting';
    }

    public function getUpdate($id = 0) {
        return $id;
    }

    public function postUpdate(Request $request) {
        return $request->all();
    }
}
