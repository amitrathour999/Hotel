@extends('layouts.app')

@section('title', 'Rooms Directory')
@section('page_heading', 'Hotel Rooms Management')

@section('content')
    <div class="card-custom">
        <div class="card-header-custom">
            <div class="card-title-custom">
                <i class="fa-solid fa-hotel text-primary"></i> All Registered Hotel Rooms
            </div>
            <a href="{{ url('room') }}" class="btn-primary-custom">
                <i class="fa-solid fa-plus"></i> Add New Room
            </a>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Room Number</th>
                        <th>Room Type</th>
                        <th>Price / Night</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $result)
                        <tr>
                            <td>#{{ $result->id }}</td>
                            <td>
                                <strong>Room {{ $result->room_number }}</strong>
                            </td>
                            <td>
                                <span class="badge-status badge-completed">
                                    {{ ucfirst($result->type) }}
                                </span>
                            </td>
                            <td>
                                <strong>₹{{ number_format($result->price) }}</strong>
                            </td>
                            <td>
                                <span class="badge-status badge-{{ $result->status == 'available' ? 'available' : 'booked' }}">
                                    <i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ ucfirst($result->status) }}
                                </span>
                            </td>
                            <td style="max-width: 250px;">
                                <span class="text-muted" style="font-size: 13px;">{{ Str::limit($result->description, 60) }}</span>
                            </td>
                            <td style="text-align: right;">
                                <a href="{{ url('roomedit/'.$result->id) }}" class="action-link action-edit">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </a>
                                <a href="{{ url('roomdelete/'.$result->id) }}" class="action-link action-delete" onclick="return confirm('Are you sure you want to delete Room #{{ $result->room_number }}?')">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fa-solid fa-bed me-2"></i> No hotel rooms added yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($data->hasPages())
            <div class="pagination-wrapper" style="justify-content: flex-end; padding: 16px 20px;">
                {{ $data->links() }}
            </div>
        @endif
    </div>
@endsection