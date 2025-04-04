@foreach ($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td class="d-flex align-items-center">
            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                <a href="#">
                    <div class="symbol-label">
                        <img src="{{ url('/') }}/{{ $user->photo }}" class="w-100 h-100" />
                    </div>
                </a>
            </div>
            <div class="d-flex flex-column">
                <a href="#" class="text-gray-800 text-hover-primary mb-1">{{ $user->name }}</a>
                <span>{{ $user->email }}</span>
            </div>
        </td>
        <td>{{ Helper::datetimeFormat($user->created_at) }}</td>
    </tr>
@endforeach
