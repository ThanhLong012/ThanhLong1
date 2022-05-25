@extends('layouts.master')
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Thêm vai trò</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('list.role') }}">Role</a></li>
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
                        <form action="{{ route('role.store') }} " method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <div class="col-md-9">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nhập tên vai trò...." value="{{ old('name') }}">
                                        @if($errors->has('name'))
                                            <div class="error-text">
                                                {{$errors->first('name')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Guard name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('guard_name') is-invalid @enderror" name="guard_name" placeholder="Guard name...." value="{{ old('guard_name') }}">
                                        @if($errors->has('guard_name'))
                                            <div class="error-text">
                                                {{$errors->first('guard_name')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">
                                            <input type="checkbox" name="" class="check_all"> All
                                        </label>
                                    </div>
                                    @foreach($permissionParent as $parentItem)
                                    <div class="card  mb-3 col-md-12">
                                        <div class="card-header">
                                        <label>
                                            <input type="checkbox" value="" class="checkbox_wrapper">
                                        </label>
                                        Module {{ $parentItem->name }}
                                        </div>
                                        <div class="row">
                                            @foreach($parentItem->permissionChildren as $childItem)
                                            <div class="card-body col-md-3">
                                                <p class="card-title">
                                                    <input type="checkbox" class="checkbox_children" name="permission_id[]" value="{{ $childItem->id }}">
                                                    {{ $childItem->name }}
                                                </p>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endforeach
                                    <div></div>
                                    
                                </div>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">Lưu</button>
                                </div>
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
           var $ob = jQuery.noConflict();

        $ob(function(){
    $ob('.checkbox_wrapper').on('click', function() {
        $ob(this).parents('.card').find('.checkbox_children').prop('checked', $ob(this).prop('checked'));
     });
    
     $ob('.check_all').on('click', function(){
         $ob(this).parents().find('.checkbox_children').prop('checked', $ob(this).prop('checked'))
         $ob(this).parents().find('.checkbox_wrapper').prop('checked', $ob(this).prop('checked'))

     })
})
    </script>
@endsection
