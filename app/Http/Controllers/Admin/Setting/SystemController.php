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

    public function index(Request $request)
    {
        $system = $this->systemRepository->first();
        if ($request->isMethod('POST')) {
            $data = $request->except('_token');
            $id = $system->id ?? 1;
            $this->systemRepository->updateOrCreate(
                [
                    'id' => $id
                ],
                $data
            );
            return redirect()->back();
        }

        return view('admin.setting.system.index', [
            'system' => $system
        ]);
    }
}
