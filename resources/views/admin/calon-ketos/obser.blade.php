@extends('admin._layouts.index')

{{-- @push('cssScript')
    @include('admin._layouts.partial._css')
@endpush --}}

{{-- @push('Data Master')
    here show
@endpush --}}

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
            Data
        @endslot
    @endcomponent
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Products-->
            <div class="card card-flush">

                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <div class="mw-100px me-3">
                            <select class="form-select form-select-solid me-3" data-control="select2" data-hide-search="true"
                                data-placeholder="Per Page" id="perPage">
                                <option>5</option>
                                <option>10</option>
                                <option>25</option>
                                <option>50</option>
                                <option>100</option>
                            </select>
                        </div>
                        <div class="d-flex">
                            <input id="input_search" type="text" class="form-control form-control-solid w-250px me-3"
                                placeholder="Search">
                            <input type="hidden" id="id" value="{{ $id }}">

                            <button id="button_search" class="btn btn-secondary me-3">
                                <span class="btn-label">
                                    <i class="fa fa-search"></i>
                                </span>
                            </button>

                            <button id="button_refresh" class="btn btn-secondary">
                                <span class="btn-label">
                                    <i class="fa fa-sync"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                    <!--end::Card title-->

                    <!--begin::Card toolbar-->
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <a href="{{ route('nilai-ketos.create', $id) }}" class="btn btn-success">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Add New
                        </a>
                    </div>
                    <!--end::Card toolbar-->
                </div>

                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                        <thead>
                            <tr class="text-start text-gray-600 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-20px pe-2"> No </th>
                                <th class="min-w-100"> Kode </th>
                                <th class="min-w-100px"> Kriteria </th>
                                <th class="min-w-120px"> Keterangan </th>
                                <th class="min-w-120px"> Point </th>
                                <th class="text-end min-w-70px"> Actions </th>
                            </tr>
                        </thead>

                        <tbody class="fw-semibold text-gray-600">
                            {{-- {{ dd($data) }} --}}
                            @foreach ($data as $i => $v)
                                <tr class="text-start text-gray-600 fs-7">
                                    <td>
                                        <span class="fw-semibold">
                                            {{ ++$i }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-semibold">
                                            {{ $v['nama'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-semibold">
                                            {{ $v['kriteria'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-semibold">
                                            {{ $v['ket'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-semibold">
                                            {{ $v['skor'] }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('nilai-ketos.edit', $v['id']) }}" class="">
                                            <button type="button"
                                                class="btn btn-icon btn-bg-secondary btn-active-color-primary btn-sm me-1">
                                                <i class="ki-duotone ki-pencil fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </button>
                                        </a>

                                        <form class="delete-form" method="POST"
                                            action="{{ url("admin/$title") }}/{{ $v['id'] }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="deleteData btn btn-icon btn-bg-secondary btn-active-color-primary btn-sm"
                                                data-id="{{ $v['id'] }}">
                                                <i class="ki-duotone ki-trash fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </button>
                                        </form>

                                        {{-- <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{ $v['id'] }}"
                                            title="Delete" class="deleteData">
                                            <button type="button"
                                                class="btn btn-icon btn-bg-secondary btn-active-color-primary btn-sm">
                                                <i class="ki-duotone ki-trash fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                </i>
                                            </button>
                                        </a> --}}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                    <!--end::Table-->

                    <!--begin::Pagination-->
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="d-flex flex-wrap py-2 mr-3">
                            <div class="text-center pagination">
                                <div id="contentPage"></div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center py-3">
                            <ul class="pagination twbs-pagination">
                            </ul>
                        </div>
                    </div>
                    <!--end::Pagination-->

                </div>



                <!--end::Card body-->
            </div>
            <!--end::Products-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection

@push('jsScript')
    <script type="text/javascript">
        $(document).ready(function() {
            loadpage(5, '', {{ $id }});
            var $pagination = $('.twbs-pagination');
            var defaultOpts = {
                totalPages: 1,
                prev: '&#8672;',
                next: '&#8674;',
                first: '&#8676;',
                last: '&#8677;',
            };
            $pagination.twbsPagination(defaultOpts);

            function loaddata(page, per_page, search, id) {
                $.ajax({
                    url: '{{ route($title . '.data') }}',
                    data: {
                        "page": page,
                        "per_page": per_page,
                        "search": search,
                        "id": id
                    },
                    type: "GET",
                    datatype: "json",
                    success: function(data) {
                        $(".datatables").html(data.html);
                    }
                });
            }

            function loadpage(per_page, search, id) {
                $.ajax({
                    url: '{{ route($title . '.data') }}',
                    data: {
                        "per_page": per_page,
                        "search": search,
                        "id": id
                    },
                    type: "GET",
                    datatype: "json",
                    success: function(response) {
                        if ($pagination.data("twbs-pagination")) {
                            $pagination.twbsPagination('destroy');
                            $(".datatables").html('<tr><td colspan="4">Data not found</td></tr>');
                        }
                        $pagination.twbsPagination($.extend({}, defaultOpts, {
                            startPage: 1,
                            totalPages: response.total_page,
                            visiblePages: 8,
                            prev: '&#8672;',
                            next: '&#8674;',
                            first: '&#8676;',
                            last: '&#8677;',
                            onPageClick: function(event, page) {
                                if (page == 1) {
                                    var to = 1;
                                } else {
                                    var to = page * per_page - (per_page - 1);
                                }
                                if (page == response.total_page) {
                                    var end = response.total_data;
                                } else {
                                    var end = page * per_page;
                                }
                                $('#contentPage').text('Showing ' + to + ' to ' + end +
                                    ' of ' +
                                    response.total_data + ' entries');
                                loaddata(page, per_page, search);
                            }
                        }));
                    }
                });
            }

            $("#button_search, #perPage").on('click change', function(event) {
                let search = $('#input_search').val();
                let per_page = $('#perPage').val() ?? 5;
                loadpage(per_page, search);
            });

            $("#button_refresh").on('click', function(event) {
                $('#input_search').val('');
                loadpage(5, '');
            });


            // proses delete data
            $('body').on('submit', '.delete-form', function(e) {
                e.preventDefault(); // Menghentikan submit form default

                var form = $(this);
                var id = form.find('.deleteData').data('id');
                var row = form.closest('tr'); // Untuk menghapus baris tabel nanti

                Swal.fire({
                    title: "Are you sure to Delete?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: form.attr('action'),
                            type: 'POST', // Method spoofing Laravel
                            data: {
                                _method: 'DELETE',
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                toastr.success(response.message ||
                                    "Data deleted successfully!");
                                row.fadeOut(400, function() {
                                    $(this).remove();
                                });

                                // Optional: Update counter atau data lain
                                updateDataCount();
                            },
                            error: function(xhr) {
                                toastr.error(xhr.responseJSON?.message ||
                                    "Failed to delete data");
                            }
                        });
                    }
                });
            });


        });
    </script>
@endpush
