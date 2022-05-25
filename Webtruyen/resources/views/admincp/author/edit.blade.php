@extends('layouts.master')
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Cập nhật tác giả</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="{{ route('author.index') }}">author</a></li>
                    <li class="active">update</li>
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
                        <form action="{{ route('author.update', $author->id) }}" method="post" enctype='multipart/form-data'>
                            {{ csrf_field() }}
                            @method('PUT')
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Tên tác giả</label>
                                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $author->name }}">
                                @if($errors->has('name'))
                                <div class="error-text">
                                    {{$errors->first('name')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Mô tả </label>
                                <textarea class="form-control" rows="5" id="description" name="description">{{ $author->description }}</textarea>
                                @if($errors->has('description'))
                                <div class="error-text">
                                    {{$errors->first('description')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Từ khóa </label>
                                <input name="keyword" type="text" class="form-control @error('keyword') is-invalid @enderror" value="{{ $author->keyword }}">
                                @if($errors->has('keyword'))
                                <div class="error-text">
                                    {{$errors->first('keyword')}}
                                </div>
                                @endif
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