@extends('layouts.master')
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>{{ $chapter->name }} : {{ $chapter->subname }}</h1>
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
                        <form action="{{ route('chapter.update', $chapter->id) }}" method="post" enctype='multipart/form-data'>
                            {{ csrf_field() }}
                          
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Tên mục</label>
                                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $chapter->name }}">
                                @if($errors->has('name'))
                                <div class="error-text">
                                    {{$errors->first('name')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Tên chương</label>
                                <input name="subname" type="text" class="form-control @error('subname') is-invalid @enderror" value="{{ $chapter->subname }}">
                                @if($errors->has('subname'))
                                <div class="error-text">
                                    {{$errors->first('subname')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Nội dung</label>
                                <textarea class="form-control" rows="5" id="content" name="content">{{ $chapter->content }}</textarea>
                                @if($errors->has('content'))
                                <div class="error-text">
                                    {{$errors->first('content')}}
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
@section('js')
<script>
    CKEDITOR.replace('content');
    
</script>
@endsection