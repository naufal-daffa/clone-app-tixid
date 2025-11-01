<?php

namespace App\Http\Controllers;

use App\Exports\CinemaExport;
use App\Models\Cinema;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

// use Illuminate\Contracts\View\View;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Facades\Storage;
// // use Illuminate\Http\Request;

class CinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // public function index()// munculin banyak data
    // {
    //     // $cinemas = Cinema::latest()->paginate(10);
    //     // return view('admin.cinema.index', compact('cinemas'));
    //     //      limit()->get()
    //     // mengambil semua data
    //     $cinemas = Cinema::all();
    //     // return view('admin.cinemas.index', compact('cinemas')); //mengirinkan data
    //     return response()->json([
    //         'cinemas' => $cinemas
    //     ]);
    // }

    public function index()
        {
            $cinemas = Cinema::all();

            return view('admin.cinemas.index', compact('cinemas'));
        }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cinemas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required|min:10'
        ], [
            'name.required' => 'Nama bioskop wajib diisi!',
            'location.required' => 'Lokasi bioskop wajib diisi!',
            'location.min:10' => 'Lokasi bioskop minimal 10 karakter!',
        ]);
        $createCinema = Cinema::create([
            'name' => $request->name,
            'location' => $request->location,
        ]);
        if($createCinema){
            return redirect()->route('admin.cinemas.index')->with('success', 'Berhasil membuat data!');
        }else{
            return redirect()->back()->with('error', 'Gagal! silahkan coba lagi');
        };
        //
        // return view('admin.cinema.create');
    }

    /**
     * Display the specified resource.
     */

    public function show(Cinema $cinema)// untuk satu data
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $cinema = Cinema::Find($id);
        return view('admin.cinemas.edit', compact('cinema'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cinema $cinema, $id)
    {
        // $cinema = Cinema::Find($id);
        // return view('admin.cinema.edit',  compact('cinema'));

        $request->validate([
            'name' => 'required',
            'location' => 'required|min:10'
        ], [
            'name.required' => 'Nama wajib bioskop wajib di isi!',
            'location.required' => 'Lokasi wajib di isi!',
            'location.min' => 'Panjang karakter minimal 10!'
        ]);

        $updateCinema = Cinema::where('id', $id)->update([
            'name' => $request->name,
            'location' => $request->location
        ]);

        if($updateCinema){
            return redirect()->route('admin.cinemas.index')->with('success', 'Berhasil mengubah data!');
        }else{
            return redirect()->back()->with('failed', 'Gagal! silahkan coba lagi');
        };

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // $cinema = Cinema::Find($id);
        // $cinema->delete();
        $deleteCinema = Cinema::where('id', $id)->delete();
        $schedules = Schedule::where('movie_id', $id)->count();
        if($schedules) {
            return redirect()->route('admin.movies.index')->with('failed', 'Tidak dapat menghapus data bioskop! Data tertaut fengan jadwal tayang');
        }
        if($deleteCinema){
            return redirect()->route('admin.cinemas.index')->with('success', 'Data berhasil dihapus!');
        }else{
            return redirect()->back()->with('failed', 'Gagal! silahkan coba lagi');
        }
    }
    public function exportExcel()
    {
        $file_name = 'Cinema_list'.'.xlsx';
        return Excel::download(new CinemaExport, $file_name);
    }
     public function trash()
    {
        // onlyTrashed() mengambil data yang sudah dihapus dengan fungsi soft delete/ destroy
        $cinemas = Cinema::onlyTrashed()->get();
        return view('admin.cinemas.trash', compact('cinemas'));
    }

    public function deletePermanent($id)
    {
        $deleteCinema = Cinema::where('id', $id)->forceDelete();
        if ($deleteCinema) {
            return redirect()->route('admin.cinemas.trash')->with('success', 'Data berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Gagal! silahkan coba lagi');
        }
    }

    public function restore($id)
    {
        $cinema = Cinema::withTrashed()->where('id', $id)->restore();
        if ($cinema) {
            return redirect()->route('admin.cinemas.index')->with('success', 'Data berhasil dipulihkan!');
        } else {
            return redirect()->back()->with('error', 'Gagal! silahkan coba lagi');
        }
    }

    public function dataForDatatables(){
         $cinemas = Cinema::query();
        return DataTables::of($cinemas)
            ->addIndexColumn()
            ->addColumn('buttons', function ($data) {
                $btnEdit = '<a href="' . route('admin.cinemas.edit', $data->id) . '" class="btn btn-primary">Edit</a>';
                $btnDelete = '<form action="' . route('admin.cinemas.delete', $data->id) . '" method="POST">' .
                    csrf_field() .
                    method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger">Hapus</button>
                        </form>';
                return '<div class="d-flex justify-content-center gap-3">' . $btnEdit . $btnDelete . '</div>';
            })
            ->rawColumns(['buttons'])
            ->make(true);
    }
}
