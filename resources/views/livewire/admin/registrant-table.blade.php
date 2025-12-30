<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Registrant;
use Illuminate\Database\Eloquent\Builder;

new class extends Component {
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public string $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $registrant = Registrant::findOrFail($id);
        $registrant->delete();
        $this->dispatch('alert', type: 'success', message: 'Data berhasil dihapus.');
    }

    public function with(): array
    {
        $registrants = Registrant::query()
            ->with('program')
            ->when($this->search, function (Builder $query) {
                $query->where('full_name', 'like', '%' . $this->search . '%')->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->latest('registration_date')
            ->paginate(10);

        return [
            'registrants' => $registrants,
        ];
    }
}; ?>

<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-primary">
                <i class="fas fa-users me-2"></i> Daftar Peserta
            </h5>
            <div>
                <a href="{{ route('admin.registrants.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Baru
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        {{-- Search Bar --}}
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" wire:model.live.debounce.300ms="search"
                        class="form-control border-start-0 ps-0" placeholder="Cari nama, no.reg, atau email...">
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No. </th>
                        <th>Nama Lengkap</th>
                        <th>Program</th>
                        <th>Status</th>
                        <th>Tanggal Daftar</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($registrants as $registrant)
                        <tr wire:key="{{ $registrant->id }}">
                            <td class="fw-bold text-center">
                                {{ $registrants->firstItem() + $loop->index }}
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="fw-medium">{{ $registrant->full_name }}</span>
                                    <small class="text-muted">{{ $registrant->email }}</small>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info text-dark bg-opacity-10 border border-info">
                                    {{ $registrant->program->program_name ?? '-' }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $statusColor = match ($registrant->status) {
                                        'Pending' => 'warning',
                                        'Verified' => 'info',
                                        'Accepted' => 'success',
                                        'Rejected' => 'danger',
                                        default => 'secondary',
                                    };
                                @endphp
                                <span class="badge bg-{{ $statusColor }}">{{ $registrant->status }}</span>
                            </td>
                            <td>{{ $registrant->registration_date->format('d M Y') }}</td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <a href="{{ route('admin.registrants.edit', $registrant->id) }}"
                                        class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button wire:click="delete({{ $registrant->id }})"
                                        wire:confirm="Hapus data {{ $registrant->full_name }}?"
                                        class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="empty-state">
                                    <div class="empty-state-icon mb-3">
                                        <i class="fas fa-inbox fa-2x text-muted opacity-75"></i>
                                    </div>
                                    <h6 class="text-muted mb-1">Tidak ada data ditemukan</h6>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $registrants->links() }}
        </div>
    </div>
</div>
