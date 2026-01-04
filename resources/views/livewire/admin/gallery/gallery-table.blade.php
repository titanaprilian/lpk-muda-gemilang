<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\GalleryImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

new class extends Component {
    use WithPagination;

    // Use Bootstrap pagination styles
    protected $paginationTheme = 'bootstrap';

    public string $search = '';

    // Refresh table when a gallery item is saved (created/edited)
    protected $listeners = ['gallery-saved' => '$refresh'];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    // Toggle Public/Private status
    public function toggleStatus($id)
    {
        $image = GalleryImage::find($id);
        if ($image) {
            $image->is_public = !$image->is_public;
            $image->save();

            // Optional: Dispatch alert if you have a toaster listener
            $this->dispatch('alert', type: 'success', message: 'Status visibilitas berhasil diperbarui.');
        }
    }

    public function delete($id)
    {
        $image = GalleryImage::find($id);

        if ($image) {
            // 1. Clean up file from storage
            if ($image->file_path) {
                Storage::disk('public')->delete($image->file_path);
            }

            // 2. Delete Record
            $image->delete();

            // 3. Notify User
            $this->dispatch('alert', type: 'success', message: 'Gambar berhasil dihapus.');
        }
    }

    public function with(): array
    {
        $images = GalleryImage::query()
            ->when($this->search, function (Builder $query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('upload_date', 'desc')
            ->paginate(10);

        return [
            'images' => $images,
        ];
    }
}; ?>

<div>
    <div class="card shadow-sm border-0 rounded-4">

        {{-- Card Header --}}
        <div class="card-header bg-white py-3 border-0 rounded-top-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary fw-bold">
                    <i class="fas fa-images me-2"></i> Galeri Kegiatan
                </h5>
                <div>
                    <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary shadow-sm fw-bold">
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
                                class="form-control border-start-0 ps-2" placeholder="Cari judul atau deskripsi...">
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
                            <th class="py-3" style="width: 10%">Preview</th>
                            <th class="py-3" style="width: 35%">Detail Gambar</th>
                            <th class="py-3" style="width: 15%">Status</th>
                            <th class="py-3" style="width: 20%">Tanggal Upload</th>
                            <th class="text-end pe-4 py-3" style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($images as $image)
                            <x-admin.gallery.table.table-row :image="$image" :index="$images->firstItem() + $loop->index" />
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center justify-content-center my-3">
                                        <div class="bg-light rounded-circle p-4 mb-3">
                                            <i class="fas fa-images fa-3x text-secondary opacity-25"></i>
                                        </div>
                                        <h6 class="fw-bold text-secondary mb-1">Tidak ada gambar ditemukan</h6>
                                        <p class="small text-muted mb-0">
                                            @if ($search)
                                                Tidak ada gambar yang cocok dengan keywords
                                                "<strong>{{ $search }}</strong>"
                                            @else
                                                Belum ada gambar yang diunggah ke galeri.
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
                {{ $images->links() }}
            </div>
        </div>
    </div>
</div>
