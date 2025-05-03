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

use function PHPUnit\Framework\isFloat;

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
                        Forms\Components\Select::make('ticket_id')
                            ->label('Tiket Atas Nama')
                            ->relationship(
                                'ticket',
                                'full_name',
                                fn(Builder $query) => $query
                                    ->where('status', 'confirmed')
                                    ->orderBy('created_at', 'desc')
                            )
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (\Filament\Forms\Set $set, \Filament\Forms\Get $get, $state) {
                                $ticket = Ticket::find($state);

                                if ($ticket) {
                                    $set('full_name', $ticket->full_name);
                                    $set('phone_number', $ticket->phone_number);
                                    $set('email', $ticket->email);
                                    $set('guest_count', $ticket->guest_count);
                                    $set('seat_number', $ticket->seat_number);
                                    $set('reservation_date', $ticket->visit_date);
                                    $set('ticket_code', $ticket->ticket_code);
                                    $set('ticket_price', $ticket->total_price * 1);

                                    $menus = collect($get('reservationMenus'))->filter(fn($menu) => is_array($menu) && isset($menu['menu_id']));
                                    self::updateTotals($get, $set, $menus, true);
                                }
                            })
                            ->searchable()
                            ->preload()
                            ->placeholder('Pilih tiket'),
                        Forms\Components\TextInput::make('full_name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->readOnly(fn($get) => $get('full_name') !== null)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone_number')
                            ->label('Nomor Telepon')
                            ->nullable()
                            ->readOnly(fn($get) => $get('phone_number') !== null)
                            ->tel()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->nullable()
                            ->readOnly(fn($get) => $get('email') !== null)
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
                            ->live()
                            ->readOnly(fn($get) => $get('guest_count') !== null)
                            ->minValue(1)
                            ->maxValue(10),
                        Forms\Components\DateTimePicker::make('reservation_date')
                            ->label('Tanggal Reservasi')
                            ->required()
                            ->native(false)
                            ->readOnly(fn($get) => $get('reservation_date') !== null)
                            ->minDate(now())
                            ->maxDate(now()->addDays(30))
                            ->placeholder('Tanggal reservasi'),
                    ]),

                Forms\Components\Section::make('Informasi Menu')
                    ->description('Informasi terkait menu yang dipesan.')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Repeater::make('reservationMenus')
                            ->label('Menu Makanan')
                            ->relationship()
                            ->live()
                            ->schema([
                                Forms\Components\Select::make('menu_id')
                                    ->label('Menu')
                                    ->options(\App\Models\Menu::pluck('name', 'id'))
                                    ->required()
                                    ->searchable()
                                    ->afterStateUpdated(function (\Filament\Forms\Get $get, \Filament\Forms\Set $set) {
                                        $menu = \App\Models\Menu::find($get('menu_id'));
                                        $set('subtotal', $menu->price * $get('quantity'));
                                    })
                                    ->disableOptionWhen(function ($value, $state, \Filament\Forms\Get $get) {
                                        return collect($get('../*.menu_id'))
                                            ->reject(fn($id) => $id == $state)
                                            ->filter()
                                            ->contains($value);
                                    })
                                    ->live(),

                                Forms\Components\TextInput::make('quantity')
                                    ->label('Jumlah')
                                    ->numeric()
                                    ->default(1)
                                    ->minValue(1)
                                    ->suffixAction(
                                        \Filament\Forms\Components\Actions\Action::make('add')
                                            ->icon('heroicon-o-plus')
                                            ->color('success')
                                            ->action(function (\Filament\Forms\Get $get, \Filament\Forms\Set $set) {
                                                $menu = \App\Models\Menu::find($get('menu_id'));
                                                $set('quantity', $get('quantity') + 1);
                                                $set('subtotal', $menu->price * $get('quantity'));
                                                $menus = collect($get('../../reservationMenus'))->filter(fn($menu) => is_array($menu) && isset($menu['menu_id']));
                                                self::updateTotals($get, $set, $menus, false);
                                            })
                                    )
                                    ->prefixAction(
                                        \Filament\Forms\Components\Actions\Action::make('subtract')
                                            ->icon('heroicon-o-minus')
                                            ->color('danger')
                                            ->action(function (\Filament\Forms\Get $get, \Filament\Forms\Set $set) {
                                                $menu = \App\Models\Menu::find($get('menu_id'));
                                                $set('quantity', max(1, $get('quantity') - 1));
                                                $set('subtotal', $menu->price * $get('quantity'));
                                                $menus = collect($get('../../reservationMenus'))->filter(fn($menu) => is_array($menu) && isset($menu['menu_id']));
                                                self::updateTotals($get, $set, $menus, false);
                                            })
                                    )
                                    ->required()
                                    ->live(),

                                Forms\Components\TextInput::make('subtotal')
                                    ->label('Subtotal')
                                    ->numeric()
                                    ->readOnly()
                                    ->live()
                            ])
                            ->columns(3)
                            ->addActionLabel('Tambah Menu')
                            ->afterStateUpdated(function (\Filament\Forms\Get $get, \Filament\Forms\Set $set) {
                                $menus = collect($get('reservationMenus'))->filter(fn($menu) => $menu['menu_id'] !== null);
                                self::updateTotals($get, $set, $menus, true);
                            })
                            ->defaultItems(0)
                    ]),
                Forms\Components\Section::make('Informasi Pembayaran')
                    ->description('Informasi terkait pembayaran reservasi.')
                    ->collapsible()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('ticket_price')
                            ->label('Harga Tiket')
                            ->required()
                            ->prefix('Rp.')
                            ->numeric()
                            ->live()
                            ->afterStateUpdated(function (\Filament\Forms\Get $get, \Filament\Forms\Set $set) {
                                $menus = collect($get('../../reservationMenus'))->filter(fn($menu) => is_array($menu) && isset($menu['menu_id']));
                                self::updateTotals($get, $set, $menus, true);
                            })
                            ->dehydrated(false)
                            ->minValue(1)
                            ->placeholder('Harga tiket')
                            ->helperText('Harga tiket otomatis terisi berdasarkan jumlah tamu.')
                            ->readOnly(),
                        Forms\Components\TextInput::make('total_price')
                            ->label('Total Harga')
                            ->required()
                            ->prefix('Rp.')
                            ->numeric()
                            ->live()
                            ->minValue(1)
                            ->helperText('Total harga tiket otomatis terisi berdasarkan jumlah tamu.')
                            ->readOnly()
                    ]),

                Forms\Components\Section::make('Informasi Tiket')
                    ->description('Silakan isi informasi tiket dengan lengkap dan benar.')
                    ->collapsible()
                    ->columns(2)
                    ->schema([
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
                            ->dehydrated(false)
                            ->readOnly(),
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

    public static function updateTotals(\Filament\Forms\Get $get, \Filament\Forms\Set $set, object $menus, bool $isOuterRoot): void
    {
        $prices = \App\Models\Menu::whereIn('id', $menus->pluck('menu_id'))->pluck('price', 'id');

        $menuTotal = $menus->reduce(function ($subtotal, $menu) use ($prices) {
            return $subtotal + ($prices[$menu['menu_id']] * $menu['quantity']);
        }, 0);

        $ticketPrice = $isOuterRoot ? $get('ticket_price') : $get('../../ticket_price');

        $isOuterRoot ? $set('total_price', $menuTotal + $ticketPrice) : $set('../../total_price', $menuTotal + $ticketPrice);
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
                        'warning' => 'pending',
                        'success' => 'confirmed',
                        'danger' => 'canceled',
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
                Tables\Actions\EditAction::make()->color('info'),
                Tables\Actions\Action::make('konfirmasi')
                    ->label('Konfirmasi')
                    ->action(function (Reservation $record) {
                        $record->update(['status' => 'confirmed']);
                        \Filament\Notifications\Notification::make()
                            ->title('Reservasi berhasil dikonfirmasi')
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
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'view' => Pages\ViewReservation::route('/{record}'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }
}
