<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function Register()
    {
        return view('frontend.Register');
    }

    public function registercode(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
        ]);

        $data = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);
        $data->save();

        return redirect('login')->with('success', 'Registration successful! Please log in.');
    }

    public function login()
    {
        return view('frontend.login');
    }

    public function logincode(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $data = User::where('email', $request->email)->first();

        if (isset($data)) {
            if (Hash::check($request->password, $data->password)) {
                $userRole = $data->role ?? 'customer';
                session([
                    'user_id' => $data->id,
                    'user_name' => $data->name,
                    'user_email' => $data->email,
                    'user_role' => $userRole,
                ]);

                if ($userRole === 'admin') {
                    return redirect('dashboard')->with('success', 'Welcome to Admin Dashboard, ' . $data->name . '!');
                }

                return redirect('/')->with('success', 'Welcome back, ' . $data->name . '!');
            } else {
                return back()->with('error', 'Invalid password. Please try again.');
            }
        } else {
            return back()->with('error', 'No user found with this email.');
        }
    }

    public function dashboard()
    {
        $totalRooms = Room::count();
        $availableRooms = Room::where('status', 'available')->count();
        $totalBookings = Booking::count();
        $totalRevenue = Payment::where('status', 'paid')->sum('amount');
        $recentBookings = Booking::with('room')->latest()->take(5)->get();

        return view('Backend.dashboard', compact('totalRooms', 'availableRooms', 'totalBookings', 'totalRevenue', 'recentBookings'));
    }

    public function logout()
    {
        session()->forget(['user_id', 'user_name', 'user_email', 'user_role']);
        return redirect('login')->with('success', 'Logged out successfully.');
    }
}
