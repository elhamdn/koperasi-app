<div class="container__sidebar" id="headerMenuCollapse">
    <ul class="nav container__sidebar__ul border-0 flex-column flex-lg-column">
        <li class="nav-item">
            <a href="{{ url('home') }}" class="nav-link"> Beranda</a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link"> Pengajuan</a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link"> Simpanan</a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link"> Pinjaman</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('mutations') }}" class="nav-link"> Angsuran</a>
        </li>
        <li class="nav-item " id="master-nav">
            <a href="#" class="nav-link"> Master</a>
            <span>V</span>
        </li>
        <ul class="dropdown-container" id="dropdown-containerid">
            <li class="nav-item">
                <a href="{{ url('profile') }}" class="nav-link"> Anggota</a>
            </li>
            <li class="nav-item">
                <a href="{{ url('profile') }}" class="nav-link"> Pengurus</a>
            </li>
        </ul>
        <li class="nav-item">
            <a href="{{ url('profile') }}" class="nav-link"> Profil</a>
        </li>
        <li class="nav-item">
            <a href="{{url('/logout')}}" class="nav-link" class="btn-li my-2">Keluar</a>
        </li>
    </ul>
</div>

@section('js')
<script>
    const button = document.querySelector('#master-nav')

    button.addEventListener('click', () => {
        document.querySelector("#dropdown-containerid").classList.toggle("active");
    })
</script>
@endsection