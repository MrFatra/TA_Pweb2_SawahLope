<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Facades\FilamentAsset;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function getModelLabel(): string
    {
        return 'Artikel';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Judul')
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (callable $set, $state) {
                        $set('slug', \Illuminate\Support\Str::slug($state));
                    })
                    ->required(),
                TextInput::make('slug')
                    ->readOnly()
                    ->helperText('Slug akan terisi otomatis jika Anda telah selesai mengedit form "Judul".')
                    ->required()
                    ->maxLength(255)
                    ->unique(Article::class, 'slug', ignoreRecord: true),
                TextInput::make('category')
                    ->label('Kategori')
                    ->required(),
                TinyEditor::make('description')
                    ->required()
                    ->label('Deskripsi')
                    ->columnSpanFull()
                    ->minHeight(300)
                    ->fileAttachmentsDisk('local')
                    ->fileAttachmentsVisibility('public')
                    ->fileAttachmentsDirectory('articles'),
                Select::make('created_by')
                    ->label('Dibuat oleh')
                    ->required()
                    ->relationship('user', 'name')
                    ->default(fn() => Auth::user()->id)
                    ->preload()
                    ->searchable(),
                FileUpload::make('image')
                    ->label('Gambar')
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
                    ->helperText('Unggah gambar artikel dengan format JPG, JPEG, PNG, atau GIF.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(20)
                    ->tooltip(fn($record) => $record->title)
                    ->sortable(),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'view' => Pages\ViewArticle::route('/{record}'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
