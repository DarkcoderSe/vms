<!-- jQuery -->
<script src="{{URL::to('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{URL::to('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
    

//   $.widget.bridge('uibutton', $.ui.button);
  $(document).ready(function(){

    @if(!is_null($errors))
    @foreach($errors->all() as $error)
    toastr.error(`{{ $error }}`, 'Validation Error!');
    @endforeach
    @endif

    `<?php 
      if(session('error')){
        echo "toastr.error('" . session('message') . "')";
      }else if(session('info')){
        echo "toastr.info('" . session('message') . "')"; 
      }else if(session('warning')){
        echo "toastr.warning('" . session('message') . "')";  
      }else if(session('success')){
        echo "toastr.success('" . session('message') . "')";
      }
    ?>`

  });
</script>
<script src="{{URL::to('dist/js/adminlte.js')}}"></script>
<script src="{{URL::to('dist/js/demo.js')}}"></script>
@stack('script')
<script>
    function makeASale() {
        $('#makeASale').modal('show');
    }

    function unknown() {
        $('#customerName').val('Unknown');
        $('#phoneNo').val('03123456789');

    }
</script>