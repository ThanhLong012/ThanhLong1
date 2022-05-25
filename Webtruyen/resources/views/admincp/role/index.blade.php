@extends('layouts.master')

@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                {{-- @can('role add') --}}
                <a href="{{ route('role.add') }}"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm vai trò
                {{-- @endcan --}}
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
                        <strong class="card-title">Danh sách vai trò</strong>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Guard name</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->guard_name }}</td>
                                    <td>
                                        <a style="color: blue; font-size: 20px; padding-right: 30px;" href="{{ route('role.edit', $role->id) }}"><i class="ti-pencil-alt"></i></a>
                                        <a style="color: red; font-size: 20px;"  onclick="confirm('Bạn có chắc chắn muốn xóa không?');" href="{{ route('role.destroy', $role->id) }}"><i class="ti-trash"></i></a>
                        
                                    </td>

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div>
@endsection