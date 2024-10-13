<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Distributor;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


class DistributorController extends Controller
{
    public function index()
    {
        $distributors = Distributor::all();
        confirmDelete('Hapus Data!' , 'Apakah anda yakin ingin menghapus data ini') ;
        return view('pages.admin.distributor.index', compact('distributors'));
    }

    public function create()
    {
        return view('pages.admin.distributor.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_distributor' => 'required|string',
            'kontak' => 'required|numeric',
            'lokasi' => 'required|string',
            'email' => 'required|email',
           
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images/', $imageName);
        }

        $distributors = Distributor::create([
            'nama_distributor' => $request->nama_distributor,
            'kontak' => $request->kontak,
            'lokasi' => $request->lokasi,
            'email' => $request->email,
            
        ]);

        if ($distributors) {
            Alert::success('Berhasil!', 'Distributor berhasil ditambahkan!');
            return redirect()->route('admin.distributor');
        } else {
            Alert::error('Gagal!', 'Distributor gagal ditambahkan!');
            return redirect()->back();
        }
    }

    public function detail($id)
    {
        $distributors = Distributor::findOrFail($id);
        return view('pages.admin.distributor.detail', compact('distributors'));
    }

    public function edit($id)
    {
        $distributors = Distributor::findOrFail($id);
        return view('pages.admin.distributor.edit', compact('distributors'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_distributor' => 'required|string',
            'kontak' => 'required|numeric',
            'lokasi' => 'required|string',
            'email' => 'required|email',
          
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $distributors = Distributor::findOrFail($id);

       
        $distributors->update([
            'nama_distributor' => $request->nama_distributor,
            'kontak' => $request->kontak,
            'lokasi' => $request->lokasi,
            'email' => $request->email,
        ]);

        if ($distributors) {
            Alert::success('Berhasil!', 'Distributor berhasil diperbarui!');
            return redirect()->route('admin.distributor');
        } else {
            Alert::error('Gagal!', 'Distributor gagal diperbarui!');
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $distributors = Distributor::findOrFail($id);

        

        if ($distributors->delete()) {
            Alert::success('Berhasil', 'Distributor berhasil dihapus');
            return redirect()->back();
        } else {
            Alert::error('Gagal', 'Distributor gagal dihapus');
            return redirect()->back();
        }
    }
}