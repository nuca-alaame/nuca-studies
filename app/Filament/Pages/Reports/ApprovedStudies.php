<?php

namespace App\Filament\Pages\Reports;

use App\DataProcessors\Files\PdfDataProcessor;
use App\Models\City;
use App\Models\Company;
use App\Models\Operation;
use App\Models\Project;
use App\Models\Sector;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ApprovedStudies extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?int $navigationSort = 100;

    protected static ?string $navigationGroup = 'التقارير';

    protected ?string $heading = 'تقرير لجان دراسة الاسعار المعتمدة';

    protected static ?string $navigationLabel = 'تقرير لجان دراسة الاسعار المعتمدة';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.reports.approved-studies';

    public ?Carbon $start_date;

    public ?Carbon $end_date;

    public ?int $company_id;

    public ?int $sector_id;

    public ?int $city_id;

    protected string $pdfView = 'reports.approved-studies';

    protected function getFormSchema(): array
    {
        return [
            DatePicker::make('start_date')
                ->required()
                ->label('تاريخ اعتماد الدراسة من'),
            DatePicker::make('end_date')
                ->required()
                ->label('تاريخ اعتماد الدراسة إلى'),
            Select::make('company_id')
                ->label('اسم الشركة')
                ->options(Company::query()->pluck('name', 'id'))
                ->searchable(),
            Select::make('sector_id')
                ->label('اسم القطاع')
                ->options(Sector::query()->pluck('name', 'id'))
                ->searchable(),
            Select::make('city_id')
                ->label('اسم المدينة')
                ->options(City::query()->pluck('name', 'id'))
                ->searchable(),
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'حقل مطلوب',
        ];
    }

    public function submit()
    {
        $data = $this->form->getState();

        try {
            $operations = Operation::query()
                ->with(['project', 'project.company', 'type', 'items'])
                ->whereIn('project_id', Project::query()
                    ->when(isset($data['company_id']), fn ($q) => $q->where('company_id', $data['company_id']))
                    ->when(isset($data['sector_id']), fn ($q) => $q->where('sector_id', $data['sector_id']))
                    ->when(isset($data['city_id']), fn ($q) => $q->where('city_id', $data['city_id']))
                    ->pluck('id'))
                ->whereBetween('approval_date', [$data['start_date'], $data['end_date']])
                ->get();

            if ($operations->isEmpty()) {
                Notification::make('error')
                    ->title('لا يوجد نتائج للبحث')
                    ->send();

                return;
            }

            $filePath = PdfDataProcessor::generate(view: $this->pdfView, data: ['data' => $data, 'operations' => $operations]);

            return redirect($filePath);
        } catch (\Throwable $throwable) {
            errorLog($throwable);
            Notification::make('error')
                ->title($throwable->getMessage())
                ->send();
        }

    }

    protected function getFormActions(): array
    {
        return [
            \Filament\Forms\Components\Actions\Action::make('submit')
                ->label('Submit')
                ->submit('submit'),
        ];
    }
}
