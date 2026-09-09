@extends('layouts.app')

@section('title', 'Gallery Manager')
@section('page_heading', 'Hotel Photo Gallery Manager')

@section('styles')
<style>
    .gallery-upload-card {
        max-width: 760px;
        margin: 0 auto 30px auto;
    }

    .gallery-admin-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 24px;
    }

    .gallery-admin-card {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        display: flex;
        flex-direction: column;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .gallery-admin-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .gallery-admin-img-wrapper {
        position: relative;
        height: 180px;
        overflow: hidden;
        background: #0f172a;
    }

    .gallery-admin-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .gallery-category-pill {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(15, 23, 42, 0.85);
        color: #f59e0b;
        backdrop-filter: blur(4px);
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .gallery-admin-card-body {
        padding: 16px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .gallery-admin-title {
        font-family: 'Outfit', sans-serif;
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 6px;
    }

    .gallery-admin-date {
        font-size: 12px;
        color: #94a3b8;
        margin-bottom: 14px;
    }

    .btn-delete-img {
        width: 100%;
        padding: 8px;
        background-color: #fef2f2;
        color: #dc2626;
        border: 1px solid #fee2e2;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        text-align: center;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: all 0.2s ease;
    }

    .btn-delete-img:hover {
        background-color: #dc2626;
        color: #ffffff;
    }
</style>
@endsection

@section('content')
<!-- Upload New Gallery Image Card -->
<div class="card-custom gallery-upload-card">
    <div class="card-header-custom">
        <div class="card-title-custom">
            <i class="fa-solid fa-cloud-arrow-up text-primary"></i> Upload New Photo to Gallery
        </div>
    </div>

    <form action="{{ url('gallerycode') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label class="form-label" for="title">Photo Title / Caption</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="e.g. Sunset View from Infinity Pool" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="category">Photo Category</label>
                <select id="category" name="category" class="form-select" required>
                    <option value="Exterior">Exterior & Architecture</option>
                    <option value="Suites">Rooms & Suites</option>
                    <option value="Pool">Infinity Pool & Spa</option>
                    <option value="Dining">Fine Dining & Bar</option>
                    <option value="Lobby">Lobby & Lounge</option>
                    <option value="Events">Banquet & Events</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="image">Select Image File (JPG, PNG, WEBP)</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
        </div>

        <div style="margin-top: 20px;">
            <button type="submit" class="btn-primary-custom">
                <i class="fa-solid fa-upload"></i> Upload Image to Gallery
            </button>
        </div>
    </form>
</div>

<!-- Uploaded Photos Grid -->
<div class="card-custom">
    <div class="card-header-custom">
        <div class="card-title-custom">
            <i class="fa-solid fa-images text-primary"></i> Uploaded Gallery Photos ({{ count($galleries ?? []) }})
        </div>
        <a href="{{ url('/') }}#gallery" target="_blank" class="btn-secondary-custom">
            <i class="fa-solid fa-eye"></i> View Public Gallery
        </a>
    </div>

    @if(count($galleries ?? []) > 0)
    <div class="gallery-admin-grid">
        @foreach($galleries as $photo)
        <div class="gallery-admin-card">
            <div class="gallery-admin-img-wrapper">
                <img src="{{ asset($photo->image) }}" class="gallery-admin-img" alt="{{ $photo->title }}">
                <div class="gallery-category-pill">{{ $photo->category }}</div>
            </div>
            <div class="gallery-admin-card-body">
                <div>
                    <div class="gallery-admin-title">{{ $photo->title }}</div>
                    <div class="gallery-admin-date">
                        <i class="fa-regular fa-clock me-1"></i> {{ $photo->created_at->format('d M Y, h:i A') }}
                    </div>
                </div>
                <a href="{{ url('gallerydelete/'.$photo->id) }}" class="btn-delete-img" onclick="return confirm('Are you sure you want to delete this photo?')">
                    <i class="fa-solid fa-trash"></i> Delete Photo
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @if(method_exists($galleries, 'hasPages') && $galleries->hasPages())
    <div class="pagination-wrapper" style="justify-content: flex-end; margin-top: 24px;">
        {{ $galleries->links() }}
    </div>
    @endif
    @else
    <div style="text-align: center; padding: 40px; color: #94a3b8;">
        <i class="fa-solid fa-photo-film" style="font-size: 48px; margin-bottom: 12px;"></i>
        <p>No photos uploaded yet. Use the form above to upload your first hotel photo!</p>
    </div>
    @endif
</div>
@endsection