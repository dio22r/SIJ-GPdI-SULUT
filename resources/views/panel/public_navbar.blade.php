<nav id="menu-wrapper" class="navbar sticky-top navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img class="bi me-2" src="{{ url('/assets/img/image2993-2-300x50.png') }}" height="50px" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-row-reverse" id="navbarNav">
            <ul class="navbar-nav mb-lg-0 mb-3 align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">
                        <img src="{{ url('/assets/img/mini_sipandusatu.png') }}" height="30px" />
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profil
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/profil/#sejarah">Sejarah</a></li>
                        <li><a class="dropdown-item" href="/profil/#visimisi">Visi & Misi</a></li>
                        <li><a class="dropdown-item" href="/profil/#tugasfungsi">Tugas & Fungsi</a></li>
                        <li><a class="dropdown-item" href="/profil/#struktur">Struktur Organisasi</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Produk
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" target="_blank" href="https://sanitasi.ciptakarya.pu.go.id/produk-hukum">Produk Hukum</a></li>
                        <li><a class="dropdown-item" href="/lakip">Lakip</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Layanan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item @if (Request::is('bimtek*')) active @endif" href="{{ url('/bimtek') }}">Bimbingan Teknis</a></li>
                        <li><a class="dropdown-item @if (Request::is('audit-teknologi*')) active @endif" href="{{ url('/audit-teknologi') }}">Audit Teknologi</a></li>
                        <li><a class="dropdown-item @if (Request::is('sewa-ruang-fasilitas*')) active @endif" href="{{ url('/sewa-ruang-fasilitas') }}">Sewa Ruang & Fasilitas</a></li>
                        <li><a class="dropdown-item @if (Request::is('pengujian*')) active @endif" href="{{ url('/pengujian') }}">Pengujian Laboratorium</a></li>
                        <li><a class="dropdown-item @if (Request::is('inspeksi*')) active @endif" href="{{ url('/inspeksi') }}">Inspeksi / Sertifikat Produk</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/berita">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/hubungi">Hubungi</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Informasi Publik
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" target="_blank" href="https://jdih.pu.go.id/">JDIH</a></li>
                        <li><a class="dropdown-item" target="_blank" href="https://pengaduan.pu.go.id/">Pengaduan Masyarakat</a></li>
                        <li><a class="dropdown-item" target="_blank" href="https://eppid.pu.go.id/">E-PPID</a></li>
                        <li><a class="dropdown-item" target="_blank" href="http://wispu.pu.go.id/">Whistleblowing System</a></li>
                        <li><a class="dropdown-item" target="_blank" href="http://gol.itjen.pu.go.id/">Pengendalian Gratifikasi</a></li>
                        <li><a class="dropdown-item" target="_blank" href="https://www.lapor.go.id/">SP4N - LAPOR</a></li>
                        <li><a class="dropdown-item" target="_blank" href="https://lpse.pu.go.id/">Pengadaan Barang & Jasa</a></li>
                    </ul>
                </li>

                <!--
                <li class="nav-item">
                    <a class="nav-link @if (Request::is('sewa-ruang-fasilitas*')) active @endif" href="{{ url('/sewa-ruang-fasilitas') }}">Sewa Fasilitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Request::is('audit-teknologi*')) active @endif" href="{{ url('/audit-teknologi') }}">Audit Teknologi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Request::is('sewa-ruang-fasilitas*')) active @endif" href="{{ url('/sewa-ruang-fasilitas') }}">Sewa Fasilitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Request::is('audit-teknologi*')) active @endif" href="{{ url('/audit-teknologi') }}">Audit Teknologi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Request::is('bimtek*')) active @endif" href="{{ url('/bimtek') }}">Bimtek</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Request::is('inspeksi*')) active @endif" href="{{ url('/inspeksi') }}">Inspeksi</a>
                </li> -->
                <li class="nav-item ms-0 ms-lg-2">
                    <a class="nav-link nav-login" href="{{ url('/login') }}">
                        Login <i class="fas fa-sign-in-alt"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
