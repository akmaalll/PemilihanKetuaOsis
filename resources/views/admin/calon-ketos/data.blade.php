@foreach ($data as $key => $v)
    <tr class="text-start text-gray-600 fs-7">
        <td>
            <span class="fw-semibold">
                {{ ++$i }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->nama }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->kelas }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->jkl }}
            </span>
        </td>
        <td class="text-end">
            <a href="{{ route('calon-ketos.obser', $v->id) }}" class="">
                <button type="button" class="btn btn-icon btn-bg-secondary btn-active-color-primary btn-sm me-1">
                    <i class="ki-duotone ki-eye fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                </button>
            </a>
            {!! Helper::btnAction($v->id, $title) !!}
        </td>
    </tr>
@endforeach
