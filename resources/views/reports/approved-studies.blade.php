<x-layouts.pdf-layout>
    <style>
        @page {
            size: a4 landscape !important;
        }
    </style>
    <div class="page-landscape">
        <page land>
            <x-layouts.page-header>
                <div class="w-full mx-auto">
                    <x-table class="mb-2 text-center max-w-[250px]">
                        <x-tr>
                            <x-td style="background: #ccc; color: #000000">
                                تاريخ التقرير
                            </x-td>
                            <x-td>{{ now()->format('Y-m-d') }}</x-td>
                        </x-tr>
                    </x-table>
                </div>
            </x-layouts.page-header>

            <x-layouts.report-title class="p-3">
                تقرير بما تم اعتماده بلجان دراسة الأسعار الرئيسية بقطاع (___________) وذلك من (___________) إلى
                (___________)
            </x-layouts.report-title>

            <x-layouts.page-body>
                <x-table class="mb-2 text-xs">


                    <x-tbody>
                        <x-tr>
                            <x-th class="text-center" rowspan="2">#</x-th>
                            <x-th class="text-center" rowspan="2">اسم الشركة</x-th>
                            <x-th class="text-center text-wrap !w-[200px]" rowspan="2">اسم المشروع</x-th>
                            <x-th class="text-center" colspan="3">بيانات أمر الاسناد</x-th>
                            <x-th class="text-center" rowspan="2">سند الدراسة</x-th>
                            <x-th class="text-center" rowspan="2">كود الدراسة</x-th>
                            <x-th class="text-center text-wrap !w-[200px]" rowspan="2">البند</x-th>
                            <x-th class="text-center" rowspan="2">الوحدة</x-th>
                            <x-th class="text-center" rowspan="2">الكمية</x-th>
                            <x-th class="text-center" rowspan="2">الفئة (ج) قبل الاعتماد</x-th>
                            <x-th class="text-center" rowspan="2">الإجمالي (ج) قبل الاعتماد</x-th>
                            <x-th class="text-center" rowspan="2">الفئة (ج) بعد الاعتماد</x-th>
                            <x-th class="text-center" rowspan="2">الإجمالي (ج) بعد الاعتماد</x-th>
                            <x-th class="text-center" rowspan="2">فترة التنفيذ من</x-th>
                            <x-th class="text-center" rowspan="2">فترة التنفيذ إلى</x-th>
                            <x-th class="text-center" rowspan="2">أسلوب إعادة التوازن المالي</x-th>

                        </x-tr>
                        <x-tr>
                            <x-th class="text-center">الرقم</x-th>
                            <x-th class="text-center">التاريخ</x-th>
                            <x-th class="text-center">القيمة</x-th>
                        </x-tr>
                        @php $index = 0; @endphp
                        @forelse($operations as $item)
                            @forelse($item->items as $operationItem)
                                @php $index++; @endphp
                                <x-tr>
                                    <x-td class="p-1 text-center w-[25px]"
                                    >{{ $index }}</x-td>
                                    <x-td class="p-1 text-center"
                                    >{{ $item->project?->company?->name }}</x-td>
                                    <x-td class="p-1 text-center"
                                    >{{ $item->project?->name }}</x-td>
                                    <x-td class="p-1 text-center"
                                    >{{ $item->project?->assignment_no }}</x-td>
                                    <x-td class="p-1 text-center"
                                    >{{ $item->project?->assignment_date }}</x-td>
                                    <x-td class="p-1 text-center"
                                    >{{ $item->project?->assignment_value }}</x-td>
                                    <x-td class="p-1 text-center"
                                    >{{ $item->type?->name }}</x-td>
                                    <x-td class="p-1 text-center">{{ $item->id }}</x-td>

                                    <x-td class="p-1 text-center">{{ $operationItem->name }}</x-td>
                                    <x-td class="p-1 text-center">{{ $operationItem->unit }}</x-td>
                                    <x-td class="p-1 text-center">{{ $operationItem->quantity }}</x-td>
                                    <x-td class="p-1 text-center">{{ $operationItem->price_before }}</x-td>
                                    <x-td class="p-1 text-center">{{ $operationItem->total_before }}</x-td>
                                    <x-td class="p-1 text-center">{{ $operationItem->price_after }}</x-td>
                                    <x-td class="p-1 text-center">{{ $operationItem->total_after }}</x-td>
                                    <x-td class="p-1 text-center">{{ $operationItem->start_date }}</x-td>
                                    <x-td class="p-1 text-center">{{ $operationItem->end_date }}</x-td>
                                    <x-td class="p-1 text-center">{{ $item->balancing_method }}</x-td>
                                </x-tr>
                            @empty
                            @endforelse

                        @empty
                            <x-tr>
                                <x-td colspan="9" class="text-center py-3">لا توجد بيانات</x-td>
                            </x-tr>
                        @endforelse
                    </x-tbody>
                </x-table>
            </x-layouts.page-body>
        </page>
    </div>
</x-layouts.pdf-layout>
