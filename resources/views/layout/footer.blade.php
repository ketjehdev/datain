<footer class="footer">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-12 text-center">
        {{-- date setup --}}
        @php
          date_default_timezone_set('Asia/Jakarta');
          $time = date('H');
          $date = date('Y', strtotime('now'))
        @endphp

        <div class="copyright text-xl-center text-muted">
          Copyright &copy; {{ $date }}. <strong>Datain</strong>.
        </div>
      </div>
    </div>
</footer>