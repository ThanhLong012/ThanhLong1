@extends('layouts.master')
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-12">
        <div class="page-header float-right">
            <div class="page-title">
                <a href="{{ route('story.index') }}"><button type="button" class="btn btn-primary"><i class="fa fa-book"></i> Quản lý truyện
                </button></a>
                <a href="{{ route('chapter.index') }}"><button type="button" class="btn btn-primary"><i class="fa fa-book"></i> Toàn bộ chương
                </button></a>
                @can('chapter add')
                <a href="{{ route('chapter.create', $story->id) }}"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm chương mới
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
                        <strong class="card-title">Danh sách chương của: {{ $story->name }} </strong>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên mục</th>
                                    <th>Tên chương</th>
                                    <th>Ngày cập nhật</th>
                                    <th>Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($chapters))
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($chapters as $chapter)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $chapter->name }}</td>
                                    <td>{{ $chapter->subname }}</td>
                                    <td>{{ $chapter->created_at }}</td>

                                    <td>
                                        @can('chapter edit')
                                        <a style="color: blue; font-size: 20px;" href="{{ route('chapter.edit', $chapter->id) }}"><i class="ti-pencil-alt"></i></a>
                                        @endcan
                                        @can('chapter delete')
                                        <a style="color: red; font-size: 20px;" href="{{route('chapter.destroy',[$chapter->id])}}" onclick="return confirm('Bạn muốn xóa chương truyện này không?');"><i class="ti-trash"></i></a>
                                      
                              
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
