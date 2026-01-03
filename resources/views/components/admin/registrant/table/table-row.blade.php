@props(['registrant', 'index'])

<tr>
    {{-- Number --}}
    <td class="ps-4 fw-bold text-secondary">{{ $index }}</td>

    {{-- Name & Details --}}
    <td>
        <div class="d-flex flex-column">
            <span class="fw-bold text-dark">{{ $registrant->full_name }}</span>
            <div class="small text-muted d-flex align-items-center gap-1">
                @if ($registrant->gender)
                    <span class="badge bg-light text-secondary border rounded-pill px-2 py-0 fw-normal">
                        <i class="fas fa-{{ $registrant->gender == 'Laki-laki' ? 'mars' : 'venus' }} me-1"></i>
                        {{ $registrant->gender }}
                    </span>
                @endif
                @if ($registrant->age)
                    <span>• {{ $registrant->age }} th</span>
                @endif
            </div>
        </div>
    </td>

    {{-- Contact --}}
    <td>
        <div class="d-flex flex-column gap-1">
            <a href="mailto:{{ $registrant->email }}" class="text-decoration-none text-muted small">
                <i class="fas fa-envelope me-2 text-primary opacity-50"></i>{{ $registrant->email }}
            </a>
            @if ($registrant->phone_number)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $registrant->phone_number) }}" target="_blank"
                    class="text-decoration-none text-muted small">
                    <i class="fab fa-whatsapp me-2 text-success"></i>{{ $registrant->phone_number }}
                </a>
            @endif
        </div>
    </td>

    {{-- Program --}}
    <td>
        <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill">
            {{ $registrant->program->program_name ?? '-' }}
        </span>
    </td>

    {{-- Status --}}
    <td>
        @php
            $statusConfig = match ($registrant->status) {
                'Pending' => ['color' => 'warning', 'icon' => 'clock'],
                'Verified' => ['color' => 'info', 'icon' => 'check-circle'],
                'Accepted' => ['color' => 'success', 'icon' => 'check-double'],
                'Rejected' => ['color' => 'danger', 'icon' => 'times-circle'],
                default => ['color' => 'secondary', 'icon' => 'question-circle'],
            };
        @endphp
        <span class="badge bg-{{ $statusConfig['color'] }} rounded-pill d-inline-flex align-items-center gap-1">
            <i class="fas fa-{{ $statusConfig['icon'] }}"></i>
            {{ $registrant->status }}
        </span>
    </td>

    {{-- Date --}}
    <td>
        <div class="small text-muted">
            <i class="far fa-calendar me-1"></i>
            {{ $registrant->registration_date->format('d M Y') }}
        </div>
        <div class="small text-muted opacity-75" style="font-size: 0.75rem;">
            {{ $registrant->registration_date->format('H:i') }} WIB
        </div>
    </td>

    {{-- Actions --}}
    <td class="text-end pe-4">
        <div class="dropdown">
            <button class="btn btn-sm btn-light border rounded-pill px-3" type="button" data-bs-toggle="dropdown"
                aria-expanded="false" data-bs-boundary="viewport" data-bs-popper-config='{"strategy":"fixed"}'>
                <i class="fas fa-ellipsis-h text-muted"></i>
            </button>

            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="z-index: 1050;">
                {{-- ... menu items ... --}}
                <li>
                    <h6 class="dropdown-header text-uppercase small ls-1">Menu</h6>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.registrants.view', $registrant->id) }}">
                        <i class="fas fa-eye me-2 text-primary"></i> Detail
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.registrants.edit', $registrant->id) }}">
                        <i class="fas fa-edit me-2 text-warning"></i> Edit
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <button class="dropdown-item text-danger" wire:click="delete({{ $registrant->id }})"
                        wire:confirm="Hapus data {{ $registrant->full_name }}?">
                        <i class="fas fa-trash me-2"></i> Hapus
                    </button>
                </li>
            </ul>
        </div>
    </td>
</tr>
