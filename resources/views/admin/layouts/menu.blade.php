<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
{{--    <a href="/dashboard" class="brand-link">--}}
{{--        <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">--}}
{{--        <span class="brand-text font-weight-light">&nbsp;</span>--}}
{{--    </a>--}}
    <div class="brand-link h__brand_link">
        <img src="{{ config('app.momo.logo_admin') }}" onerror="this.src=`{{ asset('image/logo.png') }}`" />
    </div>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ handleMenuActive(route('admin.dashboard')) }}">
                        <p>Thống Kê</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.historyDate') }}" class="nav-link {{ handleMenuActive(route('admin.historyDate')) }}">
                        <p>Thống Kê Ngày</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.setting') }}" class="nav-link {{ handleMenuActive(route('admin.setting')) }}">
                        <p>Cài Đặt Trang Web</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.support') }}" class="nav-link {{ handleMenuActive(route('admin.support')) }}">
                        <p>Link Hỗ Trợ</p>
                    </a>
                </li>

                <div class="h__border_bottom h__mt_7 h__mb_10"></div>

                <li class="nav-item {{ handleMenuOpen('/eventDay') }}">
                    <a href="#" class="nav-link {{ handleMenuActive('/eventDay') }}">
                        <p>
                            NHIỆM VỤ NGÀY
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.eventDay.setting') }}" class="nav-link {{ handleMenuActive(route('admin.eventDay.setting')) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cài Đặt</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.eventDay.history') }}" class="nav-link {{ handleMenuActive(route('admin.eventDay.history')) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lịch Sử Trả Thưởng</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <div class="h__border_bottom h__mt_7 h__mb_10"></div>

                <li class="nav-item {{ handleMenuOpen('/momo') }}">
                    <a href="#" class="nav-link {{ handleMenuActive('/momo') }}">
                        <p>
                            HỆ THỐNG MOMO
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.momo.receiveMoney') }}" class="nav-link {{ handleMenuActive(route('admin.momo.receiveMoney')) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Check Lịch Sử Chơi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.momo.transfer') }}" class="nav-link {{ handleMenuActive(route('admin.momo.transfer')) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Chuyển Tiền - Lịch Sử Chuyển</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.momo.transferError') }}" class="nav-link {{ handleMenuActive(route('admin.momo.transferError')) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bill Lỗi Thanh Toán</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.momo.manager') }}" class="nav-link {{ handleMenuActive(route('admin.momo.manager')) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản Lý MOMO</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.momo.ratio') }}" class="nav-link {{ handleMenuActive(route('admin.momo.ratio')) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cài Đặt Tỷ Lệ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.momo.giftCode') }}" class="nav-link {{ handleMenuActive(route('admin.momo.giftCode')) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản Lý GiftCode</p>
                            </a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('admin.momo.event') }}" class="nav-link {{ handleMenuActive(route('admin.momo.event')) }}">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Lịch Sử Event</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                </li>

                <div class="h__border_bottom h__mt_7 h__mb_10"></div>

                <li class="nav-item {{ handleMenuOpen('/rank') }}">
                    <a href="#" class="nav-link {{ handleMenuActive('/rank') }}">
                        <p>
                            CÀI ĐẶT TOP TUẦN
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.rank.one') }}" class="nav-link {{ handleMenuActive(route('admin.rank.one')) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Top 1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.rank.two') }}" class="nav-link {{ handleMenuActive(route('admin.rank.two')) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Top 2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.rank.three') }}" class="nav-link {{ handleMenuActive(route('admin.rank.three')) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Top 3</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.rank.four') }}" class="nav-link {{ handleMenuActive(route('admin.rank.four')) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Top 4</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.rank.five') }}" class="nav-link {{ handleMenuActive(route('admin.rank.five')) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Top 5</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <div class="h__border_bottom h__mt_7 h__mb_10"></div>

                <li class="nav-item">
                    <a href="{{ route('changePassword') }}" class="nav-link {{ handleMenuActive(route('changePassword')) }}">
                        <p>Đổi mật khẩu</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <p>Đăng xuất</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
