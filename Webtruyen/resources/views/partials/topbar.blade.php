<div class="header_top_bar top_bar_two">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="header_top_inner">
                    <div class="phone">
                        @php
                            $today = Session::get('today')
                        @endphp
                        <p><i class="ion-clock"></i>{{ $today }}</p>
                    </div>
                    <div class="header_top_right">
                        <ul class="header_top_right_inner">
                            @php
                                $user = Session::get('user');
                                @endphp
                                 @if ($user == NULL)
                            <li class="language_wrapper_two">
                                <a href="{{ route('register') }}"><i class="fas fa-sign-out-alt"></i>
                                    <span>Đăng ký</span>
                                </a>
                            </li>
                            <li class="language_wrapper_two">
                                <a href="{{ route('login.viewer') }}"><i class="fas fa-sign-in-alt"></i>
                                    <span>Đăng nhập</span>
                                </a>
                            </li>
                            @else
                            <li class="language_wrapper_two">
                                <a href="#">
                                   Xin chào: <span>{{ $user->name }} <i class="fa fa-angle-down"></i> </span>
                                    
                                </a>
                                <ul class="account__name">
                                    
                                    <li><a href="{{ route('dangxuat') }}">Đăng xuất</a></li>
                                </ul>
                               
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>