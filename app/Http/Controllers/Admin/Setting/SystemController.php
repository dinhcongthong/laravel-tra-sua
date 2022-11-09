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

    public function index (Request $request) {
        $data = $request->except('_token');
        $system = $this->systemRepository->first();
        if ($request->isMethod('POST')) {
            $data['status'] = $request->status ?? 0;
            $this->systemRepository->update($system->id, $data);
            return redirect()->back();
        }

        return view('admin.setting.system.index', [
            'system' => $system
        ]);
    }

    public function getUpdate($id = 0) {
        return $id;
    }

    public function postUpdate(Request $request) {
        return $request->all();
    }
}
