<?php

namespace App\Exports;

use App\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PaymentExport implements FromCollection, WithHeadings, WithStyles
{
    function __construct($data)
	{
		$this->data = $data;
	}

	public function headings():array
	{
		return[
			'Invoice_id',
			'Date',
			'Mode',
			'Total',
			'Paid',
			'Due',
		];
	}
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
    	$report_data = $this->data;
    	// dd($report_data); 
    	return collect($report_data);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
