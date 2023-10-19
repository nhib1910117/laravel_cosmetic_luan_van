@extends('admin.layout.master')
@section('content')
    <div class="title-left">
        <h2>{{isset($brand_edit) ? "Cập nhật thương hiệu " : "Thêm mới thương hiệu "}}</h2>
    </div>
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{isset($brand_edit) ? "Update Brand" : "Create Brand "}}</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                
                <form action="{{isset($brand_edit) ? route('brand.update',$brand_edit->id) : route('brand.store')}}"  method="POST" class="form-label-left input_mask" enctype="multipart/form-data">
                    <div class="col-md-12 col-sm-12  form-group">
                        <input type="text" class="form-control" value="{{isset($brand_edit) ? $brand_edit->name : ''}}" name="name" id="inputSuccess2" placeholder="Tên thương hiệu ">
                        @if($errors->has('name'))
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                    <div class="col-md-12 col-sm-12  form-group">
                        <div class="checkbox">
                            <h4>
                                <input type="checkbox" @if(isset($brand_edit)) {{$brand_edit->status==1 ? "checked" : ""}} @endif  name="status" value="1" class="mr-3">Trạng thái
                            </h4>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group row">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <a href="{{route('brand.index')}}"><button type="button" class="btn btn-primary">Cancel</button></a>
                            <button class="btn btn-primary" type="reset">Reset</button>
                            <button type="submit" class="btn btn-success">Sumit</button>
                        </div>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection