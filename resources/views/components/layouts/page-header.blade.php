<div class="w-full flex items-center justify-center text-center p-2 mt-3">
    <div class="w-2/6 text-center">
        <div style="color: #000000; font-size: 14px !important;">وزارة الاسكان والمرافق والمجتمعات العمرانية</div>
        <div style="color: #000000; font-size: 14px !important;">هيئة المجتمعات العمرانية</div>
    </div>
    <div class="flex-grow text-center mx-auto">
        <img src="{{ asset('img/logo.png') }}"
             style="max-height: 70px" alt="هيئة المجتمعات العمرانية" class="mx-auto">
    </div>
    <div class="w-2/6 text-center text-sm flex items-center justify-center">
        <div class="flex-grow max-w-[300px]">
            {{$slot}}
        </div>
    </div>
</div>


