@foreach ($data as $row)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $row->name }}</td>
        <td class="d-flex justify-content-end border-0">
            <a href="{{ route('department.edit', $row->id) }}"
                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-trigger="hover"
                data-bs-toggle="tooltip" data-bs-placement="top" title="Click To Edit">
                <i class="bi bi-vector-pen fs-3"></i>
            </a>
            <form action="{{ route('department.destroy', $row->id) }}" method="POST">
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
