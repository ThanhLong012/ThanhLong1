@extends('layouts.master')
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-12">
        <div class="page-header float-right">
            <div class="page-title">
                @can('author add')
                <a href="{{ route('author.create') }}"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm tác giả
                </button></a>
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
                        <strong class="card-title">Danh sách tác giả</strong>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên tác giả</th>
                                    <th>Mô tả</th>
                                    <th>Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($authors))
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($authors as $item)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>

                                    
                                    <td>
                                        @can('author edit')
                                        <a style="color: blue; font-size: 20px;" href="{{ route('author.edit', $item->id) }}"><i class="ti-pencil-alt"></i></a>
                                        @endcan
                                        @can('author delete')
                                        <form action="{{route('author.destroy',[$item->id])}}" method="POST" style="display:inline-block">
                                            @method('DELETE')
                                            @csrf
                                            <button style="color: red; font-size: 20px; border: none; cursor: pointer; padding: 0;" onclick="return confirm('Bạn muốn xóa tác giả này không?');"><i class="ti-trash"></i></button>
                                              
                                          </form>
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
