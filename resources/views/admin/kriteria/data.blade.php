@foreach ($data as $key => $v)
    <tr class="text-start text-gray-600 fs-7">
        <td>
            <span class="fw-semibold">
                {{ ++$i }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->kode }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->kriteria }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->ket }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->poin }}
            </span>
        </td>
        <td class="text-end">
            {!! Helper::btnAction($v->id, $title) !!}
        </td>
    </tr>
@endforeach
