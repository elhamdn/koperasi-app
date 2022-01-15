<div class="" style="flex:1;" id="headerMenuCollapse">
    <ul class="nav nav-tabs border-0 flex-column flex-lg-column" style="padding-left: 20px;color:black;">
        <li class="nav-item">
            <a href="{{ url('home') }}" class="nav-link"><i class="fe fe-home"></i> Beranda</a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link"><i class="fe fe-users"></i> Anggota</a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link"><i class="fe fe-dollar-sign"></i> Setoran</a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link"><i class="fe fe-hash"></i> Withdraw</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('mutations') }}" class="nav-link"><i class="fe fe-printer"></i> List Mutasi</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('bankinterests') }}" class="nav-link"><i class="fe fe-box"></i> Hitung Bunga</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('profile') }}" class="nav-link"><i class="fe fe-user"></i> Profil</a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fe fe-log-out"></i> Keluar</a>

            <form id="logout-form" action="" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>