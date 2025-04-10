@if ($data->isEmpty())
    <tr>
        <td colspan="10" class="text-center text-muted fs-6 fw-bold">{{ __('labels.no_records_found') }}</td>
    </tr>
@else
    @foreach ($data as $row)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $row->subject->name }}</td>
            <td>{{ Str::limit($row->description, 100, '...') }}</td>
            <td>{{ $row->topic_type }}</td>
            <td>{{ $row->topic_type == 'File' ? $row->rack_no : $row->letter_no }}</td>
            <td>{{ $row->received_from_name }}</td>
            <td>
                <span class="badge badge-{{ Helper::statusColor($row->status) }} badgeStatus"
                    data-id="{{ base64UrlEncode($row->id) }}">{{ $row->status }}</span>
            </td>
            <td>
                @php
                    $latestLog = $row->logs->sortByDesc('created_at')->first();
                @endphp
                @if ($latestLog?->officer_name)
                    <div>{{ $latestLog?->officer_name }}</div>
                    <div>{{ $latestLog?->officer_designation }}</div>
                    <div>{{ $latestLog?->remark }}</div>
                    <div class="badge badge-secondary">{{ Helper::dateFormat($latestLog?->created_at) }}</div>
                @else
                    {{ $latestLog?->status }}
                @endif
            </td>
            <td>{{ $row->concerned_officer }}</td>
            <td>{{ Helper::dateFormat($row->created_at) }}</td>
            <td class="d-flex justify-content-end border-0">
                <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 addComment"
                    data-id="{{ base64UrlEncode($row->id) }}" type="button" data-bs-trigger="hover"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Click To Add Comment">
                    <i class="bi bi-chat-right-dots-fill fs-3"></i>
                </button>
                <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 addFollowup"
                    data-id="{{ base64UrlEncode($row->id) }}" type="button" data-bs-trigger="hover"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Click To Add Follow Up">
                    <i class="bi bi-clock-history fs-3"></i>
                </button>
                <a href="{{ route('case.show', base64UrlEncode($row->id)) }}"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-trigger="hover"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Click To View">
                    <i class="bi bi-eye fs-3"></i>
                </a>
                <a href="{{ route('case.edit', base64UrlEncode($row->id)) }}"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-trigger="hover"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Click To Edit">
                    <i class="bi bi-vector-pen fs-3"></i>
                </a>
            </td>
        </tr>
    @endforeach
@endif
