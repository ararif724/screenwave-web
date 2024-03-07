
{{-- <script src="{{ asset('assets/js/jquery-3.7.1.slim.min.js') }}"></script> --}}
<script src="{{ asset('assets/js/sweetalert2.js') }}"></script>

<script>
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

    window.asset = "{{ asset('/') }}" 
    const csrfToken = () => document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const isAuth = @json(Auth::check()); 
    const userName = '{{ Auth::user()->name }}'
    const userEmail = '{{ Auth::user()->email }}'
    const userPicture = '{{ Auth::user()->picture }}'
</script>

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