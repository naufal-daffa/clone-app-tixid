<?php

namespace App\Http\Controllers;

use App\Exports\PromoExport;
use App\Models\Promo;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promos = Promo::where('actived', 1)->get();

        return view('staff.promos.index', compact('promos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.promos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'promo_code' => 'required|min:5|unique:promos,promo_code',
            'type' => 'required|in:percent,rupiah',
            'discount' => 'required|numeric|min:0'
        ], [
            'promo_code.required' => 'Kode Promo Wajib Di-isi!',
            'promo_code.min' => 'Kode Promo Wajib berisi minimal 5 karakter!',
            'promo_code.unique' => 'Kode Promo sudah digunakan!',
            'type.required' => 'Tipe Diskon Wajib Di-isi!',
            'type.in' => 'Tipe Diskon tidak valid!',
            'discount.required' => 'Jumlah Potongan Wajib Di-isi!',
            'discount.numeric' => 'Jumlah Potongan harus berupa angka!',
            'discount.min' => 'Jumlah Potongan tidak boleh negatif!'
        ]);

        if ($request->type == 'percent') {
            if ($request->discount <= 0 || $request->discount > 100) {
                return redirect()->back()->with('error', 'Untuk tipe persentase, nilai harus antara 0.01% hingga 100%');
            }
        } else {
            if ($request->discount < 1000) {
                return redirect()->back()->with('error', 'Untuk tipe rupiah, nilai minimal adalah Rp 1.000');
            }
        }

        $createPromo = Promo::create([
            'promo_code' => $request->promo_code,
            'type' => $request->type,
            'discount' => $request->discount,
            'actived' => 1
        ]);

        if ($createPromo) {
            return redirect()->route('staff.promos.index')->with('success', 'Berhasil Membuat kode Promo!');
        } else {
            return redirect()->back()->with('error', 'Gagal! Silahkan Coba Lagi');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Promo $promo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $promo = Promo::find($id);
        return view('staff.promos.edit', compact('promo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'promo_code' => 'required|min:5|unique:promos,promo_code,' . $id,
            'type' => 'required|in:percent,rupiah',
            'discount' => 'required|numeric|min:0'
        ], [
            'promo_code.required' => 'Kode Promo Wajib Di-isi!',
            'promo_code.min' => 'Kode Promo Wajib berisi minimal 5 karakter!',
            'promo_code.unique' => 'Kode Promo sudah digunakan!',
            'type.required' => 'Tipe Diskon Wajib Di-isi!',
            'type.in' => 'Tipe Diskon tidak valid!',
            'discount.required' => 'Jumlah Potongan Wajib Di-isi!',
            'discount.numeric' => 'Jumlah Potongan harus berupa angka!',
            'discount.min' => 'Jumlah Potongan tidak boleh negatif!'
        ]);

        if ($request->type == 'percent') {
            if ($request->discount <= 0 || $request->discount > 100) {
                return redirect()->back()
                    ->with('error', 'Untuk tipe persentase, nilai harus antara 0.01% hingga 100%')
                    ->withInput();
            }
        } else {
            if ($request->discount < 1000) {
                return redirect()->back()
                    ->with('error', 'Untuk tipe rupiah, nilai minimal adalah Rp 1.000')
                    ->withInput();
            }
        }

        $updatePromo = Promo::where('id', $id)->update([
            'promo_code' => $request->promo_code,
            'type' => $request->type,
            'discount' => $request->discount,
            'actived' => 1
        ]);

        if ($updatePromo) {
            return redirect()->route('staff.promos.index')->with('success', 'Berhasil Mengupdate kode Promo!');
        } else {
            return redirect()->back()->with('error', 'Gagal! Silahkan Coba Lagi');
        }
    }

    public function patch($id)
    {
        $promos = Promo::findOrFail($id);
        if ($promos->actived == 1) {
            $promos->actived = 0;
            $movie = $promos->save();

            if ($movie) {
                return redirect()->route('staff.promos.index')->with('success', 'Promo berhasil dinonaktifkan');
            } else {
                return redirect()->back()->with('error', 'Gagal! silahkan coba lagi');
            }
        } else {
            $promos->actived = 1;
            $movie = $promos->save();

            if ($movie) {
                return redirect()->route('staff.promos.index')->with('success', 'Promo berhasil diaktifkan');
            } else {
                return redirect()->back()->with('error', 'Gagal! silahkan coba lagi');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $promo = Promo::where('id', $id)->delete();

        if ($promo) {
            return redirect()->route('staff.promos.index')->with('success', 'Berhasil menghapus data');
        } else {
            return redirect()->back()->with('error', 'Gagal! Silahkan coba lagi');
        }
    }
    public function exportExcel()
    {
        $file_name = 'Promo_list' . '.xlsx';
        return Excel::download(new PromoExport, $file_name);
    }

    public function deletePermanent($id)
    {
        $deletepromo = Promo::where('id', $id)->forceDelete();
        if ($deletepromo) {
            return redirect()->route('staff.promos.trash')->with('success', 'Data berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Gagal! silahkan coba lagi');
        }
    }

    public function restore($id)
    {
        $promo = Promo::withTrashed()->where('id', $id)->restore();
        if ($promo) {
            return redirect()->route('staff.promos.index')->with('success', 'Data berhasil dipulihkan!');
        } else {
            return redirect()->back()->with('error', 'Gagal! silahkan coba lagi');
        }
    }
    public function trash()
    {
        // onlyTrashed() mengambil data yang sudah dihapus dengan fungsi soft delete/ destroy
        $promos = Promo::onlyTrashed()->get();
        return view('staff.promos.trash', compact('promos'));
    }
    public function dataForDatatables()
    {
        $promos = Promo::query();

        return DataTables::of($promos)
            ->addIndexColumn()
            ->addColumn('type', function ($data) {
                if ($data->type == 'rupiah') {
                    return 'Rp ' . number_format($data->discount, 0, ',', '.');
                } else {
                    return $data->discount . '%';
                }
            })
            ->addColumn('activeBadge', function ($data) {
                if ($data->actived == 1) {
                    return '<div class="badge bg-success">Aktif</div>';
                } else {
                    return '<div class="badge bg-danger">Non-Aktif</div>';
                }
            })
            ->addColumn('buttons', function ($data) {
                $btnEdit = '<a href="' . route('staff.promos.edit', $data->id) . '" class="btn btn-primary">Edit</a>';
                $btnDelete = '<form action="' . route('staff.promos.delete', $data->id) . '" method="POST">' .
                    csrf_field() .
                    method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger">Hapus</button></form>';
                $btnNonAktif = '';
                $btnAktif = '';
                if ($data->actived == 1) {
                    $btnNonAktif = '<form action="' . route('staff.promos.patch', $data->id) . '" method="POST">' .
                        csrf_field() .
                        method_field('PATCH') .
                        '<button type="submit" class="btn btn-warning">Non-Aktifkan Promo</button>' .
                        '</form>';
                }else{
                    $btnAktif = '<form action="' . route('staff.promos.patch', $data->id) . '" method="POST">' .
                        csrf_field() .
                        method_field('PATCH') .
                        '<button type="submit" class="btn btn-warning">Aktifkan Promo</button>' .
                        '</form>';
                }
                return '<div class="d-flex justify-content-center gap-3">' . $btnEdit . $btnDelete . $btnNonAktif . $btnAktif . '</div>';
            })
            ->rawColumns(['activeBadge', 'buttons'])
            ->make(true);
    }
}
