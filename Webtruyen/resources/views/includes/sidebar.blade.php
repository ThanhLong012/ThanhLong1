<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./">{{ Auth::user()->name }}</a>
            <a class="navbar-brand hidden" href="./"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{ route('dashboard') }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>
    
                <li><a href="{{ route('category.index') }}"><i class="menu-icon ti-menu"></i>Quản lý danh mục</a></li>
                <li><a href="{{ route('genre.index') }}"><i class="menu-icon ti-menu"></i>Thể loại</a></li>
                <li><a href="{{ route('author.index') }}"><i class="menu-icon ti-menu"></i>Tác giả</a></li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Truyện</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-sign-in"></i><a href="{{ route('story.index') }}">Danh sách truyện</a></li>

                        <li><i class="menu-icon fa fa-sign-in"></i><a href="{{ route('chapter.index') }}">Danh sách chương</a></li>
                        <li><i class="menu-icon fa fa-sign-in"></i><a href="{{ route('story.create') }}">Thêm mới truyện</a></li>

                    </ul>
                </li>
                <li><a href="{{ route('information.index') }}"><i class="menu-icon ti-menu"></i>Thông tin website</a></li>


                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Tài khoản</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-sign-in"></i><a href="{{ route('list.user') }}">Danh sách tài khoản</a></li>

                        <li><i class="menu-icon fa fa-sign-in"></i><a href="{{ route('user.add') }}">Tạo tài khoản</a></li>
                    </ul>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Phân quyền</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-sign-in"></i><a href="{{ route('permission.add') }}">Tạo quyền</a></li>
                        <li><i class="menu-icon fa fa-sign-in"></i><a href="{{ route('list.role') }}">Vai trò</a></li>
                    </ul>
                </li>
                
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->