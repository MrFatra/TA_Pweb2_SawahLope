<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPayments extends ListRecords
{
    protected static string $resource = PaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('export')
                ->label('Export PDF')
                ->action(function () {
                    $data = \App\Models\Payment::all();

                    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.payment', [
                        'data' => $data
                    ]);

                    return response()->streamDownload(
                        fn() => print($pdf->stream()),
                        'laporan-keuangan.pdf'
                    );
                })
                ->icon('heroicon-o-arrow-down-tray'),
            Actions\CreateAction::make(),

        ];
    }
}
