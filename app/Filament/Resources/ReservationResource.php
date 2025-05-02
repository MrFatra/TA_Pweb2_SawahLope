<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Filament\Resources\ReservationResource\RelationManagers;
use App\Models\Reservation;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function getModelLabel(): string
    {
        return 'Reservasi';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pemesan')
                    ->description('Informasi terkait pemesan reservasi.')
                    ->collapsible()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('full_name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->live(onBlur: true)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone_number')
                            ->label('Nomor Telepon')
                            ->nullable()
                            ->tel()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->nullable()
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('seat_number')
                            ->label('Nomor Meja')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(100)
                            ->placeholder('Masukkan nomor meja'),
                        Forms\Components\TextInput::make('guest_count')
                            ->label('Jumlah Tamu')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(10),
                        Forms\Components\DatePicker::make('reservation_date')
                            ->label('Tanggal Kunjungan')
                            ->required()
                            ->minDate(now())
                    ]),
                Forms\Components\Section::make('Informasi Pembayaran')
                    ->description('Informasi pembayaran reservasi.')
                    ->collapsible()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('total_price')
                            ->label('Total Harga')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->prefix('Rp')
                            ->placeholder('Masukkan total harga'),

                        Forms\Components\Select::make('payable_type')
                            ->label('Tipe Pembayaran')
                            ->options([
                                \App\Models\Reservation::class => 'Reservasi',
                                \App\Models\Ticket::class => 'Tiket',
                            ])
                            ->nullable()
                            ->reactive(),

                        Forms\Components\Select::make('payable_id')
                            ->label('Atas Nama Pembayaran')
                            ->options(function (callable $get) {
                                $type = $get('payable_type');
                                return $type ? $type::pluck('full_name', 'id') : [];
                            })
                            ->nullable(),

                        Forms\Components\TextInput::make('payment_method')
                            ->label('Metode Pembayaran')
                            ->required()
                            ->placeholder('Masukkan metode pembayaran')
                            ->maxLength(255),
                    ]),
                Forms\Components\Section::make('Informasi Tiket')
                    ->description('Silakan isi informasi tiket dengan lengkap dan benar.')
                    ->collapsible()
                    ->columns(2)
                    ->schema([
                        Forms\Components\Group::make([
                            Forms\Components\TextInput::make('ticket_code')
                                ->label('Kode Tiket')
                                ->password()
                                ->revealable()
                                ->prefixAction(
                                    \Filament\Forms\Components\Actions\Action::make('copy')
                                        ->icon('heroicon-o-clipboard-document')
                                        ->tooltip('Copy ke clipboard')
                                        ->color('gray')
                                        ->action(function ($livewire, $state) {
                                            $livewire->js(
                                                'window.navigator.clipboard.writeText("' . $state . '")'
                                            );
                                        })
                                )
                                ->readOnly()
                                ->unique(Ticket::class, 'ticket_code', fn($record) => $record)
                                ->readOnly(),
                        ])->relationship('ticket', 'ticket_code'),
                        Forms\Components\ToggleButtons::make('status')
                            ->label('Status')
                            ->inline()
                            ->default('pending')
                            ->options([
                                'pending' => 'Menunggu',
                                'confirmed' => 'Dikonfirmasi',
                                'canceled' => 'Dibatalkan',
                            ])
                            ->icons([
                                'pending' => 'heroicon-o-clock',
                                'confirmed' => 'heroicon-o-check-circle',
                                'canceled' => 'heroicon-o-x-circle',
                            ])
                            ->colors([
                                'pending' => 'warning',
                                'confirmed' => 'success',
                                'canceled' => 'danger',
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nama Pemesan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('Nomor Telepon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reservation_date')
                    ->label('Tanggal Kunjungan')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total Harga')
                    ->money('IDR', true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status Reservasi')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'pending' => 'Menunggu',
                            'confirmed' => 'Dikonfirmasi',
                            'canceled' => 'Dibatalkan',
                        };
                    })
                    ->colors([
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'canceled' => 'danger',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'view' => Pages\ViewReservation::route('/{record}'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }
}
