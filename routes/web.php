<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoomController;
use App\Models\Gallery;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

// Public Routes
Route::get('/', function () {
    $galleries = collect();
    try {
        if (Schema::hasTable('galleries')) {
            $galleries = Gallery::latest()->get();
        }
    } catch (\Throwable $e) {
        $galleries = collect();
    }
    return view('welcome', compact('galleries'));
});

Route::get('register', [LoginController::class, 'Register']);
Route::post('registercode', [LoginController::class, 'registercode']);

Route::get('login', [LoginController::class, 'login']);
Route::post('logincode', [LoginController::class, 'logincode']);

// Protected Routes (All Logged-in Users)
Route::middleware(['authcheck'])->group(function () {
    Route::get('logout', [LoginController::class, 'logout']);

    // Customer Booking Routes
    Route::get('booking', [BookingController::class, 'booking']);
    Route::post('bookingcode', [BookingController::class, 'bookingcode']);
    Route::get('mybooking', [BookingController::class, 'mybooking']);
    Route::post('user_pay/{id}', [BookingController::class, 'userPayNow']);

    // Admin-Only Routes
    Route::middleware(['admincheck'])->group(function () {
        Route::get('dashboard', [LoginController::class, 'dashboard']);

        // Room Management
        Route::get('room', [RoomController::class, 'room']);
        Route::post('roomcode', [RoomController::class, 'roomcode']);
        Route::get('roomshow', [RoomController::class, 'roomshow']);
        Route::get('roomedit/{id}', [RoomController::class, 'roomedit']);
        Route::post('roomupdate/{id}', [RoomController::class, 'roomupdate']);
        Route::get('roomdelete/{id}', [RoomController::class, 'roomdelete']);

        // All Bookings Management
        Route::get('booking_show', [BookingController::class, 'Booking_show']);
        Route::get('booking_edit/{id}', [BookingController::class, 'Booking_edit']);
        Route::post('booking_update/{id}', [BookingController::class, 'booking_update']);
        Route::get('booking_delete/{id}', [BookingController::class, 'booking_delete']);
        Route::post('booking_status/{id}', [BookingController::class, 'booking_status']);

        // Payment Management
        Route::get('payment', [PaymentController::class, 'payment']);
        Route::post('paymentcode', [PaymentController::class, 'paymentcode']);
        Route::get('payment_show', [PaymentController::class, 'payment_show']);
        Route::get('payment_edit/{id}', [PaymentController::class, 'payment_edit']);
        Route::post('payment_update/{id}', [PaymentController::class, 'payment_update']);
        Route::get('payment_delete/{id}', [PaymentController::class, 'payment_delete']);

        // Gallery Management
        Route::get('gallery', [GalleryController::class, 'gallery']);
        Route::post('gallerycode', [GalleryController::class, 'gallerycode']);
        Route::get('gallerydelete/{id}', [GalleryController::class, 'gallerydelete']);
    });
});
