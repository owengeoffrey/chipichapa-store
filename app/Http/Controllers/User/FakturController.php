<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Faktur;
use App\Models\FakturItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FakturController extends Controller
{
    public function create()
    {
        $keranjang = session()->get('keranjang', []);

        if (empty($keranjang)) {
            return redirect()->route('user.catalog')->with('error', 'Keranjang kosong.');
        }

        $total = collect($keranjang)->sum(fn($item) => $item['harga_barang'] * $item['kuantitas']);
        return view('user.faktur.create', compact('keranjang', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat_pengiriman' => 'required|string|min:10|max:100',
            'kode_pos'          => ['required', 'string', 'regex:/^\d{5}$/'],
        ], [
            'kode_pos.regex' => 'Kode pos harus 5 digit angka.',
        ]);

        $keranjang = session()->get('keranjang', []);

        if (empty($keranjang)) {
            return redirect()->route('user.catalog')->with('error', 'Keranjang kosong.');
        }

        $total = collect($keranjang)->sum(fn($item) => $item['harga_barang'] * $item['kuantitas']);

        $faktur = Faktur::create([
            'user_id'            => Auth::id(),
            'nomor_invoice'      => 'INV-' . strtoupper(Str::random(8)) . '-' . now()->format('YmdHis'),
            'alamat_pengiriman'  => $request->alamat_pengiriman,
            'kode_pos'           => $request->kode_pos,
            'total_harga'        => $total,
        ]);

        foreach ($keranjang as $barangId => $item) {
            FakturItem::create([
                'faktur_id'  => $faktur->id,
                'barang_id'  => $barangId,
                'kuantitas'  => $item['kuantitas'],
                'subtotal'   => $item['harga_barang'] * $item['kuantitas'],
            ]);

            $barang = Barang::find($barangId);
            if ($barang) {
                $barang->decrement('jumlah_barang', $item['kuantitas']);
            }
        }

        session()->forget('keranjang');

        return redirect()->route('user.faktur.show', $faktur->id)->with('success', 'Faktur berhasil dibuat.');
    }

    public function show($id)
    {
        $faktur = Faktur::with(['fakturItems.barang.kategori', 'user'])->findOrFail($id);

        if ($faktur->user_id !== Auth::id()) {
            abort(403);
        }

        return view('user.faktur.show', compact('faktur'));
    }

    public function index()
    {
        $fakturs = Faktur::where('user_id', Auth::id())->latest()->get();
        return view('user.faktur.index', compact('fakturs'));
    }
}
