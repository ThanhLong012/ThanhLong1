@extends('layouts.master')
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Thêm danh mục</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="{{ route('category.index') }}">category</a></li>
                    <li class="active">create</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@if(session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
 @endif
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('category.store') }}" method="post" enctype='multipart/form-data'>
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Tên danh mục</label>
                                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror">
                                @if($errors->has('name'))
                                <div class="error-text">
                                    {{$errors->first('name')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Chọn danh mục cha</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">Chọn danh mục cha</option>
                                    {{!!$htmlOption!!}}
                
                                </select>
                            </div>
                    
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Mô tả </label>
                                <textarea class="form-control" rows="5" id="description" name="description">{{ old('description') }}</textarea>

                                @if($errors->has('description'))
                                <div class="error-text">
                                    {{$errors->first('description')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Từ khóa</label>
                                <input name="keyword" type="text" class="form-control @error('keyword') is-invalid @enderror">
                                @if($errors->has('keyword'))
                                <div class="error-text">
                                    {{$errors->first('keyword')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Kích hoạt</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="status">
                                  <option value="1">Kích hoạt</option>
                                  <option value="0">Không</option>
                                </select>
                              </div>
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div>
@endsection