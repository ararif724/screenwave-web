
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <link rel="icon" type="image/svg+xml" href="{{ asset('/vite.svg') }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Screen Wave || Home</title>

        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Jockey+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet"
        />
        <link
            href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap"
            rel="stylesheet"
        />
        <link
            href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap"
            rel="stylesheet"
        />

        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script> 

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

        <script>
            window.asset = (src) => "{{ asset('/') }}" + src; 
            window.route = (endpoint) => "{{ route('frontend.home') }}" + endpoint; 

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
        </script>
                
        @viteReactRefresh
        @vite(['resources/css/app.css', 'resources/js/app.jsx'])
        @inertiaHead

        @if (session('error'))
            <script>
                Toast.fire({ icon: 'error', text: "{{ session('error') }}"  })
            </script>
        @endif
        @if (session('success'))
            <script>
                Toast.fire({ icon: 'success', text: "{{ session('success') }}"  })
            </script>
        @endif
    </head>
    <body>
        @inertia 
  </body>
</html>
