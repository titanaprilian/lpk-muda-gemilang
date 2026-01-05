@props(['program', 'index'])

<tr>
    {{-- 1. Index --}}
    <td class="ps-4 fw-bold text-secondary">{{ $index }}</td>

    {{-- 2. Image --}}
    <td>
        @if ($program->image)
            <img src="{{ asset('storage/' . $program->image) }}" alt="Icon" class="rounded shadow-sm border"
                style="width: 50px; height: 50px; object-fit: cover;">
        @else
            <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted border"
                style="width: 50px; height: 50px;">
                <i class="fas fa-cube"></i>
            </div>
        @endif
    </td>

    {{-- 3. Program Name & Desc --}}
    <td>
        <div class="d-flex flex-column">
            <span class="fw-bold text-dark">{{ $program->program_name }}</span>
            <small class="text-muted text-truncate" style="max-width: 300px;">
                {{ $program->description ?? '-' }}
            </small>
        </div>
    </td>

    {{-- 4. Status --}}
    <td>
        <button wire:click="toggleStatus({{ $program->id }})"
            class="btn badge rounded-pill border-0 d-inline-flex align-items-center gap-1 {{ $program->is_active ? 'bg-success' : 'bg-secondary' }}"
            title="Klik untuk mengubah status">
            <i class="fas fa-{{ $program->is_active ? 'check-circle' : 'ban' }}"></i>
            {{ $program->is_active ? 'Aktif' : 'Non-Aktif' }}
        </button>
    </td>

    {{-- 5. Actions --}}
    <td class="text-end pe-4">
        <div class="dropdown">
            <button class="btn btn-sm btn-light border rounded-pill px-3" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fas fa-ellipsis-h text-muted"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                <li>
                    <h6 class="dropdown-header text-uppercase small ls-1">Menu</h6>
                </li>

                <li>
                    <a class="dropdown-item" href="{{ route('admin.programs.view', $program->id) }}">
                        <i class="fas fa-eye me-2 text-primary"></i> Detail
                    </a>
                </li>

                {{-- Edit --}}
                <li>
                    <a class="dropdown-item" href="{{ route('admin.programs.edit', $program->id) }}">
                        <i class="fas fa-edit me-2 text-warning"></i> Edit
                    </a>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                {{-- Delete --}}
                <li>
                    <button class="dropdown-item text-danger" wire:click="delete({{ $program->id }})"
                        wire:confirm="Yakin ingin menghapus program ini?">
                        <i class="fas fa-trash me-2"></i> Hapus
                    </button>
                </li>
            </ul>
        </div>
    </td>
</tr>
