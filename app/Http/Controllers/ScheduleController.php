<?php

namespace App\Http\Controllers;

use App\Exports\ScheduleExport;
use App\Models\Schedule;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use App\Models\Cinema;
use App\Models\Movie;
use Maatwebsite\Excel\Facades\Excel;
use Psy\CodeCleaner\ReturnTypePass;
use Yajra\DataTables\Facades\DataTables;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cinemas = Cinema::all();
        $movies = Movie::where('actived', 1)->get();

        // mengambil data detail dari relasi
        // ['namaModel', 'namaModel']
        $schedules = Schedule::with(['cinema', 'movie'])->get();
        return view('staff.schedules.index', compact('schedules', 'cinemas', 'movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cinema_id' => 'required',
            'movie_id' => 'required',
            'price' => 'required|numeric',
            'hours.*' => 'required|date_format:H:i'
        ], [
            'cinema_id.required' => 'Bioskop wajib diisi!',
            'movie_id.required' => 'Movie wajib diisi!',
            'price.required' => 'Harga wajib diisi!',
            'price.numeric' => 'Harga wajib bernilai angka',
            'hours.*.required' => 'Jam tayang wajib diisi!',
            'hours.*.date_format' => 'Jam tayang wajib diisi dengan jam:menit',
        ]);
        // value() => hanya mengambil field tertentu
        $hours = Schedule::where('cinema_id', $request->cinema_id)->where('movie_id', $request->movie_id)->value('hours');
        // ??  ternary untuk mengatasi null jika tidak ada data sebelumnya
        $hoursBefore = $hours ?? [];
        // menggabungakan array dengan array
        $mergeHours = array_merge($hoursBefore, $request->hours);
        // untuk menghilankan data duplikat
        $newHours = array_unique($mergeHours);
        // array pertama mencari data kalau ketemu bakal update, kalau tidak semua bakal terbuat
        $createSchedule = Schedule::updateOrCreate([
            'cinema_id' => $request->cinema_id,
            'movie_id' => $request->movie_id,
        ], [
            'hours' => $newHours,
            'price' => $request->price,
        ]);

        if ($createSchedule) {
            return redirect()->route('staff.schedules.index')->with('success', 'Berhasil menambahkan data!');
        } else {
            return redirect()->back()->with('error', 'Gagal! silahkan coba lagi');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $schedule = Schedule::where('id', $id)->with('cinema', 'movie')->first();
        return view('staff.schedules.edit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'price' => 'required|numeric',
            'hours.*' => 'required|date_format:H:i'
        ], [
            'price.required' => 'Harga wajib diisi!',
            'price.numeric' => 'Harga wajib bernilai angka',
            'hours.*.required' => 'Jam tayang wajib diisi!',
            'hours.*.date_format' => 'Jam tayang wajib diisi dengan jam:menit',
        ]);

        $editSchedule = Schedule::where('id', $id)->update([
            'price' => $request->price,
            'hours' => array_unique($request->hours),
        ]);

        if ($editSchedule) {
            return redirect()->route('staff.schedules.index')->with('success', 'Berhasil mengubah data!');
        } else {
            return redirect()->back()->with('error', 'Gagal! silahkan coba lagi');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deleteSchedule = Schedule::where('id', $id)->delete();
        if ($deleteSchedule) {
            return redirect()->route('staff.schedules.index')->with('success', 'Data berhasil dihapus!');
        } else {
            return redirect()->back()->with('failed', 'Gagal! silahkan coba lagi');
        }
    }

    public function trash()
    {
        // onlyTrashed() mengambil data yang sudah dihapus dengan fungsi soft delete/ destroy
        $schedules = Schedule::onlyTrashed()->with(['cinema', 'movie'])->get();
        return view('staff.schedules.trash', compact('schedules'));
    }

    public function deletePermanent($id)
    {
        $deleteSchedule = Schedule::where('id', $id)->forceDelete();
        if ($deleteSchedule) {
            return redirect()->route('staff.schedules.index')->with('success', 'Data berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Gagal! silahkan coba lagi');
        }
    }

    public function restore($id)
    {
        $schedule = Schedule::withTrashed()->where('id', $id)->restore();
        if ($schedule) {
            return redirect()->route('staff.schedules.index')->with('success', 'Data berhasil dipulihkan!');
        } else {
            return redirect()->back()->with('error', 'Gagal! silahkan coba lagi');
        }
    }

    public function exportExcel()
    {
        $file_name = 'Schedule_list' . '.xlsx';
        return Excel::download(new ScheduleExport, $file_name);
    }

    public function dataForDatatables()
    {
        $schedules = Schedule::with(['cinema', 'movie'])->get();

        return DataTables::of($schedules)
            ->addIndexColumn()
            ->addColumn('cinema', function ($data) {
                return $data->cinema->name;
            })
            ->addColumn('movie', function ($data) {
                return $data->movie->title;
            })
            ->addColumn('price', function ($data) {
                return 'Rp ' . number_format($data->price, 0, ',', '.');
            })
            ->addColumn('hours', function ($data) {
                $list = '<ul>';
                foreach ($data->hours as $hour) {
                    $list .= '<li>' . $hour . '</li>';
                }
                $list .= '</ul>';
                return $list;
            })
            ->addColumn('buttons', function ($data) {
                $btnEdit = '<a href="' . route('staff.schedules.edit', $data->id) . '" class="btn btn-primary">Edit</a>';
                $btnDelete = '<form action="' . route('staff.schedules.delete', $data->id) . '" method="POST" style="display:inline-block;">'
                    . csrf_field()
                    . method_field('DELETE')
                    . '<button type="submit" class="btn btn-danger">Hapus</button></form>';
                return '<div class="d-flex gap-2 justify-content-center">' . $btnEdit . $btnDelete . '</div>';
            })
            ->rawColumns(['hours', 'buttons'])
            ->make(true);
    }
}
