<div id="sidebar" class="active">
    <div class="sidebar-wrapper active ps ps--active-y">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo w-100 text-center">
                    <a href="index.html"><img src="https://kopmafeuii.com/wp-content/uploads/2017/06/LAMBANG-KOPERASI.png" alt="Logo" srcset="" style="object-fit: contain; width: 100px;height:100px"></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                
                <li class="sidebar-item">
                    <a href="{{ url('dashboard') }}" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Beranda</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{ url('pengajuan') }}" class="sidebar-link">
                        <i class="bi bi-envelope-fill"></i>
                        <span>Pengajuan</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{ url('simpanan') }}" class="sidebar-link">
                    <i class="bi bi-archive-fill"></i>
                        <span>Simpanan</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{ url('angsuran') }}" class="sidebar-link">
                        <i class="bi bi-file-text-fill"></i>
                        <span>Angsuran</span>
                    </a>
                </li>
                
                <li class="sidebar-item  has-sub">
                    <a class="sidebar-link">
                        <i class="bi bi-stack"></i>
                        <span>Master</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ url('master/anggota') }}">
                                <i class="bi bi-people-fill"></i>
                                <span>Anggota</span>
                            </a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ url('master/pengurus') }}">
                                <i class="bi bi-person-badge"></i>
                                <span>Pengurus</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item ">
                    <a href="{{url('/logout')}}" class="sidebar-link">
                        <i class="bi bi-door-closed-fill"></i>
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