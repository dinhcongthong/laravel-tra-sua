<?php

namespace App\Http\Controllers\Api;

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
        $system = $this->systemRepository->first();
        unset($system['created_at'], $system['updated_at']);
        return sendResponse($system, 'Thanh cong');
    }
}
