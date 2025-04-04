@foreach ($data as $key => $value)
    <tr class="fs-6 fw-normal">
        <td>{{ ++$i }}</td>
        <td>{{ $value->controller }}</td>
        <td>{{ $value->name }}</td>
        <td class="d-flex justify-content-end border-0">
            <a href="{{ route('permission-listing.edit', $value->id) }}"
                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-trigger="hover"
                data-bs-toggle="tooltip" data-bs-placement="top" title="Click To Edit">
                <i class="bi bi-vector-pen fs-3"></i>
            </a>
            <form action="{{ route('permission-listing.destroy', $value->id) }}" method="POST">
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
