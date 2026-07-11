<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        // Statistik
        $totalProducts = Product::where('user_id', $user->id)->count();

        $availableProducts = Product::where('user_id', $user->id)
            ->where('status', 'available')
            ->count();

        $soldProducts = Product::where('user_id', $user->id)
            ->where('status', 'sold')
            ->count();

        $totalPayments = Payment::where('user_id', $user->id)->count();

        return view('profile.edit', [
            'user' => $user,
            'totalProducts' => $totalProducts,
            'availableProducts' => $availableProducts,
            'soldProducts' => $soldProducts,
            'totalPayments' => $totalPayments,
        ]);
    }

    /**
     * Update profil.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone'       => 'nullable|string|max:20',
            'address'     => 'nullable|string',
            'city'        => 'nullable|string|max:100',
            'province'    => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'gender'      => 'nullable|in:Laki-laki,Perempuan',
            'birth_date'  => 'nullable|date',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {

            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            $user->photo = $request->file('photo')->store('profile', 'public');
        }

        $user->update([
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'address'     => $request->address,
            'city'        => $request->city,
            'province'    => $request->province,
            'postal_code' => $request->postal_code,
            'gender'      => $request->gender,
            'birth_date'  => $request->birth_date,
            'photo'       => $user->photo,
        ]);

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Hapus akun.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}