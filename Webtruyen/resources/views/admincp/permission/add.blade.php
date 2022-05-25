@extends('layouts.master')

@section('content')
<div class="breadcrumbs">
  <div class="col-sm-4">
      <div class="page-header float-left">
          <div class="page-title">
              <h1>Thêm quyền</h1>
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
                  <form action="{{ route('permission.save') }} " method="POST">
                    {{ csrf_field() }}
                      <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Chọn module</label>
                        <div class="col-sm-7">
                          <select class="form-control" name="parent_id">
                              <option name="module" value="0">Chọn module</option>
                              {{!!$htmlOption!!}}
                              
                          </select>
                        </div>
                        <div class="col-sm-2" style="margin-left: -23px">
                          <button type="button" class="btn btn-primary" data-toggle="modal"
                                  data-target="#list-prd-group"
                                  style="border-radius: 0 3px 3px 0; box-shadow: none;">Thêm module
                          </button>
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label"></label>
                          @foreach(config('permission.module_children') as $moduleItemChildren)
                          <div class="col-md-2">
                            <label>
                              <input type="checkbox" name="module_children[]" value="{{ $moduleItemChildren }}">
                              {{ $moduleItemChildren }}
                            </label>
                          </div>
                          @endforeach
                        
                      </div>
                      <div class="">
                        <div>
                          <button  type="submit" class="btn btn-lg btn-info btn-block">Lưu</button>
                      </div>
                      </div>
                </form>
                </div>
              </div>
                
        
            </div>
        </div>
  </div>
</div>
<div class="modal fade" id="list-prd-group" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Tạo mới module</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                      aria-hidden="true">&times;</span></button>
              
          </div>
          <div class="modal-body">
              <div class="success_alert" id="success_alert"></div>
              <form method="POST">
                  {{ csrf_field() }}
                  <div class="row form-horizontal">
                      <div class="col-md-12">
                          <div class="form-group row">
                              <label for="" class="col-sm-3 col-form-label">Tên module</label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" id="name" placeholder="Tên module...." value="{{ old('name') }}">
                                  <span style="color: red; font-style: italic; font-size: 14px" class="error error_name"></span>
                              </div>
                          </div>

                      </div>
                  </div>
              </form>
                
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-primary "
                                                      onclick="create_module();"><i class="fa fa-floppy-o"></i> Lưu
                                                  
              </button>
              <button type="button" class="btn btn-default btn-sm btn-close" data-dismiss="modal"><i
                      class="fa fa-undo"></i> Đóng
              </button>
          </div>
      </div>
  </div>
</div>


@endsection

@section('js')
<script>
  function create_module() {
    'use strict';
    var name = $ob('#name').val();

    var _token = $ob('input[name="_token"]').val();

    if (name.length == 0) {
        alert('Nhập tên module.');
    } else {
        
        $ob.ajax({
            url: '{{url('/permission/create-module')}}',
            method: 'POST',
            data:{_token:_token, name:name},
            success:function(){
                
                $ob('.success_alert').append('<div class="alert alert-success">Thêm module thành công.</div>');
                setTimeout(function() {
                    $ob('.success_alert').fadeOut(1000);
                    
                }, 1000);
                location.reload();
            }

        });
        
    }
}
</script>
@endsection
