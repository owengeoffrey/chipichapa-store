<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $barangs   = Barang::with('kategori')->latest()->paginate(12);
        $kategoris = Kategori::all();
        return view('user.catalog', compact('barangs', 'kategoris'));
    }
}
