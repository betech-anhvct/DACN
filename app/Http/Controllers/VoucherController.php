<?php

namespace App\Http\Controllers;

use App\Models\Products;
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
        if (Vouchers::CONDITION_PRODUCT == $request->condition) {
            if ($request->product_list) {
                $product_list = implode(',', $request->product_list);
                $request->merge(['product_list' => $product_list]);
            }
        }
        $voucher = $this->update($request, $id);
        $isSuccess = true;
        $products = Products::where('status', 1)->get();
        return view('adminPage.voucherEdit', compact('voucher', 'products', 'isSuccess'));
    }

    public function showVoucher($id) {
        $voucher = $this->show($id);
        $products = Products::where('status', 1)->get();
        return view('adminPage.voucherEdit', compact('voucher', 'products'));
    }

    public function createVoucher() {
        $voucher = $this->show(0);
        $products = Products::where('status', 1)->get();
        return view('adminPage.voucherEdit', compact('voucher', 'products'));
    }

    public function storeVoucher(Request $request) {
        $this->store($request);
        $vouchers = $this->index();
        return redirect('/admin/voucher');
    }
}
