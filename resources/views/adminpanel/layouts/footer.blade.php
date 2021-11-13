<footer class="footer text-center">&copy; {{ date('Y') . ' ' . config('app.name') }}</footer>
</div>
</div>
<script src="{{ asset('admin/js/tether.min.js') }}"></script>
<script src="{{ asset('admin/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap-extension.min.js') }}"></script>
<script src="{{ asset('admin/js/sidebar-nav.min.js') }}"></script>
<script src="{{ asset('admin/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('admin/js/waves.js') }}"></script>
<script src="{{ asset('admin/js/custom.min.js') }}"></script>
<script src="{{ asset('admin/js/jQuery.style.switcher.js') }}"></script>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@yield('script')
</body>
</html>
