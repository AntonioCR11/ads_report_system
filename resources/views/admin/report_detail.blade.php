{{-- INFO LAPORAN --}}
<div class="border-bottom border-dark">
    <div class="row">
        <div class="col">
            Report Id : {{ $report->id }} ({{ $report->ticket_id }})
        </div>
        <div class="col d-flex justify-content-end">
            <p>{{ $report->created_at }}</p>
        </div>
    </div>
</div>

<div class="row py-2">
    <div class="col-9">
        <h5>{{ $report->title }}</h5>
    </div>
    <div class="col-3 d-flex justify-content-end">

        <span class="btn btn-secondary d-flex align-items-center">
            @if ($report->status == 'Pending' || $report->status == 'Laporan Ditolak')
                * belum ditentukan
            @else
                {{ $report->category->name }}
            @endif
        </span>

    </div>
</div>

<p>{{ $report->description }}</p>

{{-- BUKTI MEDIA --}}
<div class="border-bottom border-dark py-2">
    @if (count($mediaItems) == 0)
        <h6>*Tidak ada media yang disertakan</h6>
    @endif
    <div class="row row-cols-3">
        @foreach ($mediaItems as $media)
            {{ $media->img() }}
        @endforeach
    </div>
</div>

{{-- DETAIL PELAPOR --}}
<div class="border-bottom border-dark py-2">
    <h5>Data Pelapor</h5>
    <p>
        Nomor Identitas : {{ $report->reporter->identity_number }} <br>
        Nama : {{ $report->reporter->name }} <br>
        Email : {{ $report->reporter->email }} <br>
        Telepon : {{ $report->reporter->phone_number }} <br>
        Alamat : {{ $report->reporter->address }} <br>
    </p>
</div>

{{-- RIWAYAT PENANGANAN --}}
<div class="border-bottom border-dark py-2">
    <h5>Riwayat Penanganan</h5>
    @forelse ($report->tracks as $track)
        <p class="pt-2">
            Track id : {{ $track->id }} <br>
            Note : {{ $track->note }} <br>
            Petugas : [{{ $track->user->id }}] - {{ $track->user->username }}/ {{ $track->user->name }}<br>
            @if ($track->status == 'Pending')
                <span class="btn btn-warning d-flex">
                    Status diubah menjadi '{{ $track->status }}' pada {{ $track->created_at }}
                </span>
            @elseif ($track->status == 'Proses Administratif')
                <span class="btn btn-secondary d-flex">
                    Status diubah menjadi '{{ $track->status }}' pada {{ $track->created_at }}
                </span>
            @elseif ($track->status == 'Proses Penanganan')
                <span class="btn btn-primary d-flex">
                    Status diubah menjadi '{{ $track->status }}' pada {{ $track->created_at }}
                </span>
            @elseif ($track->status == 'Selesai Ditangani')
                <span class="btn btn-success d-flex">
                    Status diubah menjadi '{{ $track->status }}' pada {{ $track->created_at }}
                </span>
            @elseif ($track->status == 'Laporan Ditolak')
                <span class="btn btn-danger d-flex">
                    Status diubah menjadi '{{ $track->status }}' pada {{ $track->created_at }}
                </span>
            @endif

        </p>
    @empty
        <p>* Belum ada riwayat penanganan!</p>
    @endforelse
</div>

{{-- FORM PENANGANAN --}}
@php
    $responsible_admin = -1;
    if (count($report->tracks) > 0) {
        $responsible_admin = $report->tracks[0]->user->id;
    }
@endphp
@if (($responsible_admin == $activeUser->id || $report->status == 'Pending') && !$activeUser->identity_number)
    <div class="border-bottom border-dark py-2">
        <h5>Form Penanganan</h5>
        @if ($report->status == 'Pending')
            <form method="post" action="/admin/report/proseslaporan/{{ $report->id }}">
                @csrf
                <div class="mb-2">
                    <label for="kategori">Kategori:</label>
                    <select name="kategori" id="kategori">
                        <option value="1">Infrastruktur</option>
                        <option value="2">Lingkungan</option>
                        <option value="3">Layanan Publik</option>
                        <option value="4">Keamanan</option>
                        <option value="5">Kesehatan</option>
                        <option value="6">Lain-lain</option>
                    </select>
                </div>
                <textarea name="note" id="note" class="w-100 mb-2 p-2" rows="4" placeholder="Tambahkan note..."></textarea>

                <div class="row">
                    <div class="col">
                        <input name="verifikasi" type="submit" value="Verifikasi Laporan"
                            class="btn btn-outline-dark d-flex justify-content-center w-100">
                    </div>
                    <div class="col">
                        <input name="tolak" type="submit" value="Tolak Laporan"
                            class="btn btn-outline-danger d-flex justify-content-center w-100">
                    </div>
                </div>
            </form>
        @elseif ($report->status == 'Proses Administratif' || $report->status == 'Proses Penanganan')
            <form method="post" action="/admin/report/proseslaporan/{{ $report->id }}">
                @csrf
                <div class="mb-2">
                    <label for="status">Status:</label>
                    <select name="status" id="status">
                        <option value="Pending">Pending</option>
                        <option value="Proses Administratif">Proses Administratif</option>
                        <option value="Proses Penanganan">Proses Penanganan</option>
                        <option value="Selesai Ditangani">Selesai Ditangani</option>
                        <option value="Laporan Ditolak">Laporan Ditolak</option>
                    </select>
                </div>
                <textarea name="note" id="note" class="w-100 mb-2 p-2" rows="4" placeholder="Tambahkan note..."></textarea>

                <input name="update" type="submit" value="Perbaharui Status"
                    class="btn btn-outline-dark d-flex justify-content-center w-100">
            </form>
        @elseif ($report->status == 'Selesai Ditangani')
            <span class="btn btn-success d-flex justify-content-center">
                Laporan sudah selesai ditangani!
            </span>
        @elseif ($report->status == 'Laporan Ditolak')
            <span class="btn btn-danger d-flex justify-content-center">
                Laporan ini ditolak!
            </span>
        @endif
    </div>
@endif
