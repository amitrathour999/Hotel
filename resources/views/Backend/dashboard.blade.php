@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_heading', 'Executive Dashboard')

@section('styles')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        display: flex;
        align-items: center;
        gap: 20px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        flex-shrink: 0;
    }

    .icon-rooms { background: #e0f2fe; color: #0284c7; }
    .icon-available { background: #dcfce7; color: #16a34a; }
    .icon-bookings { background: #fef3c7; color: #d97706; }
    .icon-revenue { background: #fae8ff; color: #c026d3; }

    .stat-info .stat-value {
        font-family: 'Outfit', sans-serif;
        font-size: 26px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.2;
    }

    .stat-info .stat-label {
        font-size: 13px;
        color: #64748b;
        font-weight: 500;
        margin-top: 4px;
    }

    .quick-actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 30px;
    }

    .action-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 20px;
        text-decoration: none;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 14px;
        transition: all 0.25s ease;
    }

    .action-card:hover {
        border-color: #0f766e;
        background: #f0fdf4;
        transform: translateX(4px);
    }

    .action-card i {
        font-size: 20px;
        color: #0f766e;
    }

    .action-card-text {
        font-weight: 600;
        font-size: 14px;
    }
</style>
@endsection

@section('content')
    <!-- KPI Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon icon-rooms">
                <i class="fa-solid fa-door-open"></i>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $totalRooms ?? 0 }}</div>
                <div class="stat-label">Total Rooms</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon icon-available">
                <i class="fa-solid fa-bed"></i>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $availableRooms ?? 0 }}</div>
                <div class="stat-label">Available Rooms</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon icon-bookings">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $totalBookings ?? 0 }}</div>
                <div class="stat-label">Total Bookings</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon icon-revenue">
                <i class="fa-solid fa-indian-rupee-sign"></i>
            </div>
            <div class="stat-info">
                <div class="stat-value">₹{{ number_format($totalRevenue ?? 0) }}</div>
                <div class="stat-label">Total Revenue</div>
            </div>
        </div>
    </div>

    <!-- Quick Action Shortcuts -->
    <div class="card-custom">
        <div class="card-header-custom">
            <div class="card-title-custom">
                <i class="fa-solid fa-bolt text-warning"></i> Quick Operations
            </div>
        </div>
        <div class="quick-actions-grid">
            <a href="{{ url('booking') }}" class="action-card">
                <i class="fa-solid fa-calendar-plus"></i>
                <div class="action-card-text">New Booking</div>
            </a>
            <a href="{{ url('room') }}" class="action-card">
                <i class="fa-solid fa-plus"></i>
                <div class="action-card-text">Add Room</div>
            </a>
            <a href="{{ url('payment') }}" class="action-card">
                <i class="fa-solid fa-cash-register"></i>
                <div class="action-card-text">Record Payment</div>
            </a>
            <a href="{{ url('mybooking') }}" class="action-card">
                <i class="fa-solid fa-history"></i>
                <div class="action-card-text">My History</div>
            </a>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="card-custom">
        <div class="card-header-custom">
            <div class="card-title-custom">
                <i class="fa-solid fa-list text-primary"></i> Recent Reservations
            </div>
            <a href="{{ url('booking_show') }}" class="btn-secondary-custom">
                <span>View All Bookings</span> <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Guest Name</th>
                        <th>Room Number</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentBookings ?? [] as $book)
                        <tr>
                            <td>#{{ $book->id }}</td>
                            <td>
                                <strong>{{ $book->name }}</strong><br>
                                <small class="text-muted">{{ $book->email }}</small>
                            </td>
                            <td>
                                <span class="badge-status badge-available">
                                    <i class="fa-solid fa-bed"></i> Room {{ $book->room->room_number ?? '-' }}
                                </span>
                            </td>
                            <td>{{ $book->check_in }}</td>
                            <td>{{ $book->check_out }}</td>
                            <td>
                                <span class="badge-status badge-{{ strtolower($book->status) }}">
                                    {{ ucfirst($book->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ url('booking_edit/'.$book->id) }}" class="action-link action-edit">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fa-solid fa-folder-open me-2"></i> No recent bookings found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
