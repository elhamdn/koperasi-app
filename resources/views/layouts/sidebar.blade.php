<div id="sidebar" class="active">
    <div class="sidebar-wrapper active ps ps--active-y">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo w-100 text-center">
                    <a href="{{ url('dashboard') }}"><img src="https://kopmafeuii.com/wp-content/uploads/2017/06/LAMBANG-KOPERASI.png" alt="Logo" srcset="" style="object-fit: contain; width: 100px;height:100px"></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="fas fa-bars text-white"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">

                <li class="sidebar-item">
                    <a href="{{ url('dashboard') }}" class="sidebar-link">
                        <i class="fas fa-house"></i>
                        <span>Beranda</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{ url('pengajuan') }}" class="sidebar-link">
                        <i class="fas fa-sticky-note"></i>
                        <span>Pengajuan</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{ url('simpanan') }}" class="sidebar-link">
                        <i class="fas fa-piggy-bank"></i>
                        <span>Simpanan</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{ url('angsuran') }}" class="sidebar-link">
                        <i class="fas fa-file"></i>
                        <span>Angsuran</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a class="sidebar-link">
                        <i class="fas fa-layer-group"></i>
                        <span>Master</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ url('master/anggota') }}">
                                <i class="fas fa-users"></i>
                                <span>Anggota</span>
                            </a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ url('master/pengurus') }}">
                                <i class="fas fa-id-card"></i>
                                <span>Pengurus</span>
                            </a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ url('master/rekap') }}">
                                <i class="fas fa-id-card"></i>
                                <span>Rekap Data</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item ">
                    <a href="{{url('/logout')}}" class="sidebar-link">
                        <i class="fas fa-arrow-right-from-bracket"></i>
                        <span>Keluar</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;">
            </div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 689px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 287px;"></div>
        </div>
    </div>
</div>

@section('js')
<script>
    const button = document.querySelector('#master-nav')

    button.addEventListener('click', () => {
        document.querySelector("#dropdown-containerid").classList.toggle("active");
    })
</script>
@endsection