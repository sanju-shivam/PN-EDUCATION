<script type="text/javascript">
        @if(session()->has('success'))
            toastr.success("{{ Session::get('success') }}");   
        @endif
        @if(session()->has('warning'))
            toastr.error("{{ Session::get('warning') }}");   
        @endif
        @if(session()->has('errors'))
        alert(Session::get('errors'));
            // @foreach(Session::get('errors') as $error)

            //    toastr.error($error);   
            // @endforeach
        @endif
</script>