@extends('layouts.app')

@section('title', 'Edit Room')
@section('page_heading', 'Edit Room Details')

@section('content')
    <div class="card-custom" style="max-width: 700px; margin: 0 auto;">
        <div class="card-header-custom">
            <div class="card-title-custom">
                <i class="fa-solid fa-pen-to-square text-primary"></i> Edit Room #{{ $data->room_number }}
            </div>
            <a href="{{ url('roomshow') }}" class="btn-secondary-custom">
                <i class="fa-solid fa-arrow-left"></i> Back to Rooms List
            </a>
        </div>

        <form action="{{ url('roomupdate/'.$data->id) }}" method="post">
            @csrf

            <div class="form-group">
                <label class="form-label" for="room_number">Room Number</label>
                <input type="number" id="room_number" name="room_number" class="form-control" value="{{ $data->room_number }}" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label class="form-label" for="type">Room Type</label>
                    <select id="type" name="type" class="form-select" required>
                        <option value="single" {{ strtolower($data->type) == 'single' ? 'selected' : '' }}>Single Room</option>
                        <option value="double" {{ strtolower($data->type) == 'double' ? 'selected' : '' }}>Double Room</option>
                        <option value="deluxe" {{ strtolower($data->type) == 'deluxe' ? 'selected' : '' }}>Deluxe Suite</option>
                        <option value="suite" {{ strtolower($data->type) == 'suite' ? 'selected' : '' }}>Executive Suite</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="price">Price per Night (₹)</label>
                    <input type="number" id="price" name="price" class="form-control" value="{{ $data->price }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="status">Availability Status</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="available" {{ $data->status == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="booked" {{ $data->status == 'booked' ? 'selected' : '' }}>Booked</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="description">Room Description</label>
                <textarea id="description" name="description" class="form-control" rows="4" required>{{ $data->description }}</textarea>
            </div>

            <div style="margin-top: 24px; display: flex; gap: 12px;">
                <button type="submit" class="btn-primary-custom">
                    <i class="fa-solid fa-floppy-disk"></i> Update Room Details
                </button>
                <a href="{{ url('roomshow') }}" class="btn-secondary-custom">Cancel</a>
            </div>
        </form>
    </div>
@endsection