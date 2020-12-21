<script type="text/javascript">
        @if(session()->has('success'))
            toastr.success("{{ Session::get('success') }}");   
        @endif
        @if(session()->has('warning'))
            toastr.error("{{ Session::get('warning') }}");   
        @endif
</script>