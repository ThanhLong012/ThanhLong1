@extends('layouts.master')
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Chỉnh sửa tài khoản</h1>
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
                        <form action="{{ route('user.update', [$user->id]) }} " method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Họ tên</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}">
                                    @if($errors->has('name'))
                                        <div class="error-text">
                                            {{$errors->first('name')}}
                                        </div>
                                    @endif
                                </div>
                            </div>
            
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}">
                                    @if($errors->has('email'))
                                        <div class="error-text">
                                            {{$errors->first('email')}}
                                        </div>
                                    @endif
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Nhập password...." value="{{ old('password') }}">
                                    @if($errors->has('password'))
                                        <div class="error-text">
                                            {{$errors->first('password')}}
                                        </div>
                                    @endif
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Chọn vai trò</label>
                                <div class="col-sm-9">
                                    @foreach($roles as $role)
                                    <div class="col-sm-3">
                                        <label>
                                        <input type="checkbox" {{ $roleOfUser->contains('id', $role->id) ? 'checked' : '' }} name="role_id[]" value="{{ $role->id }}">
                                        {{ $role->name }}
                                        </label>
                                    </div>
                                     @endforeach
                                </div>
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