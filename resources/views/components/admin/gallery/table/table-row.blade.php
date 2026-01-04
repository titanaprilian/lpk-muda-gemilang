@props(['image', 'index'])

<tr>
    {{-- 1. Index --}}
    <td class="ps-4 fw-bold text-secondary">{{ $index }}</td>

    {{-- 2. Image Preview --}}
    <td>
        <div class="position-relative d-inline-block">
            <img src="{{ $image->url }}" alt="Preview" class="rounded shadow-sm border"
                style="width: 60px; height: 60px; object-fit: cover;">

            {{-- Optional: Zoom Icon overlay on hover could go here --}}
        </div>
    </td>

    {{-- 3. Title & Description --}}
    <td>
        <div class="d-flex flex-column">
            <span class="fw-bold text-dark">{{ $image->title ?? 'Tanpa Judul' }}</span>
            <div class="small text-muted text-truncate" style="max-width: 250px;">
                {{ $image->description ?? 'Tidak ada deskripsi tersedia.' }}
            </div>
        </div>
    </td>

    {{-- 4. Status (Clickable Toggle) --}}
    <td>
        @php
            $status = $image->is_public
                ? ['label' => 'Publik', 'color' => 'success', 'icon' => 'globe']
                : ['label' => 'Privat', 'color' => 'secondary', 'icon' => 'lock'];
        @endphp

        {{-- We make this a button so you can toggle status directly --}}
        <button wire:click="toggleStatus({{ $image->id }})"
            class="btn badge bg-{{ $status['color'] }} rounded-pill d-inline-flex align-items-center gap-1 border-0"
            style="cursor: pointer; transition: all 0.2s;" title="Klik untuk ubah status">
            <i class="fas fa-{{ $status['icon'] }}"></i>
            {{ $status['label'] }}
        </button>
    </td>

    {{-- 5. Upload Date --}}
    <td>
        <div class="small text-muted">
            <i class="far fa-calendar me-1"></i>
            {{ $image->upload_date->format('d M Y') }}
        </div>
        <div class="small text-muted opacity-75" style="font-size: 0.75rem;">
            {{ $image->upload_date->format('H:i') }} WIB
        </div>
    </td>

    {{-- 6. Actions Dropdown --}}
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
                    <a class="dropdown-item" href="{{ route('admin.galleries.view', $image->id) }}">
                        <i class="fas fa-eye me-2 text-primary"></i> Detail
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.galleries.edit', $image->id) }}">
                        <i class="fas fa-edit me-2 text-warning"></i> Edit
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <button class="dropdown-item text-danger" wire:click="delete({{ $image->id }})"
                        wire:confirm="Hapus data {{ $image->title }}?">
                        <i class="fas fa-trash me-2"></i> Hapus
                    </button>
                </li>
            </ul>
        </div>
    </td>
</tr>
