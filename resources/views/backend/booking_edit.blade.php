@extends('layouts.app')

@section('title', 'Edit Booking')
@section('page_heading', 'Modify Reservation Details')

@section('content')
    <div class="card-custom" style="max-width: 760px; margin: 0 auto;">
        <div class="card-header-custom">
            <div class="card-title-custom">
                <i class="fa-solid fa-pen-to-square text-primary"></i> Edit Booking #{{ $data->id }}
            </div>
            <a href="{{ url('booking_show') }}" class="btn-secondary-custom">
                <i class="fa-solid fa-arrow-left"></i> Back to Bookings
            </a>
        </div>

        <form action="{{ url('booking_update/'.$data->id) }}" method="post">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label class="form-label" for="name">Guest Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $data->name }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="mobile">Mobile Number</label>
                    <input type="number" id="mobile" name="mobile" class="form-control" value="{{ $data->mobile }}" required>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ $data->email }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="guests">Guests Count</label>
                    <input type="number" id="guests" name="guests" min="1" max="10" value="{{ $data->guests }}" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="room_id">Select Room</label>
                <select id="room_id" name="room_id" class="form-select" required>
                    <option value="">Select Room</option>
                    @foreach($room as $r)
                        <option value="{{ $r->id }}" {{ $data->room_id == $r->id ? 'selected' : '' }}>
                            Room {{ $r->room_number }} - {{ ucfirst($r->type) }} (₹{{ number_format($r->price) }}/night)
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label class="form-label" for="check_in">Check-In Date</label>
                    <input type="date" id="check_in" name="check_in" class="form-control" value="{{ $data->check_in }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="check_out">Check-Out Date</label>
                    <input type="date" id="check_out" name="check_out" class="form-control" value="{{ $data->check_out }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="special_requests">Special Requests</label>
                <textarea id="special_requests" name="special_requests" class="form-control" rows="3">{{ $data->special_requests }}</textarea>
            </div>

            <div style="margin-top: 24px; display: flex; gap: 12px;">
                <button type="submit" class="btn-primary-custom">
                    <i class="fa-solid fa-floppy-disk"></i> Update Reservation
                </button>
                <a href="{{ url('booking_show') }}" class="btn-secondary-custom">Cancel</a>
            </div>
        </form>

        <hr style="margin: 30px 0; border: none; border-top: 1px solid #e2e8f0;">

        <!-- Quick Status Switch Form -->
        <form action="{{ url('booking_status/'.$data->id) }}" method="post" style="display: flex; align-items: center; gap: 16px;">
            @csrf
            <label class="form-label" style="margin: 0; white-space: nowrap;">Change Booking Status:</label>
            <select name="status" class="form-select" style="max-width: 220px;" onchange="this.form.submit()">
                <option value="pending" {{ $data->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $data->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="cancelled" {{ $data->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                <option value="completed" {{ $data->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </form>
    </div>
@endsection
