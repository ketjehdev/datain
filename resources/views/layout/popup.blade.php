<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session()->has('sukses'))
<script>
Swal.fire({
  icon: "success",
  title: "Selamat",
  text: "{{ session('sukses') }}",
  timer: 3000,
  timerProgressBar: true
})
</script>

@elseif (session()->has('info'))
<script>
Swal.fire({
  icon: "info",
  title: "Perhatian",
  text: "{{ session('info') }}",
  timer: 3000,
  timerProgressBar:true,
})
</script>

@elseif (session()->has('warning'))
<script>
Swal.fire({
  icon: "warning",
  title: "Perhatian",
  text: "{{ session('warning') }}",
})
</script>

@elseif (session()->has('gagal'))
<script>
Swal.fire({
  icon: "error",
  title: "Ups...",
  text: "{{ session('gagal') }}",
})
</script>
@endif