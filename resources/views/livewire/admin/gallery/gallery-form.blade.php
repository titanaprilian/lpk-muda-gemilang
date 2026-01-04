<?php

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use App\Models\GalleryImage;
use App\Livewire\Forms\GalleryImageForm;

new class extends Component {
    use WithFileUploads;

    public GalleryImageForm $form;

    public function mount($id = null)
    {
        if ($id) {
            $image = GalleryImage::findOrFail($id);
            $this->form->setGalleryImage($image);
        }
    }

    public function save()
    {
        // 1. Check if we are editing BEFORE calling store() (which resets the form)
        $isEdit = !is_null($this->form->galleryImage);

        // 2. Save the data
        $this->form->store();

        // 3. Redirect using the captured status
        return redirect()
            ->route('admin.galleries.index')
            ->with('success', $isEdit ? 'Data gambar berhasil diperbarui.' : 'Gambar baru berhasil ditambahkan.');
    }
}; ?>

<div class="gallery-form-wrapper">

    {{-- Global Error Alert --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <h6 class="alert-heading fw-bold">
                <i class="fas fa-exclamation-triangle me-2"></i>Terdapat Kesalahan Input!
            </h6>
            <ul class="mb-0 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form wire:submit="save">

        {{-- 1. Header Section --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1 text-dark">
                    {{ $form->galleryImage ? 'Edit Gambar' : 'Upload Gambar Baru' }}
                </h4>
                <p class="text-muted mb-0 small">
                    {{ $form->galleryImage ? 'Perbarui informasi gambar #' . $form->galleryImage->id : 'Unggah dokumentasi kegiatan baru ke galeri' }}
                </p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.galleries.index') }}" class="btn btn-light border shadow-sm">
                    <i class="fas fa-times me-1"></i> Batal
                </a>
                {{-- Header Save Button (Optional secondary save button) --}}
                <button type="submit" class="btn btn-primary px-4 shadow-sm fw-bold" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="save, form.image">
                        <i class="fas fa-save me-1"></i> Simpan Data
                    </span>
                    <span wire:loading wire:target="save, form.image">
                        <i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...
                    </span>
                </button>
            </div>
        </div>

        <div class="row g-4">

            {{-- 2. Left Column: Main Content --}}
            <div class="col-lg-8">

                {{-- Component: Image Upload --}}
                <x-admin.gallery.form.image-upload-card :form="$form" />

                {{-- Component: Details --}}
                <x-admin.gallery.form.detail-info-card :form="$form" />

            </div>

            {{-- 3. Right Column: Sidebar --}}
            <div class="col-lg-4">

                {{-- Component: Publish Settings --}}
                <x-admin.gallery.form.publish-card :form="$form" />

            </div>
        </div>
    </form>
</div>
