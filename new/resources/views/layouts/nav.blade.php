<!--sidebar wrapper -->
<style>
    .logo-text-new{
        font-size: 22px;
        margin-bottom: 0;
        margin-left: 2px;
        letter-spacing: 1px;
    }
</style>
@php
    $type = auth()->user()->type;
@endphp
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <a href="/home" class="navbar-brand"><i class="fa fa-info"></i> Medic</a>
            <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
            </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @if($type == 'nurse')
            <li class="mm">
                <a class="has-arrow" href="javascript:;" aria-expanded="true">
                    <div class="parent-icon"><i class="lni lni-bookmark"></i></div>
                    <div class="menu-title">Хисоботлар</div>
                </a>
                <ul class="mm-collapse" style="">
                    <li class="">
                        <a class="" href="/report/journal" aria-expanded="true">
                            Журнал
                        </a>
                    </li>
                    <li class="">
                        <a class="" href="/report/quarterly" aria-expanded="true">
                            Чорак давр
                        </a>
                    </li>
                </ul>
            </li>
        @else
            <li>
                <a href="/worker">
                    <div class="parent-icon"><i class="lni lni-users"></i>
                    </div>
                    <div class="menu-title">Markaz hodimlari</div>
                </a>
            </li>
            <li>
                <a href="/doctor">
                    <div class="parent-icon"><i class="lni lni-users"></i>
                    </div>
                    <div class="menu-title">Tibbiyot hodimlari</div>
                </a>
            </li>
            <li>
                <a href="/nurse">
                    <div class="parent-icon"><i class="lni lni-users"></i>
                    </div>
                    <div class="menu-title">Hamshiralar</div>
                </a>
            </li>
            <li class="mm">
                <a class="has-arrow" href="javascript:;" aria-expanded="true">
                    <div class="parent-icon"><i class="lni lni-bookmark"></i></div>
                    <div class="menu-title">Sozlamalar</div>
                </a>
                <ul class="mm-collapse" style="">
                    <li class="">
                        <a class="" href="/admin/training/center" aria-expanded="true">
                            Markazlar
                        </a>
                    </li>
                    <li class="">
                        <a class="" href="/admin/polyclinic" aria-expanded="true">
                            Muassasalar
                        </a>
                    </li>
                </ul>
            </li>
        @endif
    </ul>
{{--    lni lni-bookmark--}}
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
