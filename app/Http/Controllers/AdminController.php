<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $today = now();
        $todayBookings = Booking::with('service')
            ->whereDate('appointment_at', $today)
            ->get();

        return view('admin.dashboard', [
            'todayBookings' => $todayBookings,
            'todayRevenue' => $todayBookings->whereIn('status', ['confirmed', 'completed'])->sum(fn (Booking $booking): int => $booking->service->price),
            'weeklyRevenue' => collect(range(6, 0))->map(function (int $daysAgo) use ($today): int {
                return Booking::with('service')
                    ->whereDate('appointment_at', $today->copy()->subDays($daysAgo))
                    ->whereIn('status', ['confirmed', 'completed'])
                    ->get()
                    ->sum(fn (Booking $booking): int => $booking->service->price);
            }),
            'employees' => User::whereIn('role', ['cashier', 'admin'])->orderBy('role')->orderBy('name')->get(),
        ]);
    }

    public function storeEmployee(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'username' => ['required', 'regex:/^[A-Za-z0-9._-]+$/', 'min:3', 'max:50', 'unique:users,username'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['username'].'@ruangrias.local',
            'password' => $data['password'],
            'role' => 'cashier',
        ]);

        return to_route('admin.dashboard')->with('success', 'Akun karyawan berhasil dibuat.');
    }
}
