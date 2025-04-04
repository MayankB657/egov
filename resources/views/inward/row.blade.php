@foreach ($data as $row)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $row->inward_no }}</td>
        <td>{{ $row->outward_no }}</td>
        <td>{{ $row->subject->name }}</td>
        <td>{{ $row->letter_no }}</td>
        <td>{{ $row->status }}</td>
        <td>{{ Helper::dateFormat($row->created_at) }}</td>
        <td class="d-flex justify-content-end border-0">
            <a href="{{ route('inward-letter.edit', base64UrlEncode($row->id)) }}"
                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-trigger="hover"
                data-bs-toggle="tooltip" data-bs-placement="top" title="Click To Edit">
                <i class="bi bi-vector-pen fs-3"></i>
            </a>
            <form action="{{ route('inward-letter.destroy', base64UrlEncode($row->id)) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm ConfirmDelete"
                    data-bs-trigger="hover" data-bs-toggle="tooltip" data-bs-placement="top" title="Click To Delete">
                    <i class="bi bi-trash fs-3"></i>
                </button>
            </form>
        </td>
    </tr>
@endforeach
