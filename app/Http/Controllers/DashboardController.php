<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // function index(){
    //     echo "hallo selamat datang " . Auth::user()->name;
    //     echo "<br>";
    //     echo "<a href='logout'>Logout</a>";
    // }
    public function pelanggan()
    {
        return view('pelanggan.Dashboard');
    }

    public function kasir()
    {
        return view('Kasir.Dashboard');
    }

    public function bookingWalkin()
    {
        return view('Kasir.BookingWalkin');
    }

    public function admin()
    {
        return view('Admin.Dashboard');
    }

    public function kelolaKaryawan()
    {
        return view('Admin.KelolaKaryawan');
    }

    public function laporanPendapatan()
    {
        return view('Admin.LaporanPendapatan');
    }

    public function Barbershop()
    {
        return view('pelanggan.Barbershop');
    }

    public function MUA()
    {
        return view('pelanggan.MUA');
    }

    public function booking()
    {
        return view('pelanggan.Booking');
    }

    public function riwayat()
    {
        return view('pelanggan.Riwayat');
    }

    public function order()
    {
        return view('pelanggan.Order');
    }

    public function profile()
    {
        return view('pelanggan.Profile');
    }

    public function bookingInput()
    {
        return view('pelanggan.BookingInput');
    }
}
