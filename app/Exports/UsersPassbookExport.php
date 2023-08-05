<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\Passbook;
use Auth;
use Carbon\Carbon;

class UsersPassbookExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithMapping
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       
        $passbooks = Passbook::with('user')->get();
        
        $userPassbooks =  $passbooks->map(function ($item) {
            $item->name = $item->user->name;
            $item->unique_code = $item->user->unique_code;
            $item->credit_amount = $item->credit_amount;
            $item->debit_amount = $item->debit_amount;
            $item->current_balance = $item->current_balance;
            $item->purpose = $item->purpose;
            $item->date = Carbon::parse($item->created_at)->format('Y-m-d');
            return $item;
        });
        return collect($userPassbooks);
        
    }

    public function headings(): array
    {
        return [
            'Name',
            'Unique Code',
            'Purpose',
            'Credit Amount',
            'Debit Amount',
            'Total Amount',
            'Date'
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:G1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true)->setSize(14);
            },
        ];
    }

    public function map($passbook): array
    {
        return [
            $passbook->name,
            $passbook->unique_code,
            $passbook->purpose,
            $passbook->credit_amount,
            $passbook->debit_amount,
            $passbook->current_balance,
            $passbook->date,
        ];
    }
}
