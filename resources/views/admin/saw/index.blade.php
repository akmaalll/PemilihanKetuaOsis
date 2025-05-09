@extends('admin._layouts.index')

@push($title)
    active
@endpush

@section('content')
    <!--begin::Toolbar-->
    @component('admin._card.breadcrumb')
        @slot('header')
            {{ $title }}
        @endslot
        @slot('page')
            Hasil Perhitungan
        @endslot
    @endcomponent
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">

            <!-- Kriteria -->
            <div class="card mb-5 mb-xl-8">
                <div class="card-header">
                    <h3 class="card-title">Kriteria Penilaian</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <thead>
                                <tr class="text-start text-gray-600 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-50px">No</th>
                                    <th class="min-w-150px">Kriteria</th>
                                    <th class="min-w-200px">Keterangan</th>
                                    <th class="min-w-100px">Bobot</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($results['data'] as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->kriteria }}</td>
                                        <td>{{ $item->ket }}</td>
                                        <td>{{ $item->poin }}%</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Matriks Awal -->
            <div class="card mb-5 mb-xl-8">
                <div class="card-header">
                    <h3 class="card-title">Matriks Awal</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <thead>
                                <tr class="text-start text-gray-600 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-50px">No</th>
                                    <th class="min-w-150px">Nama Calon</th>
                                    @foreach ($results['data'] as $item)
                                        <th class="min-w-100px">{{ $item->kode }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results['ketos'] as $index => $candidate)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $candidate->nama }}</td>
                                        {{-- {{ dd($results['data']) }} --}}
                                        @foreach ($results['data'] as $cIndex => $criteria)
                                            <td>{{ $results['infoMatrix'][$index][$cIndex] }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="fw-bold">
                                    <td colspan="2">Nilai Maksimum</td>
                                    @foreach ($results['rowMax'] as $value)
                                        <td>{{ $value }}</td>
                                    @endforeach
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Matriks Normalisasi -->
            <div class="card mb-5 mb-xl-8">
                <div class="card-header">
                    <h3 class="card-title">Matriks Normalisasi</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <thead>
                                <tr class="text-start text-gray-600 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-50px">No</th>
                                    <th class="min-w-150px">Nama Calon</th>
                                    @foreach ($results['data'] as $item)
                                        <th class="min-w-100px">{{ $item->kode }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results['ketos'] as $index => $candidate)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $candidate->nama }}</td>
                                        @foreach ($results['data'] as $cIndex => $criteria)
                                            <td>
                                                {{ number_format($results['kali'][$index][$cIndex], 3) }}
                                                <small
                                                    class="text-muted d-block">{{ $results['info'][$index][$cIndex] }}</small>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Hasil Perhitungan -->
            <div class="card mb-5 mb-xl-8">
                <div class="card-header">
                    <h3 class="card-title">Hasil Perhitungan</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <thead>
                                <tr class="text-start text-gray-600 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-50px">No</th>
                                    <th class="min-w-150px">Nama Calon</th>
                                    @foreach ($results['data'] as $item)
                                        <th class="min-w-150px">{{ $item->kode }}</th>
                                    @endforeach
                                    <th class="min-w-100px">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results['ketos'] as $index => $candidate)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $candidate->nama }}</td>
                                        @foreach ($results['data'] as $cIndex => $criteria)
                                            <td>
                                                <small class="text-muted">{{ $results['info'][$index][$cIndex] }}</small>
                                            </td>
                                        @endforeach
                                        <td class="fw-bold">{{ $results['hasil'][$index] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Ranking -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Hasil Ranking</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <thead>
                                <tr class="text-start text-gray-600 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-50px">Ranking</th>
                                    <th class="min-w-150px">Nama Calon</th>
                                    <th class="min-w-100px">Nilai Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // Gabungkan nama dan skor
                                    $combined = array_combine(
                                        $results['ranking']['nama'],
                                        $results['ranking']['hasil'],
                                    );

                                    // Urutkan dari nilai tertinggi ke terendah
                                    arsort($combined);

                                    // Cari nilai tertinggi
                                    $highestScore = !empty($combined) ? max($combined) : null;
                                @endphp

                                @foreach ($combined as $name => $score)
                                    <tr @if ($score == $highestScore) class="table-success" @endif>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $name }}</td>
                                        <td class="fw-bold @if ($score == $highestScore) text-success @endif">
                                            {{ number_format($score, 3) }}
                                            @if ($score == $highestScore)
                                                <span class="badge bg-success ms-2">Peringkat 1</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection

@push('jsScript')
    <script>
        $(document).ready(function() {
            // Inisialisasi datatable jika diperlukan
            $('.table').DataTable({
                dom: '<"top"f>rt<"bottom"lip><"clear">',
                pageLength: 10,
                responsive: true,
                ordering: false
            });
        });
    </script>
@endpush
