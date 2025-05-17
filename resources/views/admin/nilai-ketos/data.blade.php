@foreach ($data as $key => $v)
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
                <button type="button" class="btn btn-icon btn-bg-secondary btn-active-color-primary btn-sm me-1">
                    <i class="ki-duotone ki-pencil fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </button>
            </a>

            <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{ $v['id'] }}" title="Delete"
                class="deleteData">
                <button type="button" class="btn btn-icon btn-bg-secondary btn-active-color-primary btn-sm">
                    <i class="ki-duotone ki-trash fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                        <span class="path5"></span>
                    </i>
                </button>
            </a>
        </td>
    </tr>
@endforeach
