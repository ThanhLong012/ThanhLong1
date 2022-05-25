@extends('layouts.master')
@section('title')
    <title>Tài khoản</title>
@endsection
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                @can('product add')
                <a href="{{ route('user.add') }}"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm tài khoản
                @endcan
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
                    <div class="card-header">
                        <strong class="card-title">Danh sách tài khoản</strong>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                   
                                   
                                    <th>Thao tác</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            @if (isset($users))
                                @php
                                    $i = 0;
                                @endphp
                                @foreach($users as $user)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                
                                    <td>
                                        @can('user edit')
                                        <a style="color: blue; font-size: 20px;" href="{{ route('user.edit', $user->id) }}"><i class="ti-pencil-alt"></i></a>
                                        @endcan
                                        @can('user delete')
                                        <a style="color: red; font-size: 20px;" href="{{ route('user.delete', $user->id) }}" onclick="confirm('Bạn có chắc chắn muốn xóa không?');"><i class="ti-trash"></i></a>
                                        @endcan
                                   </td>


                                </tr>
                                @endforeach
                                
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div>
@endsection
