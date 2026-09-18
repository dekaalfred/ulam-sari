<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Reservation;
use App\Models\Activity;
use App\Models\ReservationPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $menus = Menu::orderBy('id', 'desc')->get();
            $reservations = Reservation::orderBy('id', 'desc')->get();
            $activities = Activity::orderBy('id', 'desc')->get();
        } else {
            $menus = collect();
            $reservations = collect();
            $activities = collect();
        }

        return view('admin.dashboard', compact('menus', 'reservations', 'activities'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'csrf_token' => csrf_token(),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Email atau password salah.'
        ], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['success' => true]);
    }

    // CRUD Menu
    private function saveBase64Image(string $base64): string
{
    [$meta, $data] = explode(',', $base64, 2);
    preg_match('/data:image\/(\w+);base64/', $meta, $matches);
    $extension = $matches[1] ?? 'png';

    $filename = 'images/menu-' . uniqid() . '.' . $extension;
    file_put_contents(public_path($filename), base64_decode($data));

    return $filename;
}
public function storeMenu(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'desc' => 'nullable|string',
        'cat' => 'required|string',
        'price' => 'required|numeric',
        'status' => 'required|in:tersedia,habis',
        'image' => 'nullable|string',
    ]);

    if (!empty($validated['image']) && str_starts_with($validated['image'], 'data:image')) {
        $validated['image'] = $this->saveBase64Image($validated['image']);
    }

    $menu = Menu::create($validated);
        Activity::create([
            'dot' => 'dot-orange',
            'text' => 'Menu Ditambahkan: ' . $menu->name,
            'sub' => 'Kategori: ' . $menu->cat,
            'time_label' => 'Baru saja',
        ]);

        return response()->json([
            'success' => true,
            'data' => $menu
        ]);
    }

    public function updateMenu(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'cat' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|in:tersedia,habis',
            'image' => 'nullable|string',
        ]);

        if (!empty($validated['image']) && str_starts_with($validated['image'], 'data:image')) {
            $validated['image'] = $this->saveBase64Image($validated['image']);
        }

        $menu->update($validated);
        Activity::create([
            'dot' => 'dot-muted',
            'text' => 'Menu Diperbarui: ' . $menu->name,
            'sub' => 'Rp ' . number_format($menu->price, 0, ',', '.'),
            'time_label' => 'Baru saja',
        ]);

        return response()->json([
            'success' => true,
            'data' => $menu
        ]);
    }

    public function destroyMenu($id)
    {
        $menu = Menu::findOrFail($id);

        $name = $menu->name;

        $menu->delete();

        Activity::create([
            'dot' => 'dot-muted',
            'text' => 'Menu Dihapus: ' . $name,
            'sub' => 'Dihapus oleh Admin',
            'time_label' => 'Baru saja',
        ]);

        return response()->json(['success' => true]);
    }

    // Update Reservation Status

    public function updateReservationStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:menunggu,dikonfirmasi,ditolak',
        ]);

        $rsv = Reservation::findOrFail($id);

        $rsv->update($validated);

        return response()->json([
            'success' => true,
            'data' => $rsv
        ]);
    }

    // Toggle Menu Status

    public function toggleMenuStatus($id)
    {
        $menu = Menu::findOrFail($id);

        $menu->status = $menu->status === 'tersedia'
            ? 'habis'
            : 'tersedia';

        $menu->save();

        return response()->json([
            'success' => true,
            'data' => $menu
        ]);
    }
    
    public function verifyPayment(Request $request, $paymentId)
    {
    $validated = $request->validate([
        'action' => 'required|in:approve,reject',
    ]);

    $payment = ReservationPayment::with('reservation')->findOrFail($paymentId);

    if ($validated['action'] === 'approve') {
        $payment->update([
            'status'      => 'paid',
            'verified_by' => Auth::id(),
            'paid_at'     => now(),
        ]);
        $payment->reservation->update(['status' => 'dikonfirmasi']);

        Activity::create([
            'dot' => 'dot-orange',
            'text' => 'Pembayaran Diverifikasi: ' . $payment->reservation->customer,
            'sub' => 'Rp ' . number_format($payment->amount, 0, ',', '.'),
            'time_label' => 'Baru saja',
        ]);
    } else {
        $payment->update(['status' => 'rejected', 'verified_by' => Auth::id()]);
        $payment->reservation->update(['status' => 'ditolak']);
    }

    return response()->json(['success' => true, 'data' => $payment]);
    }
}