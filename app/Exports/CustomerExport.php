<?php

namespace App\Exports;

use App\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CustomerExport implements FromCollection, WithHeadings, WithStyles
{
    function __construct($data)
	{
		$this->data = $data;
	}

	public function headings():array
	{
		return[
			'No.',
			'First_Name',
			'Last_Name',
			'Email',
			'Mobile No',
			'Adress',
			'Pincode',
			'City',
			'State',
		];
	}
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
    	$report_data = $this->data;
    	// dd($data); 
    	return($report_data);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
