@extends('layouts.app')

@section('title', 'Bookings List')
@section('page_heading', 'Manage Reservations')

@section('content')
    <div class="card-custom">
        <div class="card-header-custom">
            <div class="card-title-custom">
                <i class="fa-solid fa-book-bookmark text-primary"></i> All Hotel Bookings
            </div>
            <a href="{{ url('booking') }}" class="btn-primary-custom">
                <i class="fa-solid fa-plus"></i> New Reservation
            </a>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Guest Details</th>
                        <th>Room Details</th>
                        <th>Dates</th>
                        <th>Guests</th>
                        <th>Requests</th>
                        <th>Status</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($booking as $book)
                        <tr>
                            <td>#{{ $book->id }}</td>
                            <td>
                                <strong>{{ $book->name }}</strong><br>
                                <small class="text-muted"><i class="fa-solid fa-envelope me-1"></i>{{ $book->email }}</small><br>
                                <small class="text-muted"><i class="fa-solid fa-phone me-1"></i>{{ $book->mobile }}</small>
                            </td>
                            <td>
                                <strong>Room {{ $book->room->room_number ?? '-' }}</strong><br>
                                <span class="badge-status badge-completed" style="font-size: 11px;">
                                    {{ ucfirst($book->room->type ?? 'Room') }}
                                </span><br>
                                <small class="text-muted">₹{{ number_format($book->room->price ?? 0) }}/night</small>
                            </td>
                            <td>
                                <div><small class="text-muted">In:</small> <strong>{{ $book->check_in }}</strong></div>
                                <div><small class="text-muted">Out:</small> <strong>{{ $book->check_out }}</strong></div>
                            </td>
                            <td>
                                <i class="fa-solid fa-users me-1 text-muted"></i> {{ $book->guests }}
                            </td>
                            <td style="max-width: 180px;">
                                <span class="text-muted" style="font-size: 12px;">{{ $book->special_requests ?? 'None' }}</span>
                            </td>
                            <td>
                                <form action="{{ url('booking_status/'.$book->id) }}" method="POST">
                                    @csrf
                                    <select name="status" class="form-select" style="padding: 6px 10px; font-size: 12px; width: 120px;" onchange="this.form.submit()">
                                        <option value="pending" {{ $book->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $book->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="cancelled" {{ $book->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        <option value="completed" {{ $book->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </form>
                            </td>
                            <td style="text-align: right; white-space: nowrap;">
                                @if($book->status == 'pending')
                                    <form action="{{ url('booking_status/'.$book->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="action-link" style="background: #dcfce7; color: #15803d; border: 1px solid #86efac; cursor: pointer;">
                                            <i class="fa-solid fa-circle-check"></i> Confirm
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ url('booking_edit/'.$book->id) }}" class="action-link action-edit">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </a>
                                <a href="{{ url('booking_delete/'.$book->id) }}" class="action-link action-delete" onclick="return confirm('Are you sure you want to delete Booking #{{ $book->id }}?')">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <i class="fa-solid fa-calendar-xmark me-2"></i> No bookings found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($booking->hasPages())
            <div class="pagination-wrapper" style="justify-content: flex-end; padding: 16px 20px;">
                {{ $booking->links() }}
            </div>
        @endif
    </div>
@endsection