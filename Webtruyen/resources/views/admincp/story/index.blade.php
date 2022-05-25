@extends('layouts.master')
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-12">
        <div class="page-header float-right">
            <div class="page-title">
                @can('story add')
                <a href="{{ route('story.create') }}"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm truyện
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
                        <strong class="card-title">Danh sách truyện</strong>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên truyện</th>
                                    <th>Tác giả</th>
                                    <th>Danh mục</th>
                                    <th>Thể loại</th>
                                    <th>Số chương</th>   
                                    <th>Nổi bật</th>
                                    <th>Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($stories))
                                @php
                                    $i = 0;
                                    $count = 0
                                @endphp
                                @foreach ($stories as $item)
                                
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>
                                        @if ($item->status == 0)
                                        <span class="badge badge-primary">Đang cập nhật</span>
                                        @elseif ($item->status == 1) 
                                        <span class="badge badge-success">Đã hoàn thành</span>
                                        @else
                                        <span class="badge badge-danger">Ngừng cập nhật</span>

                                    @endif
                                        {{ $item->name }}
                                    </td>
                                    
                                    <td>{{ $item->author->name }}</td>
                                    <td>
                                        @foreach($item->categories as $cate)
                                            {{$cate->name}}
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($item->genres as $gen)
                                        <span style="color:#fff" class="badge badge-info">{{$gen->name}}</span>
                                        @endforeach
                                    </td>
                                   <td>
                                    @foreach ($chapters as $chap)
                                    @php
                                        if ($chap->story_id == $item->id){
                                            $count++;
                                        }
                                    @endphp
                                    @endforeach
                                    {{ $count }}
                                    @php
                                        $count =0;
                                    @endphp

                                   </td>
                                    <td>
                                        @if ($item->hot == 0)
                                            <span class="badge badge-secondary">Không</span>
                                        @else
                                        <span class="badge badge-primary">Nổi bật</span>
                                        @endif
                                    </td>


                                    
                                    <td>
                                        @can('story edit')
                                        
                                        <a style="color: blue; font-size: 20px;" href="{{ route('chapter.show', $item->slug) }}"><i class="ti-save"></i></a>

                                        <a style="color: blue; font-size: 20px;" href="{{ route('story.edit', $item->id) }}"><i class="ti-pencil-alt"></i></a>
                                        @endcan
                                        @can('story delete')
                                        <form action="{{route('story.destroy',[$item->id])}}" method="POST" style="display:inline-block">
                                            @method('DELETE')
                                            @csrf
                                            <button style="color: red; font-size: 20px; border: none; cursor: pointer; padding: 0;" onclick="return confirm('Bạn muốn xóa truyện này không?');"><i class="ti-trash"></i></button>
                                              
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
