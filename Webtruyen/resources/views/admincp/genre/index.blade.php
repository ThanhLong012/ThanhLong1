@extends('layouts.master')
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-12">
        <div class="page-header float-right">
            <div class="page-title">
                @can('genre add')
                <a href="{{ route('genre.create') }}"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm thể loại
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
                        <strong class="card-title">Danh sách thể loại</strong>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên thể loại</th>
                                    <th>Mô tả</th>
                                    <th>Thể loại cha</th>
                                    <th>Kích hoạt</th>
                                    <th>Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($genres))
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($genres as $genre)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $genre->name }}</td>
                                    <td>{{ $genre->description }}</td>
                                    <td>
                                        @if($genre->parent_id ==0)
                                        <span style="color:red;">Không</span>
                                    @else
                                    @foreach($categories as  $cate_sub)
                                        @if($cate_sub->id == $genre->parent_id)
                                            <span style="color:green;">{{$cate_sub->name}}</span>
                                        @endif
                                    @endforeach
                                    @endif
                                    </td>

                                    <td>
                                        @if ($genre->status == 0)
                                            <span class="badge badge-secondary">Không</span>
                                        @else
                                        <span class="badge badge-primary">Kích hoạt</span>
                                        @endif
                                    </td>
                                   
                                    
                                    <td>
                                        @can('genre edit')
                                        <a style="color: blue; font-size: 20px;" href="{{ route('genre.edit', $genre->id) }}"><i class="ti-pencil-alt"></i></a>
                                        @endcan
                                        @can('genre delete')
                                        <form action="{{route('genre.destroy',[$genre->id])}}" method="POST" style="display:inline-block">
                                            @method('DELETE')
                                            @csrf
                                            <button style="color: red; font-size: 20px; border: none; cursor: pointer; padding: 0;" onclick="return confirm('Bạn muốn xóa danh mục truyện này không?');"><i class="ti-trash"></i></button>
                                              
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
