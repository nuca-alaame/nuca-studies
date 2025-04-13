<html dir="rtl">
<head>
    <meta http-equiv="content-type" content="text/html;  charset=utf-8"/>
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">
    <title>هيئة المجتمعات العمرانية</title>
    @vite(['resources/js/pdf-styles.ts'])
    <style>

        *, body {
            color: #000000;
            font-weight: bold;
        }

        table.table {
            width: 100%;
            border: #000000 1px solid !important;
            text-align: center;
            margin-bottom: 0.35rem;
        }

        table.table td, .td {
            border: #000000 1px solid !important;
            vertical-align: middle;
        }

        table.table th, .th {
            border: #000000 1px solid !important;
            background-color: #cccccc;
            color: #000000;
        }

        table.table thead, .thead {
            background-color: #cccccc;
            color: #000000;
            border: #000000 1px solid !important;
        }

        table.table tr, .tr {
            border: #000000 1px solid !important;
            page-break-inside: avoid;
        }

        .title {
            background-color: #cccccc;
            color: #000000;
        }

        .heading {
            background-color: #cccccc;
            color: #000000;
        }

    </style>
</head>

<body>

{{$slot}}

</body>

</html>
