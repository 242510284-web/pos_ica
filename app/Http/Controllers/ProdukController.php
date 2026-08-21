<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Produk\StoreRequest;

class ProdukController extends Controller
{
    public function index(SearchRequest $request)
    {
        $query = Produk::query();

        // Fitur Pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $produk = $query->latest()->get();

        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(StoreRequest $request)
    {
        // Hapus titik dari input harga sebelum divalidasi
        $request->merge([
            'purchase_price' => str_replace('.', '', $request->purchase_price),
            'selling_price'  => str_replace('.', '', $request->selling_price),
        ]);

        $dataReq = $request->validated();

        $data = [
            'user_id'    => Auth::id() ?? 1,
            'nama'       => $dataReq['name'],
            'harga_beli' => $dataReq['purchase_price'],
            'harga_jual' => $dataReq['selling_price'],
            'stok'       => $dataReq['stock'] ?? 0,
        ];

        // Jika ada foto yang diunggah, simpan path filenya
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('products', 'public');
        } else {
            // Jika tidak ada foto, isi dengan nama file gambar default agar tidak NULL di DB
            $data['foto'] = 'default.jpg';
        }

        // Simpan ke DB
        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus titik dari input harga
        $request->merge([
            'harga_beli' => str_replace('.', '', $request->harga_beli),
            'harga_jual' => str_replace('.', '', $request->harga_jual),
        ]);

        $request->validate([
            'nama'       => 'required|string|max:255',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok'       => 'required|integer',
            'foto'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'nama'       => $request->nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok'       => $request->stok,
        ];

        // Jika mengunggah foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada (dan bukan foto default)
            if ($produk->foto && $produk->foto !== 'default.jpg' && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus foto dari storage jika file ada (dan bukan foto default)
        if ($produk->foto && $produk->foto !== 'default.jpg' && Storage::disk('public')->exists($produk->foto)) {
            Storage::disk('public')->delete($produk->foto);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}