@extends('layout')
@section('content')
<div class="breadcrumb_container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">     
                <nav>
            <ul>
                <li>
                    <a href="{{ route('index') }}">Home/ </a>
                </li>
                
                <li> Đăng ký</li>
            </ul>
        </nav>
            </div>
        </div> 
    </div>        
</div>
<div class="page_login_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="register_page_form">
                    <form action="{{ route('register.store') }}" method="POST"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-md-6">
                                <div class="input_text">
                                    <label for="R_N">Họ tên <span>*</span></label>
                                    <input id="R_N" type="text" name="name" class="@error('name') is-invalid @enderror" value="{{ old('name') }}"> 
                                    @if($errors->has('name'))
                                        <div class="error-text">
                                            {{$errors->first('name')}}
                                        </div>
                                    @endif
                                </div>   
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-6">
                                <div class="input_text">
                                    <label for="R_N">Email <span>*</span></label>
                                    <input id="R_N" type="text" name="email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}"> 
                                    @if($errors->has('email'))
                                        <div class="error-text">
                                            {{$errors->first('email')}}
                                        </div>
                                    @endif
                                </div>   
                            </div>
                            
                            <div class="col-12">
                                <div class="input_text">
                                    <label for="R_N11">Mật khẩu<span>*</span></label>
                                    <input id="R_N11" type="password" name="password" class="@error('password') is-invalid @enderror" value="{{ old('password') }}"> 
                                    @if($errors->has('password'))
                                        <div class="error-text">
                                            {{$errors->first('password')}}
                                        </div>
                                    @endif   
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input_text">
                                    <label for="R_N12">Nhập lại mật khẩu<span>*</span></label>
                                    <input id="R_N12" type="password" name="passwordAgain" class="@error('passwordAgain') is-invalid @enderror" value="{{ old('passwordAgain') }}"> 
                                    @if($errors->has('passwordAgain'))
                                        <div class="error-text">
                                            {{$errors->first('passwordAgain')}}
                                        </div>
                                    @endif
                                </div>   
                            </div>
                           
                            <div class="col-12">
                                <div class="login_submit">
                                    <button type="submit">Đăng ký</button>
                                </div>
                            </div>    
                            <div class="col-12 mt-20">
                                <p class="font-italic text-center">Have already an account? <a href="{{ route('login.viewer') }}" ><span class="font-weight-bold">Login here!</span></a></p>
                            </div> 
                            

                        </div>
                    </form>    
                </div>    
            </div>    
        </div>    
    </div>  
</div>


@endsection
