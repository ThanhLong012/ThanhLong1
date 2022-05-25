@extends('layouts.master')
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Cập nhật truyện</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="{{ route('story.index') }}">story</a></li>
                    <li class="active">update</li>
                </ol>
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
                        <form action="{{ route('story.update', $story->id) }}" method="post" enctype='multipart/form-data'>
                            {{ csrf_field() }}
                            @method('PUT')
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Tên truyện</label>
                                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $story->name }}">
                                @if($errors->has('name'))
                                <div class="error-text">
                                    {{$errors->first('name')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Hình ảnh</label>
                                <input type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" >
                                <img src="{{asset('public/uploads/story/'.$story->image)}}" height="250" >
                                @if($errors->has('image'))
                                <div class="error-text">
                                    {{$errors->first('image')}}
                                </div>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Nội dung</label>
                                <textarea class="form-control" rows="5" id="content" name="content">{{ $story->content }}</textarea>
                                @if($errors->has('content'))
                                <div class="error-text">
                                    {{$errors->first('content')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Nguồn truyện</label>
                                <input name="source" type="text" class="form-control @error('source') is-invalid @enderror" value="{{ $story->source }}">
                                @if($errors->has('source'))
                                <div class="error-text">
                                    {{$errors->first('source')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Tác giả</label>
                                
                                <select  class="form-control" name="author_id">
                                    <option value="">--Chọn tác giả--</option>
                                    @foreach($authors as $key => $aut)
                                    <option @if( $story->author_id == $aut->id) ) selected @endif value="{{ $aut->id }}">{{ $aut->name }}</option>
                                    @endforeach
                                  </select>
                               
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Danh mục</label>
                               
                                <select class="js-example-basic-multiple form-control" name="category_id[]" multiple="multiple">
                                    @foreach($categories as $key => $cat)
                                        <option value="{{ $cat->id }}"  @if( $story_categories->contains($cat->id) ) selected @endif>{{ $cat->name }}</option>
                                    @endforeach
                                  </select>          
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Thể loại</label>
                               
                                <select class="js-example-basic-multiple form-control" name="genre_id[]" multiple="multiple">
                                    @foreach($genres as $key => $gen)
                                        <option value="{{ $gen->id }}"  @if( $story_genres->contains($gen->id) ) selected @endif>{{ $gen->name }}</option>
                                    @endforeach
                                  </select>          
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Từ khóa </label>
                                <input name="keyword" type="text" class="form-control @error('keyword') is-invalid @enderror" value="{{ $story->keyword }}">
                                @if($errors->has('keyword'))
                                <div class="error-text">
                                    {{$errors->first('keyword')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Tình trạng</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="status">
                                  <option  @php echo ($story['status'] == '0') ? 'selected' : ''; @endphp value="0">Đang cập nhật</option>
                                  <option  @php echo ($story['status'] == '1') ? 'selected' : ''; @endphp value="1">Đã hoàn thành</option>
                                  <option  @php echo ($story['status'] == '2') ? 'selected' : ''; @endphp value="2">Ngừng cập nhật</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Nổi bật</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="hot">
                                  <option  @php echo ($story['hot'] == '0') ? 'selected' : ''; @endphp value="0">Không</option>
                                  <option  @php echo ($story['hot'] == '1') ? 'selected' : ''; @endphp value="1">Nổi bật</option>
                                </select>
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
@section('js')
<script>
    CKEDITOR.replace('content');
    
</script>
@endsection