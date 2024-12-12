<?php

namespace App\Http\Controllers\DataKeanggotaan;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataKeanggotaan\Anggota\StoreAnggotaRequest;
use App\Http\Requests\DataKeanggotaan\Anggota\UpdateAnggotaRequest;
use App\Models\Anggota;
use App\Models\Grup;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AnggotaController extends Controller
{
    public function index(): View
    {
        $anggota = Anggota::orderBy('updated_at', 'desc')->get();
        $grup    = Grup::orderBy('updated_at', 'desc')->pluck('nama', 'id');
        $data = [
            'title'   => 'Anggota',
            'anggota' => $anggota,
            'grup'    => $grup
        ];

        return view('pages.data-keanggotaan.anggota', $data);
    }

    public function show(Anggota $anggota): JsonResponse
    {
        $anggota->load('grup');
        return response()->json($anggota);
    }

    public function store(StoreAnggotaRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Anggota::create($validated);
        return redirect()->back()->with('success', 'Data anggota berhasil ditambahkan');
    }

    public function update(UpdateAnggotaRequest $request, Anggota $anggota): RedirectResponse
    {
        $validated = $request->validated();
        $anggota->update($validated);
        return redirect()->back()->with('success', 'Data anggota berhasil diperbarui');
    }

    public function destroy(Anggota $anggota): RedirectResponse
    {
        $anggota->delete();
        return redirect()->back()->with('success', 'Data anggota berhasil dihapus');
    }
}
