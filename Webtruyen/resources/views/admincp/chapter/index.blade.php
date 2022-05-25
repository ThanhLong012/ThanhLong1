@extends('layouts.master')
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-12">
        <div class="page-header float-right">
            <div class="page-title">
                <a href="{{ route('story.index') }}"><button type="button" class="btn btn-primary"><i class="fa fa-book"></i> Quản lý truyện
                </button></a>
            
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
                        <strong class="card-title">Danh sách các chương</strong>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên mục</th>
                                    <th>Tên chương</th>
                                    <th>Thuộc truyện</th>
                                    <th>Ngày cập nhật</th>
                                    <th>Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($chapters))
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($chapters as $chap)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $chap->name }}</td>
                                    <td>{{ $chap->subname }}</td>
                                    <td>{{ $chap->story->name }}</td>
                                    <td>{{ $chap->created_at }}</td>

                                    <td>
                                        @can('chapter edit')
                                        <a style="color: blue; font-size: 20px;" href="{{ route('chapter.edit', $chap->id) }}"><i class="ti-pencil-alt"></i></a>
                                        @endcan
                                        @can('chapter delete')
                                        <a style="color: red; font-size: 20px;" href="{{route('chapter.destroy',[$chap->id])}}" onclick="return confirm('Bạn muốn xóa chương truyện này không?');"><i class="ti-trash"></i></a>
                                      
                              
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
