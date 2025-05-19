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
            Actions\CreateAction::make(),
            Actions\ActionGroup::make([
                Actions\Action::make('export-excel')
                    ->label('Export Excel')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->action(function () {
                        return response()->streamDownload(
                            fn() => print(\Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\PaymentsExport, 'payments.xlsx')->getFile()->getContent()),
                            'laporan-keuangan.xlsx'
                        );
                    }),
                Actions\Action::make('export-pdf')
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
                    ->icon('heroicon-o-arrow-up-tray'),
                Actions\Action::make('import')
                    ->label('Import Excel')
                    ->form([
                        \Filament\Forms\Components\FileUpload::make('file')
                            ->label('File Excel')
                            ->required()
                            ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'])
                            ->disk('public')
                            ->directory('imports'),
                    ])
                    ->action(function (array $data) {
                        \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\PaymentsImport, $data['file']->getRealPath());

                        \Filament\Facades\Filament::notify('success', 'Import berhasil!');
                    })
                    ->icon('heroicon-o-arrow-down-tray'),
            ]),
        ];
    }
}
