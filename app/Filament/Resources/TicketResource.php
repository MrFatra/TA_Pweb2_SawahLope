<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\RelationManagers;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    public static function getModelLabel(): string
    {
        return 'Tiket';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pengunjung')
                    ->description('Informasi tentang pengunjung yang akan datang.')
                    ->collapsible()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('full_name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (callable $set, $state) {
                                $ticket = [
                                    'id' => \Illuminate\Support\Str::uuid(),
                                    'full_name' => $state,
                                ];

                                $set('ticket_code', Ticket::generateTicketCode($ticket));
                            })
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
                            ->maxLength(255)
                    ]),
                Forms\Components\Section::make('Informasi Tiket')
                    ->description('Informasi tiket yang akan dibeli.')
                    ->collapsible()
                    ->columns(2)
                    ->schema([
                        Forms\Components\DateTimePicker::make('visit_date')
                            ->label('Tanggal Kunjungan')
                            ->required()
                            ->native(false)
                            ->minDate(now())
                            ->maxDate(now()->addDays(30))
                            ->placeholder('Pilih tanggal kunjungan'),
                        Forms\Components\TextInput::make('guest_count')
                            ->label('Jumlah Tamu')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->placeholder('Masukkan jumlah tamu')
                            ->live()
                            ->afterStateUpdated(function (callable $set, $state) {
                                $set('total_price', $state * 10000);
                            }),
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
                    ]),

                Forms\Components\Section::make('Informasi Pembayaran')
                    ->description('Informasi pembayaran yang akan dilakukan.')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('total_price')
                            ->label('Total Harga')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->prefix('Rp')
                            ->readOnly()
                            ->placeholder('Total harga')
                            ->helperText('Total harga tiket otomatis terisi berdasarkan jumlah tamu')
                    ]),

                Forms\Components\Section::make('Status Tiket')
                    ->description('Konfirmasi tiket yang akan dibeli.')
                    ->collapsible()
                    ->columns(2)
                    ->schema([
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
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('Nomor Telepon')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('visit_date')
                    ->label('Tanggal Kunjungan')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total Harga')
                    ->money('IDR', true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status Tiket')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'pending' => 'Menunggu',
                            'confirmed' => 'Dikonfirmasi',
                            'canceled' => 'Dibatalkan',
                        };
                    })
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'confirmed',
                        'danger' => 'canceled',
                    ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()->color('info'),
                Tables\Actions\Action::make('konfirmasi')
                    ->label('Konfirmasi')
                    ->action(function (Ticket $record) {
                        $record->update(['status' => 'confirmed']);
                        \Filament\Notifications\Notification::make()
                            ->title('Tiket berhasil dikonfirmasi')
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->visible(fn($record) => $record->status !== 'confirmed')
                    ->color('success')
                    ->icon('heroicon-o-check-circle'),
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
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'view' => Pages\ViewTicket::route('/{record}'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
