<link href="{{ url('/') }}/public/css/sweetalert2.min.css" rel="stylesheet">
<script src="{{ url('/') }}/public/js/sweetalert2.min.js"></script>
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
    const Actions = Swal.mixin({
        toast: true,
        position: "bottom",
        showConfirmButton: false,
        timer: 1000,
    });
    @if (Session::has('success'))
        Toast.fire({
            icon: "success",
            title: "{{ session('success') }}"
        });
    @endif
    @if (Session::has('error'))
        Toast.fire({
            icon: "error",
            title: "{{ session('error') }}"
        });
    @endif
    @if ($errors->any())
        Toast.fire({
            icon: "error",
            title: "{{ $errors->first() }}"
        });
    @endif
</script>
