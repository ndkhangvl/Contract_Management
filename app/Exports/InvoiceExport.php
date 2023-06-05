<?php

namespace App\Exports;

use App\Models\HoaDon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InvoiceExport implements FromCollection, WithHeadings, WithStyles
{

    public function collection()
    {
        return HoaDon::all();
    }

    public function map($invoice): array
    {
        /*$trangthai = "";
        if($invoice->HOADON_TRANGTHAI == 0){
            $trangthai = 'Ngừng hoạt động';
        }else{
            $trangthai = 'Đang hoạt động';
        }*/

        return [
            $invoice->HOADON_ID,
            $invoice->HOPDONG_ID,
            $invoice->HOADON_SO,
            $invoice->HOADON_FILE,
            $invoice->HOADON_TRANGTHAI,
            //$trangthai,
            $invoice->HOADON_TONGTIEN,
            $invoice->HOADON_THUESUAT,
            $invoice->HOADON_TIENTHUE,
            $invoice->HOADON_TONGTIEN_COTHUE,
            $invoice->HOADON_SOTIENBANGCHU,
            $invoice->HOADON_NGUOITAO,
            $invoice->HOADON_NGAYTAO,
            $invoice->HOADON_NGUOIMUAHANG,
        ];
    }

    public function headings(): array
    {
        return [
            'HOADON_ID',
            'HOPDONG_ID',
            'HOADON_SO',
            'HOADON_FILE',
            'HOADON_TRANGTHAI',
            'HOADON_TONGTIEN',
            'HOADON_THUESUAT',
            'HOADON_TIENTHUE',
            'HOADON_TONGTIEN_COTHUE',
            'HOADON_SOTIENBANGCHU',
            'HOADON_NGUOITAO',
            'HOADON_NGAYTAO',
            'HOADON_NGUOIMUAHANG',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:M1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ]);
        foreach(range('A', 'M') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }
}
