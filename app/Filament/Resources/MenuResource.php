<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Filament\Resources\MenuResource\RelationManagers;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return 'Menu';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Menu')
                    ->required()
                    ->live(onBlur: true)
                    ->maxLength(255)
                    ->unique(Menu::class, 'name', ignoreRecord: true)
                    ->afterStateUpdated(function (callable $set, $state) {
                        $set('slug', \Illuminate\Support\Str::slug($state));
                    }),
                Forms\Components\TextInput::make('slug')
                    ->disabled()
                    ->helperText('Slug akan terisi otomatis jika telah selesai mengedit form "Nama Menu".')
                    ->required()
                    ->maxLength(255)
                    ->unique(Menu::class, 'slug', ignoreRecord: true),
                Forms\Components\Select::make('food_category_id')
                    ->label('Kategori Menu')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->placeholder('Pilih kategori menu'),
                Forms\Components\TextInput::make('price')
                    ->label('Harga')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->prefix('Rp')
                    ->placeholder('Masukkan harga menu'),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi Menu')
                    ->rows(5),
                Forms\Components\FileUpload::make('image')
                    ->label('Gambar Menu')
                    ->image()
                    ->openable()
                    ->downloadable()
                    ->reorderable()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->preserveFilenames()
                    ->required()
                    ->maxFiles(1)
                    ->acceptedFileTypes(['image/*'])
                    ->helperText('Unggah gambar menu dengan format JPG, JPEG, PNG, atau GIF.'),
                Forms\Components\Toggle::make('is_available')
                    ->label('Apakah menu ini tersedia?')
                    ->helperText('Tandai jika menu ini tersedia untuk dipesan.')
                    ->default(false)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Menu')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori Menu')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR', true)
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_available')
                    ->boolean()
                    ->label('Tersedia?')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'view' => Pages\ViewMenu::route('/{record}'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
