@extends('layouts.master')
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Thêm thông tin website</h1>
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
                        <form action="{{ route('information.store') }}" method="post" enctype='multipart/form-data'>
                            {{ csrf_field() }}
                           
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Tiêu đề</label>
                                <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                                @if($errors->has('title'))
                                <div class="error-text">
                                    {{$errors->first('title')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Mô tả</label>
                                <textarea class="form-control" rows="5" id="description" name="description">{{ old('description') }}</textarea>
                                @if($errors->has('description'))
                                <div class="error-text">
                                    {{$errors->first('description')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Copyright</label>
                                <input name="copyright" type="text" class="form-control @error('copyright') is-invalid @enderror" value="{{ old('copyright') }}" >
                                @if($errors->has('copyright'))
                                <div class="error-text">
                                    {{$errors->first('copyright')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Logo</label>
                                <input type="file" class="form-control-file @error('logo') is-invalid @enderror" name="logo" >
                                @if($errors->has('logo'))
                                <div class="error-text">
                                    {{$errors->first('logo')}}
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
@section('js')
<script>
    CKEDITOR.replace('description');
    
</script>
@endsection