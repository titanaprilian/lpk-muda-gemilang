<?php

use Livewire\Volt\Component;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\Storage;

new class extends Component {
    public GalleryImage $image;

    public function mount($id)
    {
        $this->image = GalleryImage::with('uploader')->findOrFail($id);
    }

    public function delete()
    {
        // 1. Delete Physical File
        if ($this->image->file_path) {
            Storage::disk('public')->delete($this->image->file_path);
        }

        // 2. Delete Record
        $this->image->delete();

        // 3. Notify & Redirect
        $this->dispatch('alert', type: 'success', message: 'Gambar berhasil dihapus permanen.');

        return redirect()->route('admin.galleries.index');
    }
}; ?>

<div class="page-wrapper">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-bold">
                Detail Gambar
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.galleries.index') }}" class="text-decoration-none">Galeri Kegiatan</a>
                    </li>
                    <li class="breadcrumb-item active text-muted">{{ Str::limit($image->title ?? 'Tanpa Judul', 30) }}
                    </li>
                </ol>
            </nav>
        </div>

        <div class="btn-group shadow-sm">
            <a href="{{ route('admin.galleries.index') }}" class="btn btn-light border">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
            <button wire:click="delete"
                wire:confirm="Yakin ingin menghapus gambar ini? File fisik juga akan dihapus dan aksi tidak dapat dibatalkan."
                class="btn btn-danger">
                <i class="fas fa-trash me-1"></i> Hapus
            </button>
        </div>
    </div>

    <div class="row g-4">
        {{-- Left Column: Main Image & Details --}}
        <div class="col-lg-8">
            <x-admin.gallery.show.image-detail-card :image="$image" />
        </div>

        {{-- Right Column: Meta & Actions --}}
        <div class="col-lg-4">
            <x-admin.gallery.show.meta-card :image="$image" />
        </div>
    </div>
</div>
