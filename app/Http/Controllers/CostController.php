<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use PDF;

class CostController extends Controller
{
    private $storagePath = 'hpp_data/';

    public function index()
    {
        return view('hpp_form');
    }

    private function getUserHistoryFile()
    {
        // Identifikasi pengguna berdasarkan session
        $userId = Session::getId(); // Session ID digunakan sebagai pengenal unik
        return storage_path("app/{$this->storagePath}{$userId}_history.json");
    }

    private function readHistory()
    {
        $filePath = $this->getUserHistoryFile();

        if (File::exists($filePath)) {
            return json_decode(File::get($filePath), true); // Decode file JSON menjadi array
        }

        return []; // Kembalikan array kosong jika file tidak ada
    }

    private function writeHistory(array $history)
    {
        $filePath = $this->getUserHistoryFile();

        // Pastikan direktori tersedia
        if (!File::exists(storage_path("app/{$this->storagePath}"))) {
            File::makeDirectory(storage_path("app/{$this->storagePath}"), 0755, true);
        }

        // Simpan data JSON ke file
        File::put($filePath, json_encode($history, JSON_PRETTY_PRINT));
    }

    public function calculate(Request $request)
    {
        // Validasi Input
        $request->validate([
            'namaproduct' => 'required|string',
            'product_quantity' => 'required|numeric|min:1',
            'materials.*.name' => 'required|string',
            'materials.*.kebutuhan' => 'required|string',
            'materials.*.quantity' => 'required|numeric|min:0',
            'materials.*.unit_price' => 'required|numeric|min:0',
            'labor.workers' => 'nullable|numeric|min:0',
            'labor.rate' => 'nullable|numeric|min:0',
            'labor.hours' => 'nullable|numeric|min:0',
            'overhead' => 'nullable|numeric|min:0',
            'additional' => 'nullable|numeric|min:0',
            'profit_margin' => 'nullable|numeric|min:0',
        ]);

        // Ambil Data
        $namaproduct = $request->namaproduct;
        $product_quantity = $request->product_quantity;
        $materials = $request->materials;
        $labor = $request->labor;
        $overhead = $request->overhead ?? 0;
        $additional = $request->additional ?? 0;
        $profit_margin = $request->profit_margin ?? 0;

        // Hitung Total Biaya Bahan Baku
        $total_materials = array_reduce($materials, function ($carry, $item) {
            return $carry + ($item['quantity'] * $item['unit_price']);
        }, 0);

        // Hitung Biaya Tenaga Kerja
        $labor_cost = ($labor['workers'] ?? 0) * ($labor['rate'] ?? 0) * ($labor['hours'] ?? 0);

        // Hitung HPP Dasar per Produk
        $base_hpp = $total_materials / $product_quantity;

        // Hitung Biaya Tenaga Kerja per Produk
        $labor_cost_per_product = $labor_cost / $product_quantity;

        // Hitung Overhead per Produk
        $overhead_per_product = $overhead / $product_quantity;

        // Hitung Biaya Operasional Tambahan per Produk
        $additional_per_product = $additional / $product_quantity;

        // Hitung Total HPP per Produk
        $total_hpp_per_product = $base_hpp + $labor_cost_per_product + $overhead_per_product + $additional_per_product;

        // Hitung Harga Jual
        $recommended_price = $total_hpp_per_product * (1 + ($profit_margin / 100));

        // Data untuk hasil dan PDF
        $data = compact(
            'namaproduct',
            'product_quantity',
            'materials',
            'total_materials',
            'labor_cost',
            'labor_cost_per_product',
            'overhead_per_product',
            'additional_per_product',
            'total_hpp_per_product',
            'recommended_price',
            'profit_margin'
        );

        // Simpan hasil ke riwayat pengguna
        $history = $this->readHistory();
        $history[] = array_merge($data, ['date' => now()->toDateTimeString()]);
        $this->writeHistory($history);

        // Generate PDF dan simpan ke server
        $fileName = 'HPP_Calculation_' . str_replace(' ', '_', $namaproduct) . '.pdf';
        $filePath = storage_path("app/public/hpp/{$fileName}");

        $pdf = PDF::loadView('hpp_pdf', $data);
        $pdf->save($filePath);

        // Kirim data ke tampilan hasil
        return view('hpp_result', array_merge($data, ['pdf_url' => asset("storage/hpp/{$fileName}"), 'history' => $history]));
    }

    public function showHistory()
    {
        // Ambil riwayat pengguna
        $history = $this->readHistory();
        return view('hpp_history', compact('history'));
    }

    public function clearHistory()
    {
        // Hapus file riwayat pengguna
        $filePath = $this->getUserHistoryFile();
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        return redirect()->back()->with('message', 'Riwayat berhasil dihapus.');
    }
}

