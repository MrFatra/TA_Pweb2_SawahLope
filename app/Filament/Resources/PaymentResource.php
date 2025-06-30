<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function getModelLabel(): string
    {
        return 'Pembayaran';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // TODO: Ambil hanya data reservasi atau tiket yang sudah dikonfirmasi
                Forms\Components\Section::make('Informasi Pemesan')
                    ->description('Informasi terkait pemesan pembayaran.')
                    ->collapsible()
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('payable_type')
                            ->label('Tipe Pembayaran')
                            ->options([
                                \App\Models\Ticket::class => 'Tiket',
                                \App\Models\Reservation::class => 'Reservasi',
                            ])
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (callable $set) {
                                $set('payable_id', null);
                                $set('full_name', null);
                                $set('phone_number', null);
                                $set('email', null);
                            }),

                        Forms\Components\Select::make('payable_id')
                            ->label('ID Pemesan')
                            ->options(function (callable $get) {
                                $type = $get('payable_type');

                                if ($type === \App\Models\Ticket::class) {
                                    // ambil data tiket yang sudah "dikonfirmasi"
                                    return \App\Models\Ticket::where('status', 'confirmed')
                                        ->get()
                                        ->mapWithKeys(fn($item) => [
                                            $item->id => "{$item->full_name} - Tiket",
                                        ]);
                                }

                                if ($type === \App\Models\Reservation::class) {
                                    return \App\Models\Reservation::where('status', 'confirmed')
                                        ->get()
                                        ->mapWithKeys(fn($item) => [
                                            $item->id => "{$item->full_name} - Reservasi",
                                        ]);
                                }

                                return [];
                            })
                            ->afterStateUpdated(function (callable $set, $get, $state) {
                                // set the full_name based on the selected payable_id
                                $type = $get('payable_type');
                                $model = $type === \App\Models\Ticket::class
                                    ? \App\Models\Ticket::find($state)
                                    : \App\Models\Reservation::find($state);
                                $set('full_name', $model?->full_name);
                                $set('phone_number', $model?->phone_number);
                                $set('email', $model?->email);
                                $set('amount', $model?->total_price);
                            })
                            ->required()
                            ->searchable()
                            ->live()
                            ->placeholder('Pilih ID pemesan'),

                        Forms\Components\TextInput::make('full_name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->readOnly()
                            ->live(onBlur: true)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone_number')
                            ->label('Nomor Telepon')
                            ->nullable()
                            ->readOnly()
                            ->tel()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->nullable()
                            ->readOnly()
                            ->email()
                            ->maxLength(255),
                    ]),

                Forms\Components\Section::make('Informasi Pembayaran Tiket')
                    ->visible(fn($get) => $get('payable_type') === \App\Models\Ticket::class)
                    ->description('Informasi terkait pembayaran tiket.')
                    ->collapsible()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('order_id')
                            ->label('ID Transaksi')
                            ->default(fn() => strtoupper('ORD-' . now()->format('Ymd-His') . '-' . \Illuminate\Support\Str::random(6)))
                            ->readOnly()
                            ->required()
                            ->dehydrated()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('amount')
                            ->label('Jumlah Pembayaran')
                            ->required()
                            ->prefix('Rp.')
                            ->numeric()
                            ->minValue(1)
                            ->placeholder('Jumlah pembayaran'),
                        Forms\Components\TextInput::make('payment_method')
                            ->label('Metode Pembayaran')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\ToggleButtons::make('status')
                            ->label('Status')
                            ->inline()
                            ->default('pending')
                            ->options([
                                'pending' => 'Menunggu',
                                'paid' => 'Dibayar',
                                'failed' => 'Dibatalkan',
                            ])
                            ->icons([
                                'pending' => 'heroicon-o-clock',
                                'paid' => 'heroicon-o-check-circle',
                                'failed' => 'heroicon-o-x-circle',
                            ])
                            ->colors([
                                'pending' => 'warning',
                                'paid' => 'success',
                                'failed' => 'danger',
                            ]),
                    ]),

                Forms\Components\Section::make('Informasi Pembayaran Reservasi')
                    ->visible(fn($get) => $get('payable_type') === \App\Models\Reservation::class)
                    ->description('Informasi terkait pembayaran reservasi.')
                    ->collapsible()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('order_id')
                            ->label('ID Transaksi')
                            ->required()
                            ->readOnly()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('amount')
                            ->label('Jumlah Pembayaran')
                            ->required()
                            ->readOnly()
                            ->prefix('Rp.')
                            ->numeric()
                            ->minValue(1)
                            ->placeholder('Masukkan jumlah pembayaran'),
                        Forms\Components\TextInput::make('payment_method')
                            ->label('Metode Pembayaran')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\ToggleButtons::make('status')
                            ->label('Status')
                            ->inline()
                            ->default('pending')
                            ->options([
                                'pending' => 'Menunggu',
                                'paid' => 'Dibayar',
                                'failed' => 'Dibatalkan',
                            ])
                            ->icons([
                                'pending' => 'heroicon-o-clock',
                                'paid' => 'heroicon-o-check-circle',
                                'failed' => 'heroicon-o-x-circle',
                            ])
                            ->colors([
                                'pending' => 'warning',
                                'paid' => 'success',
                                'failed' => 'danger',
                            ]),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_id')
                    ->label('ID Transaksi')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nama Pemesan')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('payable_type')
                    ->label('Tipe Pembayaran')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            \App\Models\Ticket::class => 'Tiket',
                            \App\Models\Reservation::class => 'Reservasi',
                        };
                    })
                    ->colors([
                        'success' => \App\Models\Ticket::class,
                        'info' => \App\Models\Reservation::class,
                    ]),
                Tables\Columns\TextColumn::make('gross_amount')
                    ->label('Jumlah Pembayaran')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status Pembayaran')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'pending' => 'Menunggu',
                            'paid' => 'Dibayar',
                            'failed' => 'Dibatalkan',
                        };
                    })
                    ->colors([
                        'pending' => 'warning',
                        'paid' => 'success',
                        'failed' => 'danger',
                    ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'view' => Pages\ViewPayment::route('/{record}'),
        ];
    }
}
