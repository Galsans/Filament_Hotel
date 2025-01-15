<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomsResource\Pages;
use App\Filament\Resources\RoomsResource\RelationManagers;
use App\Models\Rooms;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\ImageUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoomsResource extends Resource
{
    protected static ?string $model = Rooms::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Select::make('room_type')
                ->options([
                    'suite'=>'Suite',
                    'deluxe'=>'Deluxe',
                    'standard'=>'Standard',
                ])
                ->required()
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set) {
                    $facilities = [
                        'suite' => 'Private pool, King-size bed, Ocean view, Mini bar, Complimentary Breakfast',
                        'deluxe' => 'King-size bed, Garden view, Complimentary Breakfast',
                        'standard' => 'Queen-size bed, Street view',
                    ];

                    $set('facilities', $facilities[$state] ?? '');
                }),

            Textarea::make('facilities')->required(),
            TextInput::make('price_per_night')->required()->integer(),
            TextInput::make('capacity')->required()->integer(),
            Select::make('status')
            ->options([
                'available'=>'Available',
                'occupied'=>'Occupied'
            ]),
            FileUpload::make('image')
            ->label('Upload Image')
            ->disk('public')
            ->imagePreviewHeight('200')
            ->maxSize(1024),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('room_code')
                    ->label('Room Code')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('room_type')
                    ->label('Room Type')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('price_per_night')
                    ->label('Price Per Night')
                    ->money('IDR', true),

                TextColumn::make('facilities')
                    ->label('Facilities')
                    ->wrap()
                    ->limit(50),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'available',
                        'warning' => 'occupied',
                    ]),
                ImageColumn::make('image')
                ->size(40)
                ->label('Image')
                ->disk('public')
                ->url(fn ($record) => asset('storage/' . $record->image))
                ->default('public/storage/images/placeholder.png'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRooms::route('/create'),
            'edit' => Pages\EditRooms::route('/{record}/edit'),
        ];
    }


}
