<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller {
    public $model = 'App\Models\BaseModel';
    public function index() {
        $listModel = $this->model::where('status', '<>', '0')->get();
        return $listModel;
    }

    public function store(Request $request, $validate = true) {
        if ($validate) {
            $request->validate($this->model::getRule());
        }
        $this->model::create($request->all());
        return true;
    }

    public function show($id) {
        $model = $this->model::find($id);
        if (!$model) {
            $model = new $this->model();
        }
        return $model;
    }

    public function update(Request $request, $id, $validate = true) {
        if ($validate) {
            $request->validate($this->model::getRule());
        }
        $model = $this->model::find($id);
        $model->update($request->all());
        return $model;
    }

    public function destroy($id) {
        $model = $this->model::find($id);
        $model->update(['status' => '0']);
        return true;
    }

    public function delete($model, $id) {
        $this->model = 'App\Models\\' . $model;
        $this->destroy($id);
        return response()->json(['msg' => 'Xóa thành công']);
    }
}
