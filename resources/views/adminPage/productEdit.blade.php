@extends('masterAP')
@section('contentAP')
<div class="content-wrap">
  <div class="main">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
          <div class="page-header">
            <div class="page-title">
              <a href="{{ url('/admin/product') }}">
                <h1><button class="btn btn-primary">Danh sách sản phẩm</button></h1>
              </a>
            </div>
          </div>
        </div>
        <!-- /# column -->
        <div class="col-lg-4 p-l-0 title-margin-left">
          <div class="page-header">
            <div class="page-title">
              <ol class="breadcrumb">
              </ol>
            </div>
          </div>
        </div>
        <!-- /# column -->
      </div>
      <!-- /# row -->
      <section id="main-content">
        <div class="col">
          <div class="card">
            <div class="card-title">
              <h4>Chỉnh sửa <b>{{ $product->name }}</b></h4>
              @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
              @if (isset($isSuccess) && $isSuccess)
              <div class="alert alert-success">
                <ul>
                  Cập nhập thành công
                </ul>
              </div>
              @endif
            </div>
            <div class="card-body">
              <div class="basic-form">

                <form action="@if($product->id)
                                {{ url('/admin/product/update',$product->id) }}
                                @else
                                {{ url('/admin/product/create') }}
                                @endif" method="POST" enctype="multipart/form-data" id="productForm">
                  @csrf
                  <div class="form-group">
                    <label>
                      <h6>Trạng thái</h6>
                    </label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="status" id="status1" value="1" 
                      @if ($product->status == 1)checked @endif >
                      <label class="form-check-label" for="status1">Hiển thị</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="status" id="status0" value="0" @if($product->status == 0)checked @endif>
                      <label class="form-check-label" for="status0">Ẩn</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Danh mục</label>
                    <select type="text" class="form-control" name="id_category"
                      value="{{ old('id_category') ?? $product->id_category }}">
                      @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Tên</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') ?? $product->name }}">
                  </div>
                  <div class="form-group">
                    <label>Mô tả</label>
                    <textarea class="form-control" form="productForm" name="description"
                      rows="3">{{ old('description') ?? $product->description }}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Giá</label>
                    <input type="number" class="form-control" name="price"
                      value="{{ old('price') ?? $product->price }}">
                  </div>
                  <div class="form-group">
                    <label>Tồn kho</label>
                    <input type="number" class="form-control" name="stock"
                      value="{{ old('stock') ?? $product->stock }}">
                  </div>
                  <div class="form-group">
                    <label>Hình ảnh</label>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label"></label>
                      <div class="col-sm-10">
                        <button onclick="spartanMultiImagePicker();">asdas</button>
                        <div id="multi_image_picker" class="row"></div>
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Lưu</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(function(){
    $("#multi_image_picker").spartanMultiImagePicker({
      fieldName     : 'fileUpload[]', // this configuration will send your images named "fileUpload" to the server
    });
  });
</script>
@endsection