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
                <h1> <button class="btn btn-primary">Danh sách sản phẩm</button> </h1>
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
              <h4>@if($product->id) Chỉnh sửa <b>{{ $product->name }}</b> @else <h2>Tạo mới sản phẩm</h2>@endif </h4>
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
                      <input class="form-check-input" type="radio" name="status" id="status2" value="2" @if($product->status == 2)checked @endif>
                      <label class="form-check-label" for="status2">Ẩn</label>
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
                      <label class="col-sm-2 col-form-label"> </label>
                      <div class="col-sm-10">
                        <div id="multi_image_picker" class="row">
                          <?php $count = 0; ?>
                          @foreach ($product->rImages as $img)
                          <div class="col-md-4 col-sm-4 col-xs-6 spartan_item_wrapper" data-spartanindexrow="{{ $count }}"
                            style="margin-bottom : 20px; ">
                            <div style="position: relative;">
                              <div class="spartan_item_loader" data-spartanindexloader="{{ $count }}"
                                style=" position: absolute; width: 100%; height: 200px; background: rgba(255,255,255, 0.7); z-index: 22; text-align: center; align-items: center; margin: auto; justify-content: center; flex-direction: column; display : none; font-size : 1.7em; color: #CECECE">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                  </path>
                                </svg>
                              </div>
                              <label class="file_upload"
                                style="width: 100%; height: 200px; border: 2px dashed #ddd; border-radius: 3px; cursor: pointer; text-align: center; overflow: hidden; padding: 5px; margin-top: 5px; margin-bottom : 5px; position : relative; display: flex; align-items: center; margin: auto; justify-content: center; flex-direction: column;">
                                <a href="javascript:void(0)" data-spartanindexremove="{{ $count }}"
                                  style="right: 3px; top: 3px; background: rgb(237, 60, 32); border-radius: 3px; width: 30px; height: 30px; line-height: 30px; text-align: center; text-decoration: none; color: rgb(255, 255, 255); position: absolute !important;"
                                  class="spartan_remove_row">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"> </path>
                                  </svg>
                                </a> <img style="width: 64px; margin: 0px auto; vertical-align: middle; display: none;" data-spartanindexi="0"
                                  src="{{ asset('/images/'.$img->name) }}" class="spartan_image_placeholder">
                                <p data-spartanlbldropfile="{{ $count }}" style="color : #5FAAE1; display: none; width : auto; ">Drop file here
                                </p>
                                <img style="width: 100%; vertical-align: middle;" class="img_" data-spartanindeximage="{{ $count }}"
                                  src="{{ asset('/images/'.$img->name) }}">
                                <input type="text" name="oldFileUpload[{{ $img->id }}]" value="{{ $img->id }}" hidden>
                                <input class="form-control spartan_image_input" accept="image/*" data-spartanindexinput="{{ $count }}"
                                  style="display : none" name="fileUpload[{{ $img->id }}]" type="file">
                              </label>
                            </div>
                          </div>
                          <?php $count++; ?>
                          @endforeach
                        </div>
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
      count2        : '{{ $count }}',
      fieldName     : 'fileUpload[]', // this configuration will send your images named "fileUpload" to the server
    });
  });
</script>
@endsection
