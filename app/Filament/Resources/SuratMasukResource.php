<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuratMasukResource\Pages;
use App\Filament\Resources\SuratMasukResource\RelationManagers;
use App\Models\SuratMasuk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuratMasukResource extends Resource
{
    protected static ?string $model = SuratMasuk::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        //
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggal_surat_masuk')
                ->displayFormat('d-m-Y')
                ->required(),
                Forms\Components\Select::make('kategori_surat')
                ->required()
                    ->options([
                        'Pengajuan Surat Izin Kegiatan' => 'Pengajuan Surat Izin Kegiatan',
                        'Pengajuan Proposal Dana' => 'Pengajuan Proposal Dana',
                    ]),
                Forms\Components\TextInput::make('tahun')
                ->required(),
                Forms\Components\TextInput::make('nomor_surat')
                ->required(),
                Forms\Components\TextInput::make('nama_kegiatan')
                ->required(),
                Forms\Components\Select::make('pengguna_id')
                ->relationship('pengguna', 'nama_ormawa')
                ->searchable()
                ->preload()
                ->required(),
                Forms\Components\Radio::make('status')
                ->label('Surat Disetujui')
                ->boolean(),
                Forms\Components\FileUpload::make('dokumentasi')
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                ->required(),
                Forms\Components\FileUpload::make('file_surat')
                ->acceptedFileTypes(['application/pdf'])
                ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggal_surat_masuk'),
                Tables\Columns\TextColumn::make('kategori_surat')
                ->searchable(),
                Tables\Columns\TextColumn::make('tahun'),
                Tables\Columns\TextColumn::make('nomor_surat'),
                Tables\Columns\TextColumn::make('nama_kegiatan'),
                Tables\Columns\TextColumn::make('pengguna.nama_ormawa'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('dokumentasi'),
                Tables\Columns\TextColumn::make('file_surat'),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListSuratMasuks::route('/'),
            'create' => Pages\CreateSuratMasuk::route('/create'),
            'edit' => Pages\EditSuratMasuk::route('/{record}/edit'),
        ];
    }
}
