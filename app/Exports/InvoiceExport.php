<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class InvoiceExport implements FromCollection, WithHeadings, WithStyles, WithCalculatedFormulas
{

	function __construct($data)
	{
		$this->data = $data;
	}

	public function headings():array
	{
		return[
			'No.',
			'Name',
			'Status',
			'Issue Date',
			'Due Date',
			'Quantity',
			'Total',
		];
	}
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
    	$report_data = $this->data;
    	$data = $report_data->map(function($query){
    		$customer_name = $query->customer->first_name.' '.$query->customer->last_name;
    		$query['customer_id'] = $customer_name;
    		// dd($query);
    		return $query;
    	});
        // $c = new \Illuminate\Database\Eloquent\Collection;
        // $c['total'] = $report_data->sum('total');
        // $report_data = $report_data->merge($c);
        // dd($report_data);
    	// dd($data); 
    	return($data);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

}
