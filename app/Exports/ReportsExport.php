<?php

namespace App\Exports;

use App\Models\Report;
//mengambil data dari database
use Maatwebsite\Excel\Concerns\FromCollection;
//mengatur nama2 column header excelnya
use Maatwebsite\Excel\Concerns\WithHeadings; 
// mengatur data yg di munculkan tiap column dia excelnya
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    //mengambl data dari database 
    public function collection()
    {
        //di dalam sini boleh menyertakan perintah eloquent lain seperti where, all, dll
        return Report::with('response')->orderBy('created_at', 'DESC')->get();
    }
    //mengatur nama2 column headers: di ambil dari withHeadings
    public function headings(): array
    {
        return [
            'ID',
            'NIK Pelapor',
            'Nama Pelapor',
            'No Telp Pelapor',
            'Tanggal Pelaporan',
            'Pengaduan',
            'Status Response',
            'Pesan Response',
        ];
    }
    //mengatur data yang di tampilkan per column di excelnya 
    //fungsinya seperti foreach. $item merupakan bagian as pada foreach
    public function map($item): array 
    {
return [
    $item->idate,
    $item->nik,
    $item->nama,
    $item->no_telp,
    \Carbon\Carbon::parse($item->created_at)->format('J F, Y'),
    $item->pengaduan,
    $item->response ? $item->response['status'] : '-',
    $item->response ? $item->response['pesan'] : '-',
];
    }
}
