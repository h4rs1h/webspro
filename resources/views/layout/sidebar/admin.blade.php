<li class="nav-header">ADMINISTRATOR</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Dashboard

        </p>
    </a>

</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="fa fa-wrench fa-fw"></i>
        {{-- <i class="nav-icon fas fa-chart-pie"></i> --}}
        <p>
            Setting
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="/perangkat" class="nav-link">
                <i class="fas fa-qrcode nav-icon"></i>
                <p>Perangkat WA</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/template" class="nav-link">
                <i class="far fa-clipboard nav-icon"></i>
                <p>Template Pesan</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item ">
    <a href="#" class="nav-link">
        <i class="fa fa-table fa-fw"></i>
        <p>
            Master Data
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>

    <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="/ownership" class="nav-link">
                <i class="fas fa-qrcode nav-icon"></i>
                <p>Ownership (Pelanggan)</p>
            </a>
        </li>

    </ul>
</li>

<li class="nav-header">BILLING</li>
<li class="nav-item">
    <a href="/billing" class="nav-link">
        <i class="fas fa-print nav-icon"></i>
        <p>Inv Bulanan</p>
    </a>
</li>
{{-- perubahan link karena sudah tidak dipakai, bagian ini dihapus karena sudah tidak diperlukan --}}
<li class="nav-header">COLLECTION</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="fa fa-wrench fa-fw"></i>
        <p>
            Blast SP
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        {{-- <li class="nav-item">
            <a href="/invoicesp" class="nav-link">
                <i class="fas fa-arrow-right nav-icon"></i>
                <p>Inv SP Old</p>
            </a>
        </li> --}}
        <li class="nav-item">
            <a href="/collection?sp=1" class="nav-link">
                <i class="fas fa-arrow-right nav-icon"></i>
                <p>Inv SP 1</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/collection?sp=2" class="nav-link">
                <i class="fas fa-arrow-right nav-icon"></i>
                <p>Inv SP 2</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/collection?sp=3" class="nav-link">
                <i class="fas fa-arrow-right nav-icon"></i>
                <p>Inv SP 3</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/collection?sp=asuransi" class="nav-link">
                <i class="fas fa-arrow-right nav-icon"></i>
                <p>SP Asuransi</p>
            </a>
        </li>
    </ul>
</li>
