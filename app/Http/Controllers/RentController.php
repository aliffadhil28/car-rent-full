<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\DataTables\RentsDataTable;
use App\DataTables\PersetujuanDataTable;
use App\DataTables\HistoryDataTable;
use App\Models\Car;
use App\Models\User;
use App\Models\Rent;
use App\Models\Logs;

class RentController extends Controller
{
    public function index(RentsDataTable $dataTable)
    {
        $cars = Car::all();
        $penanggung_jawab = User::where('role', 'super_admin')->get();
        $drivers = User::where('role', 'driver')->get();
        return $dataTable->render('rents.index', ['cars' => $cars, 'penanggung_jawab' => $penanggung_jawab, 'drivers' => $drivers, 'rents' => null]);
        // return view('dashboard');
    }

    public function getRentData()
    {
        return datatables()->of(Rent::with(['user', 'car', 'pjSatu', 'pjDua']))->toJson();
    }

    public function store(Request $request)
    {
        Log::info('Store method called', ['request' => $request->all()]);

        $request->validate([
            'car_id' => ['required'],
            'user_id' => ['required'],
            'pj_satu' => ['required'],
            'pj_dua' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
        ]);

        try {

            DB::transaction(function () use ($request) {
                Car::find($request->car_id)->update(['isReady' => '0']);
                Rent::create([
                    'car_id' => $request->car_id,
                    'user_id' => $request->user_id,
                    'pj_satu' => $request->pj_satu,
                    'pj_dua' => $request->pj_dua,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'created_at' => now(),
                ]);
                Logs::create([
                    'user_id' => auth()->user()->id,
                    'action' => "Menyewa mobil",
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'url' => $request->path(),
                    'created_at' => now(),
                ]);
            });

            Log::info('Store method completed');
            return redirect('/dashboard');
        } catch (\Exception $e) {
            Log::error('An error occurred while creating the rent', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'An error occurred while creating the rent.', 'error' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        $rent = Rent::with(['user', 'car', 'pjSatu', 'pjDua'])->find($id);
        return response()->json($rent);
    }

    public function update(Request $request)
    {
        Log::info('Update method called', ['request' => $request->all()]);

        // Validasi input
        $request->validate([
            'car_id' => ['required'],
            'user_id' => ['required'],
            'pj_satu' => ['required'],
            'pj_dua' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'status' => ['required'], // Tambahkan validasi untuk status jika diperlukan
        ]);

        // dd($request);
        try {
            DB::transaction(function () use ($request) {
                $rent = Rent::findOrFail($request->rent_id);
                $status = $rent->status;
                if(isset($request->status) && $request->status == '1') {
                    $status = 4;
                }

                // Update status readiness of the car if the car_id has changed
                if ($rent->car_id !== $request->car_id) {
                    Car::find($rent->car_id)->update(['isReady' => '1']); // Set previous car as ready
                    Car::find($request->car_id)->update(['isReady' => '0']); // Set new car as not ready
                }

                // Update rent data
                $rent->update([
                    'car_id' => $request->car_id,
                    'user_id' => $request->user_id,
                    'pj_satu' => $request->pj_satu,
                    'pj_dua' => $request->pj_dua,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'status' => $status,
                    'updated_at' => now(),
                ]);

                Logs::create([
                    'user_id' => auth()->user()->id,
                    'action' => "Mengupdate data sewa mobil",
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'url' => $request->path(),
                    'created_at' => now(),
                ]);
            });

            Log::info('Update method completed');
            return redirect('/dashboard');
        } catch (\Exception $e) {
            Log::error('An error occurred while updating the rent', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'An error occurred while updating the rent.', 'error' => $e->getMessage()], 500);
        }
    }

    public function statusChange(Request $request)
    {
        // Mulai transaksi
        DB::transaction(function () use ($request) {
            $rent = Rent::findOrFail($request->rent_id);

            $status = $rent->status;
            if ($request->status == '0' && $rent->status == '0') {
                $status = 3;
            } else if ($request->status == '0' && $rent->status == '1') {
                $status = 3;
            } else if ($request->status == '1' && $rent->status == '1') {
                $status = 2;
            } else if($request->status == '2') {
                $status = 4;
            }
            else {
                $status = 1;
            }

            // Update status rental
            $rent->update([
                'status' => $status,
                'updated_at' => now(),
            ]);

            // Buat log
            Logs::create([
                'user_id' => auth()->user()->id,
                'action' => "Mengubah data status sewa mobil",
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->path(),
                'created_at' => now(),
            ]);
        });

        return redirect('/dashboard');
    }

    public function persetujuan(PersetujuanDataTable $dataTable)
    {
        $cars = Car::all();
        $penanggung_jawab = User::where('role', 'super_admin')->get();
        $drivers = User::where('role', 'driver')->get();
        return $dataTable->render('rents.persetujuan', ['cars' => $cars, 'penanggung_jawab' => $penanggung_jawab, 'drivers' => $drivers]);
    }

    public function history(HistoryDataTable $dataTable){
        return $dataTable->render('rents.history');
    }

    public function dashboard() {
        $rents = Rent::with('car')->get()->groupBy('car_id');

        $carUsage = [];
        foreach ($rents as $car_id => $rentsGroup) {
            $carName = $rentsGroup->first()->car->name;
            $carUsage[] = [
                'name' => $carName,
                'count' => $rentsGroup->count(),
            ];
        }

        $carNames = array_column($carUsage, 'name');
        $carCounts = array_column($carUsage, 'count');

        return view('dashboard', ['carNames' => $carNames, 'carCounts' => $carCounts]);
    }

}
