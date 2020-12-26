<script type="text/javascript">
        @if(session()->has('success'))
            toastr.success("{{ Session::get('success') }}");   
        @endif
        @if(session()->has('warning'))
            toastr.error("{{ Session::get('warning') }}");   
        @endif
       


        // @if(count($errors) >0)
        //     @foreach($errors as $error)
        //         toastr.error("{{ ('error') }}");

        //     @endforeach
        // @endif
</script>