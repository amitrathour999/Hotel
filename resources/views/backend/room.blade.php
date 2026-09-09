@extends('layouts.app')

@section('title', 'Add Room')
@section('page_heading', 'Add New Hotel Room')

@section('content')
    <div class="card-custom" style="max-width: 700px; margin: 0 auto;">
        <div class="card-header-custom">
            <div class="card-title-custom">
                <i class="fa-solid fa-bed text-primary"></i> Room Details Form
            </div>
            <a href="{{ url('roomshow') }}" class="btn-secondary-custom">
                <i class="fa-solid fa-arrow-left"></i> View All Rooms
            </a>
        </div>

        <form action="{{ url('roomcode') }}" method="post">
            @csrf

            <div class="form-group">
                <label class="form-label" for="room_number">Room Number</label>
                <input type="number" id="room_number" name="room_number" class="form-control" placeholder="e.g. 101" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label class="form-label" for="type">Room Type</label>
                    <select id="type" name="type" class="form-select" required>
                        <option value="single">Single Room</option>
                        <option value="double">Double Room</option>
                        <option value="deluxe">Deluxe Suite</option>
                        <option value="suite">Executive Suite</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="price">Price per Night (₹)</label>
                    <input type="number" id="price" name="price" class="form-control" placeholder="e.g. 2500" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="status">Initial Availability Status</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="available">Available</option>
                    <option value="booked">Booked</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="description">Room Amenities & Description</label>
                <textarea id="description" name="description" class="form-control" rows="4" placeholder="Describe room view, king bed, AC, Wi-Fi, balcony etc." required></textarea>
            </div>

            <div style="margin-top: 24px; display: flex; gap: 12px;">
                <button type="submit" class="btn-primary-custom">
                    <i class="fa-solid fa-plus-circle"></i> Save Room
                </button>
                <a href="{{ url('roomshow') }}" class="btn-secondary-custom">Cancel</a>
            </div>
        </form>
    </div>
@endsection