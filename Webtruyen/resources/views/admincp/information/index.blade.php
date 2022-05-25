@extends('layouts.master')
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-12">
        <div class="page-header float-right">
            <div class="page-title">
                @can('information add')
                <a href="{{ route('information.create') }}"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm thông tin 
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
                        <strong class="card-title">Thông tin website</strong>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tiêu đề</th>
                                    <th>Logo</th>
                                    <th>Mô tả</th>
                                    <th>Copyright</th> 
                                    <th>Kích hoạt</th>
                                    <th>Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($information))
                                @php
                                    $i = 0;
                                    $count = 0
                                @endphp
                                @foreach ($information as $item)
                                
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>
                                        {{ $item->title }}
                                    </td>
                                    <td><img src="{{ asset('public/uploads/story/'.$item->logo) }}" width="300px"></td>
                                    <td>{!! $item->description !!}</td>
                                    <td>{{ $item->copyright }}</td>
                                    <td>
                                        @if ($item->status == 0)
                                            <span class="badge badge-secondary">Không</span>
                                        @else
                                        <span class="badge badge-primary">Kích hoạt</span>
                                        @endif
                                    </td>
                                    <td>
                                        @can('information edit')

                                        <a style="color: blue; font-size: 20px;" href="{{ route('information.edit', $item->id) }}"><i class="ti-pencil-alt"></i></a>
                                        @endcan
                                        @can('information delete')
                                        <form action="{{route('information.destroy',[$item->id])}}" method="POST" style="display:inline-block">
                                            @method('DELETE')
                                            @csrf
                                            <button style="color: red; font-size: 20px; border: none; cursor: pointer; padding: 0;" onclick="return confirm('Bạn muốn xóa không?');"><i class="ti-trash"></i></button>
                                              
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
