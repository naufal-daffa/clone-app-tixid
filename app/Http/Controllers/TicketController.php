<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Cinema;
use App\Models\Promo;
use App\Models\Ticket;
use App\Models\TicketPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'user_id' => 'required',
            'schedule_id' => 'required',
            'rows_of_seats' => 'required',
            'quantity' => 'required',
            'total_price' => 'required',
        ]);

        $createData = Ticket::create([
            'user_id' => $request->user_id,
            'schedule_id' => $request->schedule_id,
            'quantity' => $request->quantity,
            'rows_of_seats' => $request->rows_of_seats,
            'total_price' => $request->total_price,
            'actived' => 1,
            'service_fee' => 4000 * $request->quantity,
        ]);

        return response()->json([
            'message' => 'berhasil',
            'data' => $createData
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    public function showSeats($scheduleId, $hourId){
        $schedule = Schedule::where('id', $scheduleId)->with(['cinema', 'movie'])->first();
        // dd($schedule['movie']);
        $hour = $schedule['hours'][$hourId] ?? '';
        return view('schedule.show-seats', compact('schedule', 'hour'));
    }

    public function ticketOrder($ticketId){
        // with disesuaikan dengan relasi
        $ticket = Ticket::where('id', $ticketId)->with(['schedule.cinema', 'schedule.movie'])->first();
        $promos = Promo::where('actived', 1)->get();
        // dd($ticket);
        return view('schedule.order', compact('ticket', 'promos'));
    }

    public function createBarcode(Request $request, $ticketId){
        $barcodeKode = 'TICKET' . $ticketId . rand(1, 10);

        $qrImage = QrCode::format('svg')->size(300)->margin(2)->generate($barcodeKode);

        $fileName = $barcodeKode . '.svg';

        $path = 'barcodes/' . $fileName;

        Storage::disk('public')->put($path, $qrImage);

        $createData = TicketPayment::create([
            'ticket_id' => $ticketId,
            'barcode' => $path,
            'status' => 'process',
            'booked_date' => now()
        ]);

        if($request->promo_id != NULL){
            $ticket = Ticket::find($ticketId);
            $promo = Promo::find($request->promo_id);
            if($promo && $promo['type'] == 'percent'){
                $totalPrice = $ticket['total_price'] - ($ticket['total_price'] * $promo['discount']/100);
            }else{
                $totalPrice = $ticket['total_price'] - $promo['discount'];
            };
            $ticket->update(['promo_id' => $request->promo_id, 'total_price' => $totalPrice]);
        }
        return response()->json(['message' => 'Berhasil!', 'data' => $createData]);
    }
}
