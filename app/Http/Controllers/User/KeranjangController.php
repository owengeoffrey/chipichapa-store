<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function add(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->jumlah_barang <= 0) {
            return back()->with('error', 'Barang sudah habis, silakan tunggu hingga barang di-restock ulang.');
        }

        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            $keranjang[$id]['kuantitas'] += 1;
        } else {
            $keranjang[$id] = [
                'barang_id'    => $barang->id,
                'nama_barang'  => $barang->nama_barang,
                'harga_barang' => $barang->harga_barang,
                'kategori'     => $barang->kategori->nama_kategori,
                'foto_barang'  => $barang->foto_barang,
                'kuantitas'    => 1,
            ];
        }

        session()->put('keranjang', $keranjang);

        return back()->with('success', 'Barang berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, $id)
    {
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            $kuantitas = max(1, (int) $request->kuantitas);
            $barang    = Barang::findOrFail($id);

            if ($kuantitas > $barang->jumlah_barang) {
                return back()->with('error', 'Jumlah melebihi stok yang tersedia.');
            }

            $keranjang[$id]['kuantitas'] = $kuantitas;
            session()->put('keranjang', $keranjang);
        }

        return back()->with('success', 'Keranjang diperbarui.');
    }

    public function remove($id)
    {
        $keranjang = session()->get('keranjang', []);
        unset($keranjang[$id]);
        session()->put('keranjang', $keranjang);

        return back()->with('success', 'Barang dihapus dari keranjang.');
    }

    public function index()
    {
        $keranjang = session()->get('keranjang', []);
        $total     = collect($keranjang)->sum(fn($item) => $item['harga_barang'] * $item['kuantitas']);
        return view('user.keranjang', compact('keranjang', 'total'));
    }
}
