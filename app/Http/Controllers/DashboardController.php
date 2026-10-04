<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Employee;
use Carbon\CarbonImmutable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DashboardController extends Controller
{
    private const WALK_IN_SERVICE_CATALOG = [
        'barber' => [
            'Fast Haircut' => 25000,
            'Rileks Ganteng' => 35000,
            'Full Grooming' => 50000,
        ],
        'mua' => [
            'Makeup Only' => 250000,
            'Make Up + Soft Lens' => 300000,
            'Make Up + Hijab/Hair Do' => 320000,
            'Make Up + Hijab/Hair Do + Soft Lens' => 360000,
        ],
    ];

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
        $walkInBookings = Booking::query()
            ->whereDate('appointment_at', now()->toDateString())
            ->latest('appointment_at')
            ->get();

        return view('Kasir.Dashboard', [
            'walkInBookings' => $walkInBookings,
        ]);
    }

    public function bookingWalkin()
    {
        return view('Kasir.BookingWalkin', [
            'walkInServiceCatalog' => self::WALK_IN_SERVICE_CATALOG,
            'employees' => Employee::query()
                ->orderBy('name')
                ->get(['name', 'position'])
                ->toArray(),
        ]);
    }

    public function storeWalkin(Request $request): RedirectResponse
    {
        $category = $request->input('category');
        $availableServices = self::WALK_IN_SERVICE_CATALOG[$category] ?? [];
        $staffPosition = $category === 'mua' ? 'MUA Artist' : 'Hair Stylist';
        $availableStaff = Employee::query()
            ->where('position', $staffPosition)
            ->pluck('name')
            ->all();

        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:100'],
            'category' => ['required', Rule::in(array_keys(self::WALK_IN_SERVICE_CATALOG))],
            'service_name' => ['required', 'string', Rule::in(array_keys($availableServices))],
            'staff_name' => ['required', 'string', Rule::in($availableStaff)],
        ]);

        Booking::create([
            'customer_name' => $data['customer_name'],
            'category' => $data['category'],
            'service_name' => $data['service_name'],
            'service_price' => self::WALK_IN_SERVICE_CATALOG[$data['category']][$data['service_name']],
            'staff_name' => $data['staff_name'],
            'cashier_id' => $request->user()->getKey(),
            'appointment_at' => now(),
            'status' => 'pending',
        ]);

        return to_route('kasir.booking.walkin')->with('success', 'Booking walk-in berhasil disimpan.');
    }

    public function completeBooking(Booking $booking): RedirectResponse
    {
        abort_unless(in_array($booking->status, ['pending', 'confirmed', 'in_progress'], true), 409);

        $booking->update(['status' => 'completed']);

        return to_route('kasir.dashboard')->with('success', 'Booking berhasil diselesaikan.');
    }

    public function admin()
    {
        $today = CarbonImmutable::today();
        $monthStart = $today->startOfMonth();
        $todayBookings = Booking::query()->whereDate('appointment_at', $today);
        $todayWalkIns = Booking::query()
            ->whereDate('appointment_at', $today)
            ->whereNotNull('cashier_id');

        $weeklyDays = collect(range(6, 0))->map(function (int $daysAgo) use ($today): array {
            $date = $today->subDays($daysAgo);
            $revenue = Booking::query()
                ->whereDate('appointment_at', $date)
                ->where('status', 'completed')
                ->sum('service_price');

            return [
                'date' => $date,
                'label' => [1 => 'Sen', 2 => 'Sel', 3 => 'Rab', 4 => 'Kam', 5 => 'Jum', 6 => 'Sab', 7 => 'Min'][$date->dayOfWeekIso],
                'revenue' => (int) $revenue,
                'isToday' => $date->isSameDay($today),
            ];
        });
        $maxDailyRevenue = max(1, $weeklyDays->max('revenue'));
        $weeklyDays = $weeklyDays->map(function (array $day) use ($maxDailyRevenue): array {
            $day['barHeight'] = $day['revenue'] > 0 ? max(12, (int) round($day['revenue'] / $maxDailyRevenue * 100)) : 4;

            return $day;
        });

        $completedServiceCounts = Booking::query()
            ->where('status', 'completed')
            ->selectRaw('staff_name, COUNT(*) as completed_count')
            ->groupBy('staff_name')
            ->pluck('completed_count', 'staff_name');
        $employees = Employee::query()
            ->orderBy('name')
            ->get()
            ->map(function (Employee $employee) use ($completedServiceCounts): Employee {
                $employee->setAttribute('completed_service_count', (int) $completedServiceCounts->get($employee->name, 0));

                return $employee;
            });

        $monthRevenue = Booking::query()
            ->where('status', 'completed')
            ->whereBetween('appointment_at', [$monthStart->startOfDay(), $today->endOfDay()])
            ->sum('service_price');

        return view('Admin.Dashboard', [
            'dashboardDate' => $today->locale('id')->translatedFormat('l, d F Y'),
            'monthStartLabel' => $monthStart->format('d/m/Y'),
            'monthEndLabel' => $today->format('d/m/Y'),
            'monthRevenue' => (int) $monthRevenue,
            'todayBookingCount' => $todayBookings->count(),
            'todayPendingCount' => (clone $todayBookings)->where('status', 'pending')->count(),
            'todayInProgressCount' => (clone $todayBookings)->whereIn('status', ['confirmed', 'in_progress'])->count(),
            'todayWalkInCount' => (clone $todayWalkIns)->count(),
            'todayWalkInRevenue' => (int) (clone $todayWalkIns)->where('status', 'completed')->sum('service_price'),
            'employeeCount' => $employees->count(),
            'weeklyRevenue' => (int) $weeklyDays->sum('revenue'),
            'weeklyStartLabel' => $today->subDays(6)->format('d/m'),
            'weeklyEndLabel' => $today->format('d/m'),
            'weeklyDays' => $weeklyDays,
            'employees' => $employees,
        ]);
    }

    public function kelolaKaryawan()
    {
        return view('Admin.KelolaKaryawan');
    }

    public function laporanPendapatan(Request $request): View|RedirectResponse
    {
        if ($request->hasAny(['start_date', 'end_date'])) {
            $range = $request->validate([
                'start_date' => ['required', 'date_format:Y-m-d', 'before_or_equal:today'],
                'end_date' => ['required', 'date_format:Y-m-d', 'after_or_equal:start_date', 'before_or_equal:today'],
            ]);

            $startDate = CarbonImmutable::parse($range['start_date']);
            $endDate = CarbonImmutable::parse($range['end_date']);
        } else {
            $startDate = CarbonImmutable::now()->startOfMonth();
            $endDate = CarbonImmutable::today();
        }

        if ($startDate->diffInDays($endDate) > 30) {
            return back()->withErrors(['end_date' => 'Rentang laporan maksimal 31 hari.'])->withInput();
        }

        $transactions = Booking::query()
            ->whereBetween('appointment_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->latest('appointment_at')
            ->get();
        $completedTransactions = $transactions->where('status', 'completed');

        return view('Admin.LaporanPendapatan', [
            'transactions' => $transactions,
            'startDate' => $startDate->toDateString(),
            'endDate' => $endDate->toDateString(),
            'today' => CarbonImmutable::today()->toDateString(),
            'reportTotal' => $completedTransactions->sum('service_price'),
            'barberTotal' => $completedTransactions->where('category', 'barber')->sum('service_price'),
            'muaTotal' => $completedTransactions->where('category', 'mua')->sum('service_price'),
        ]);
    }

    public function exportLaporanPendapatan(Request $request): StreamedResponse|RedirectResponse
    {
        $range = $request->validate([
            'start_date' => ['required', 'date_format:Y-m-d', 'before_or_equal:today'],
            'end_date' => ['required', 'date_format:Y-m-d', 'after_or_equal:start_date', 'before_or_equal:today'],
        ]);

        $startDate = CarbonImmutable::parse($range['start_date']);
        $endDate = CarbonImmutable::parse($range['end_date']);

        if ($startDate->diffInDays($endDate) > 30) {
            return back()->withErrors(['end_date' => 'Rentang ekspor maksimal 31 hari.'])->withInput();
        }

        return response()->streamDownload(function () use ($startDate, $endDate): void {
            $transactions = Booking::query()
                ->whereBetween('appointment_at', [$startDate->startOfDay(), $endDate->endOfDay()])
                ->orderBy('appointment_at')
                ->get();
            $completedTransactions = $transactions->where('status', 'completed');
            $completedRevenue = $completedTransactions->sum('service_price');

            $stream = fopen('php://output', 'w');
            fwrite($stream, "\xEF\xBB\xBF");
            fputcsv($stream, ['sep=,'], ',', '"', '\\');
            fputcsv($stream, ['LAPORAN PENDAPATAN GLOWCUT'], ',', '"', '\\');
            fputcsv($stream, ['Periode', $startDate->format('d/m/Y'), 's.d.', $endDate->format('d/m/Y')], ',', '"', '\\');
            fputcsv($stream, ['Dibuat pada', CarbonImmutable::now()->format('d/m/Y H:i')], ',', '"', '\\');
            fputcsv($stream, [], ',', '"', '\\');
            fputcsv($stream, ['RINGKASAN'], ',', '"', '\\');
            fputcsv($stream, ['Pendapatan selesai (Rp)', $completedRevenue], ',', '"', '\\');
            fputcsv($stream, ['Pendapatan Barbershop selesai (Rp)', $completedTransactions->where('category', 'barber')->sum('service_price')], ',', '"', '\\');
            fputcsv($stream, ['Pendapatan MUA selesai (Rp)', $completedTransactions->where('category', 'mua')->sum('service_price')], ',', '"', '\\');
            fputcsv($stream, ['Jumlah transaksi', $transactions->count()], ',', '"', '\\');
            fputcsv($stream, ['Transaksi selesai', $completedTransactions->count()], ',', '"', '\\');
            fputcsv($stream, ['Transaksi menunggu', $transactions->where('status', 'pending')->count()], ',', '"', '\\');
            fputcsv($stream, [], ',', '"', '\\');
            fputcsv($stream, ['No.', 'Tanggal', 'Waktu', 'Jenis', 'Pelanggan', 'Kategori', 'Layanan', 'Staff', 'Harga (Rp)', 'Status'], ',', '"', '\\');

            foreach ($transactions->values() as $index => $transaction) {
                $price = (int) ($transaction->service_price ?? 0);

                fputcsv($stream, [
                    $index + 1,
                    $transaction->appointment_at?->format('Y-m-d') ?? '',
                    $transaction->appointment_at?->format('H:i') ?? '',
                    $transaction->cashier_id ? 'Walk-in' : 'Online',
                    $this->spreadsheetText($transaction->customer_name),
                    $transaction->category === 'mua' ? 'MUA' : 'Barbershop',
                    $this->spreadsheetText($transaction->service_name),
                    $this->spreadsheetText($transaction->staff_name),
                    $price,
                    ucfirst($transaction->status),
                ], ',', '"', '\\');
            }

            fputcsv($stream, [], ',', '"', '\\');
            fputcsv($stream, ['', '', '', '', '', '', 'TOTAL PENDAPATAN SELESAI (Rp)', $completedRevenue], ',', '"', '\\');
            fclose($stream);
        }, 'laporan-pendapatan_'.$startDate->toDateString().'_'.$endDate->toDateString().'.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    private function spreadsheetText(?string $value): string
    {
        $value ??= '';

        return preg_match('/^[\s]*[=+\-@]/u', $value) === 1 ? "'{$value}" : $value;
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
