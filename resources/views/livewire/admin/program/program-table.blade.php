<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Program;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

new class extends Component {
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public string $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function toggleStatus($id)
    {
        $program = Program::find($id);
        if ($program) {
            $program->is_active = !$program->is_active;
            $program->save();
            $this->dispatch('alert', type: 'success', message: 'Status program berhasil diperbarui.');
        }
    }

    public function delete($id)
    {
        $program = Program::find($id);

        if ($program) {
            // Check if Image exists and delete it
            if ($program->image) {
                Storage::disk('public')->delete($program->image);
            }

            $program->delete();
            $this->dispatch('alert', type: 'success', message: 'Program berhasil dihapus.');
        }
    }

    public function with(): array
    {
        $programs = Program::query()
            ->when($this->search, function (Builder $query) {
                $query->where('program_name', 'like', '%' . $this->search . '%')->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->latest() // Newest first
            ->paginate(10);

        return [
            'programs' => $programs,
        ];
    }
}; ?>

<div>
    <div class="card shadow-sm border-0 rounded-4">

        {{-- Card Header --}}
        <div class="card-header bg-white py-3 border-0 rounded-top-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary fw-bold">
                    <i class="fas fa-chalkboard-teacher me-2"></i> Daftar Program
                </h5>
                <div>
                    <a href="{{ route('admin.programs.create') }}" class="btn btn-primary shadow-sm fw-bold">
                        <i class="fas fa-plus me-1"></i> Tambah Program
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
                                class="form-control border-start-0 ps-2" placeholder="Cari program...">
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
                            <th class="py-3" style="width: 10%">Gambar</th>
                            <th class="py-3" style="width: 45%">Nama Program</th>
                            <th class="py-3" style="width: 15%">Status</th>
                            <th class="text-end pe-4 py-3" style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($programs as $program)
                            <x-admin.program.table.table-row :program="$program" :index="$programs->firstItem() + $loop->index" />
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center justify-content-center my-3">
                                        <div class="bg-light rounded-circle p-4 mb-3">
                                            <i class="fas fa-chalkboard-teacher fa-3x text-secondary opacity-25"></i>
                                        </div>
                                        <h6 class="fw-bold text-secondary mb-1">Tidak ada program ditemukan</h6>
                                        <p class="small text-muted mb-0">
                                            @if ($search)
                                                Tidak ada yang cocok dengan "<strong>{{ $search }}</strong>"
                                            @else
                                                Belum ada program yang ditambahkan.
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

        {{-- Pagination --}}
        <div class="card-footer bg-white border-0 py-3 rounded-bottom-4">
            <div class="d-flex justify-content-end">
                {{ $programs->links() }}
            </div>
        </div>
    </div>
</div>
