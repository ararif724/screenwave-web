
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

    window.asset = (src) => "{{ asset('/') }}" + src; 
    window.route = (endpoint) => "{{ route('frontend.home') }}" + endpoint; 

    const isAuth = @json(Auth::check()); 
    const userName = '{{ Auth::check() ? Auth::user()->name : '' }}'
    const userEmail = '{{ Auth::check() ? Auth::user()->email : '' }}'
    const userPicture = '{{ Auth::check() ? Auth::user()->picture : '' }}'
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