<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {

    }

    public function update(Request $request, $id = 0) {
        return $request->all();
    }

    public function delete($id) {
        return $id;
    }
}
