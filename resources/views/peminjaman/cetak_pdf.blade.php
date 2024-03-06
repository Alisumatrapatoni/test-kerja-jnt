<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">

<div class="container mt-3">
    <div class="row">
        <div class="col-sm-2">
            <img class="img-fluid" src="{{ asset('adminlte/dist/img/logo-jnt.png') }}" alt="Logo" />
        </div>
        <div class="col-sm-10 text-center">
            <h3><u>PT. KARYA NIAGA ABADI</u></h3>
            <h5>J&T Express Jawa Timur</h5>
            <p>Jl. Ir. H Djuanda 81A, Semambung, Gedangan, Sidoarjo ( Samping pengadilan militer III)
                <br>Telepon (031) 99443881 Website : <a href="https://jet.co.id/" style="color: rgb(15, 127, 255);"><u>https://jet.co.id/</u></a>

            </p>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-sm-12">
            <h4 class="text-center">Surat Peminjaman Aset</h4>


            <p>Yang bertanda tangan di bawah ini Sdr <b>{{ Auth::user()->name }}</b> Dengan Email
                <b>{{ Auth::user()->email }}</b> telah meminjam Aset
            </p>


            <ul style="margin-right: 30px;">
                <li><strong>Nama Aset:</strong> {{ $peminjaman->barang->nama }}</li>
                <li><strong>Kode Aset:</strong> {{ $peminjaman->barang->kode }}</li>
                <li><strong>Kondisi Awal:</strong> {{ $peminjaman->barang->kondisi }}</li>
                <li><strong>Jumlah Request:</strong> {{ $peminjaman->jumlah_request }}</li>
                <li><strong>Tanggal Pinjam:</strong> {{ $peminjaman->tanggal_pinjam }}</li>
                <li><strong>Tanggal Kembali:</strong> {{ $peminjaman->tanggal_kembali }}</li>
            </ul>

            <p style="margin-right: 30px;">Peminjaman ini dilangsungkan dan diterima untuk jangka waktu {{ $peminjaman->tanggal_pinjam }} sampai
                {{ $peminjaman->tanggal_kembali }}. Semua aset yang dipinjam harus dikembalikan dalam kondisi baik
                sesuai dengan yang tertera pada saat peminjaman. Segala kerusakan atau kehilangan yang terjadi pada aset
                selama masa peminjaman menjadi tanggung jawab peminjam.</p>

            <div class="row mt-7 pt-5">
                <div class="col-sm-6">
                    <p>Disetujui oleh,</p>

                    <p class="mt-5">(............................................)</p>
                    <p>Nama Penerima</p>
                </div>
                <div class="col-sm-6">
                    <p>Diterima oleh,</p>

                    <p class="mt-5">(............................................)</p>
                    <p>Nama Penyerah</p>
                </div>
            </div>

        </div>

    </div>



</div>
<script>
    window.print();
</script>
