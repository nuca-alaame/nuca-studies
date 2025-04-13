<?php

use App\Models\Operation;
use App\Models\Project;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
    $operations = Operation::query()
        ->with(['project', 'project.company'])
//        ->whereIn('project_id', Project::query()
//            ->when(isset($data['company_id']), fn ($q) => $q->where('company_id', $data['company_id']))
//            ->when(isset($data['sector_id']), fn ($q) => $q->where('sector_id', $data['sector_id']))
//            ->when(isset($data['city_id']), fn ($q) => $q->where('city_id', $data['city_id']))
//            ->pluck('id'))
//                ->whereBetween('approval_date', [$data['start_date'], $data['end_date']])
        ->get();

    return view('reports.approved-studies', ['data' => [], 'operations' => $operations]);
});
