<?php

namespace App\Livewire;

use App\Models\AssignClassTeacher;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Blade;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\IconColumn;
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;
use Closure;




class ListClientClass extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;



    public function table(Table $table): Table



    {

        return $table
       
            ->striped()
            ->groups([


            ])
             ->query(fn () => AssignClassTeacher::query()->where('registrar_id', Auth::id()))
            ->paginated([5,10, 25, 50, 100])
            ->columns([

                    TextColumn::make('id'),

                    TextColumn::make('registrar.name')
                    ->label('Nama Klien')
                    ->toggleable()
                    ->searchable(isIndividual: true),

                    TextColumn::make('registrar.code')
                    ->label('Kod Klien')
                    ->searchable()
                    ->toggleable(),
                
                    
                    TextColumn::make('teacher.name')
                    ->label('Nama Guru')
                    ->toggleable()
                    ->searchable(isIndividual: true),

                  

                    

                    TextColumn::make('classes.name')
                    ->label('Kelas')
                    ->badge()
                    ->toggleable(),
                   








            ])
            ->filters([
           

            ])
            ->actions([
            
            ])
            ->groupedBulkActions([

                    ExportBulkAction::make()
                    ->label('Eksport'),
                    //Tables\Actions\DeleteBulkAction::make(),
                   


            ]);

           
    }

    public function render(): View
    {
        return view('livewire.list-client-class');
    }


}
