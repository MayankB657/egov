@foreach ($data as $user)
    <tr>
        <td>{{ ++$i }}</td>
        <td class="d-flex align-items-center border-0">
            @if ($user->photo == 'public/images/blank.svg')
                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                    <a href="{{ route('users.show', $user->id) }}">
                        <div class="symbol-label fs-3 {{ Helper::randomBsColor() }}">
                            {{ $user->name[0] }}
                        </div>
                    </a>
                </div>
            @else
                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                    <a href="{{ route('users.show', $user->id) }}">
                        <div class="symbol-label">
                            <img src="{{ url('/') }}/{{ $user->photo }}" alt="{{ $user->name[0] }}" class="w-100" />
                        </div>
                    </a>
                </div>
            @endif
            <div class="d-flex flex-column">
                <a href="{{ route('users.show', $user->id) }}"
                    class="text-gray-800 text-hover-primary mb-1">{{ $user->name }} <div
                        class="badge badge-secondary bg-hover-primary fw-bold"><span class="text-bold">id
                            :&nbsp;</span>{{ $user->id }}</div></a>
                <span class="CopyEmail cursor-pointer">{{ $user->email }}</span>
            </div>
        </td>
        <td>{{ ucfirst($user->roles[0]->name) }}</td>
        <td>
            @if ($user->is_online == 1)
                <div class="badge badge-success fw-bold" data-bs-trigger="hover" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="Last Activity : {{ Helper::DateHuman($user->last_active_at) }}">Online</div>
            @elseif ($user->is_online == 2)
                <div class="badge badge-warning fw-bold" data-bs-trigger="hover" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="Last Activity : {{ Helper::DateHuman($user->last_active_at) }}">Ideal</div>
            @else
                <div class="badge badge-light fw-bold">
                    {{ $user->current_login != null ? Helper::DateHuman($user->current_login) : 'NA' }}</div>
            @endif
        </td>
        <td>
            @if ($user->is_two_step)
                <div class="badge badge-light-success fw-bold">Enabled</div>
            @else
                <div class="badge badge-light fw-bold">-</div>
            @endif
        </td>
        <td>{{ Helper::datetimeFormat($user->created_at) }}</td>
        <td class="d-flex justify-content-end border-0">
            @can('users.edit')
                <a data-url="{{ route('users.edit', $user->id) }}"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 ajaxedit" data-bs-trigger="hover"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Click To Edit">
                    <i class="bi bi-vector-pen fs-3"></i>
                </a>
            @endcan
            @can('users.destroy')
                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm ConfirmDelete"
                        data-bs-trigger="hover" data-bs-toggle="tooltip" data-bs-placement="top" title="Click To Delete">
                        <i class="bi bi-trash fs-3"></i>
                    </button>
                </form>
            @endcan
        </td>
    </tr>
@endforeach
