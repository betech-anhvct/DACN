<?php

namespace App\Http\Controllers;

use App\Models\Vouchers;
use Illuminate\Http\Request;

class VoucherController extends BaseController {
    public $model = Vouchers::class;
    public function getVoucher() {
        $vouchers = $this->index();
        return view('adminPage.voucher', compact('vouchers'));
    }

    public function updateVoucher(Request $request, $id) {
        $request->validate(['code' => ['unique:vouchers,code,' . $id]], $this->model::getRuleTrans());
        $voucher = $this->update($request, $id);
        $isSuccess = true;
        $vouchers = Vouchers::where('status', 1)->get();
        return view('adminPage.voucherEdit', compact('voucher', 'vouchers', 'isSuccess'));
    }

    public function showVoucher($id) {
        $voucher = $this->show($id);
        $vouchers = Vouchers::where('status', 1)->get();
        return view('adminPage.voucherEdit', compact('voucher', 'vouchers'));
    }

    public function createVoucher() {
        $voucher = $this->show(0);
        $vouchers = Vouchers::where('status', 1)->get();
        return view('adminPage.voucherEdit', compact('voucher', 'vouchers'));
    }

    public function storeVoucher(Request $request) {
        $this->store($request);
        $vouchers = $this->index();
        return redirect('/admin/voucher');
    }
}
