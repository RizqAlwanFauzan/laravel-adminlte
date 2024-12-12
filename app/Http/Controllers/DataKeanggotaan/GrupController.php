<?php

namespace App\Http\Controllers\DataKeanggotaan;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataKeanggotaan\Grup\StoreGrupRequest;
use App\Http\Requests\DataKeanggotaan\Grup\UpdateGrupRequest;
use App\Models\Grup;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GrupController extends Controller
{
    public function index(): View
    {
        $grup = Grup::orderBy('updated_at', 'desc')->get();
        $data = [
            'title' => 'Grup',
            'grup'  => $grup
        ];

        return view('pages.data-keanggotaan.grup', $data);
    }

    public function show(Grup $grup): JsonResponse
    {
        return response()->json($grup);
    }

    public function store(StoreGrupRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Grup::create($validated);
        return redirect()->back()->with('success', 'Data grup berhasil ditambahkan');
    }

    public function update(UpdateGrupRequest $request, Grup $grup): RedirectResponse
    {
        $validated = $request->validated();
        $grup->update($validated);
        return redirect()->back()->with('success', 'Data grup berhasil diperbarui');
    }

    public function destroy(Grup $grup): RedirectResponse
    {
        if ($grup->anggota()->exists()) {
            return redirect()->back()->with('warning', 'Data grup tidak bisa dihapus karena digunakan pada anggota');
        }

        $grup->delete();
        return redirect()->back()->with('success', 'Data grup berhasil dihapus');
    }
}
