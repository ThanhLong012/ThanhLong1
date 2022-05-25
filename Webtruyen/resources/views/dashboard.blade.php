@extends('layouts.master')
@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Thông tin</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td><strong>Tên</strong></td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Chức vụ</strong></td>
                                    @foreach ($roles as $item)
                                    <td>{{ $item->name }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Ngày tạo</strong></td>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <h4>Truyện xem nhiều</h4>
                <ol class="list_views">
                    @foreach($story_view as $key => $story)
                    <li>
                        <a target="_blank" href="{{ route('story', $story->slug) }}">{{$story->name}} | <span style="color:black">{{$story->view}}</span></a>
                    </li>
                    @endforeach
                </ol>
            </div>


        </div>
    </div><!-- .animated -->
</div>
<div class="content mt-3">
    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-8">
            <div class="card-body pb-0">
                <h2 class="mb-0">
                    <span class="count">{{ $total_category }}</span>
                </h2>
                <p class="text-light">Danh mục</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-5">
            <div class="card-body pb-0">
                <h2 class="mb-0">
                    <span class="count">{{ $total_genre }}</span>
                </h2>
                <p class="text-light">Thể loại</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-6">
            <div class="card-body pb-0">
                <h2 class="mb-0">
                    <span class="count">{{ $total_author }}</span>
                </h2>
                <p class="text-light">Tác giả</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-7">
            <div class="card-body pb-0">
                <h2 class="mb-0">
                    <span class="count">{{ $total_story }}</span>
                </h2>
                <p class="text-light">Truyện</p>
            </div>
        </div>
    </div>
   
</div>

@endsection


