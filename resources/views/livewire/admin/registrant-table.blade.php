<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Registrant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

new class extends Component {
    use WithPagination;

    // Use Bootstrap pagination styles
    protected $paginationTheme = 'bootstrap';

    public string $search = '';

    // Reset page to 1 when search query changes
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $registrant = Registrant::findOrFail($id);

        // 1. Clean up uploaded files to save storage space
        $fileColumns = ['scan_ktp', 'scan_kk', 'scan_akta', 'scan_ijazah_sd', 'scan_ijazah_smp', 'scan_ijazah_sma'];

        foreach ($fileColumns as $column) {
            if ($registrant->$column) {
                Storage::disk('public')->delete($registrant->$column);
            }
        }

        // 2. Delete Record
        $registrant->delete();

        // 3. Notify User
        $this->dispatch('alert', type: 'success', message: 'Data peserta dan dokumen berhasil dihapus.');
    }

    public function with(): array
    {
        $registrants = Registrant::query()
            ->with('program') // Eager load to prevent N+1 queries
            ->when($this->search, function (Builder $query) {
                // Group OR conditions to avoid logic errors
                $query->where(function ($q) {
                    $q->where('full_name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('phone_number', 'like', '%' . $this->search . '%');
                });
            })
            ->latest('registration_date')
            ->paginate(10);

        return [
            'registrants' => $registrants,
        ];
    }
}; ?>

<div>
    <div class="card shadow-sm border-0 rounded-4">

        {{-- Card Header --}}
        <div class="card-header bg-white py-3 border-0 rounded-top-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary fw-bold">
                    <i class="fas fa-users me-2"></i> Daftar Peserta
                </h5>
                <div>
                    <a href="{{ route('admin.registrants.create') }}" class="btn btn-primary shadow-sm fw-bold">
                        <i class="fas fa-plus me-1"></i> Tambah Baru
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            {{-- Search Bar --}}
            <div class="p-3 border-bottom bg-light bg-opacity-10">
                <div class="row">
                    <div class="col-md-5 col-lg-4">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted ps-3">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" wire:model.live.debounce.300ms="search"
                                class="form-control border-start-0 ps-2" placeholder="Cari nama, email, atau no.hp...">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="text-uppercase small text-muted text-nowrap">
                            <th class="ps-4 py-3" style="width: 5%">No.</th>
                            <th class="py-3" style="width: 25%">Nama Lengkap</th>
                            <th class="py-3" style="width: 20%">Kontak</th>
                            <th class="py-3" style="width: 15%">Program</th>
                            <th class="py-3" style="width: 10%">Status</th>
                            <th class="py-3" style="width: 15%">Tanggal Daftar</th>
                            <th class="text-end pe-4 py-3" style="width: 10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($registrants as $registrant)
                            <x-admin.registrant.table.table-row :registrant="$registrant" :index="$registrants->firstItem() + $loop->index" />
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center justify-content-center my-3">
                                        <div class="bg-light rounded-circle p-4 mb-3">
                                            <i class="fas fa-inbox fa-3x text-secondary opacity-25"></i>
                                        </div>
                                        <h6 class="fw-bold text-secondary mb-1">Tidak ada data ditemukan</h6>
                                        <p class="small text-muted mb-0">
                                            @if ($search)
                                                Tidak ada peserta yang cocok dengan keywords
                                                "<strong>{{ $search }}</strong>"
                                            @else
                                                Belum ada data peserta yang terdaftar.
                                            @endif
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination Footer --}}
        <div class="card-footer bg-white border-0 py-3 rounded-bottom-4">
            <div class="d-flex justify-content-end">
                {{ $registrants->links() }}
            </div>
        </div>
    </div>
</div>
