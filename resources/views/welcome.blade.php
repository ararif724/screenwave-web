<!DOCTYPE html>
<html lang="en">


 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Screen Wave</title>
    <link rel="shortcut icon" href="{{ asset('vite.svg') }}" type="image/x-icon">
    <script src="{{ asset('assets/js/axios.min.js') }}"></script>

    <!-- Unnacessary Links -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jockey+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    
    @viteReactRefresh
    @vite('resources/js/app.jsx')
    @vite('resources/css/app.css')

    <style>
        #custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            background-color: #ffffff;
            border-radius: 999px;
            border: 1px solid #009e9150;
            padding: 4px !important;
        }

        #custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #009e91;
            width: 4px;
            border-radius: 999px !important;
            cursor: pointer;
        }
    </style> 
</head>

<body>
    <script>
        var baseURL = "{{ url('/') }}";
        var asset = endpoint => baseURL + '/' + endpoint;
        var route = endpoint => baseURL + endpoint;
        var auth = {
            check: @json(Auth::check()),
            user: @json(Auth::user()),
        };

        var Toast = {};

        const api = axios.create({ baseURL });
    </script>
    
    <div id="root"></div> 
</body>

</html>