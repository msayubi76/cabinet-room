@if(Session::has('success'))

    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <i class="mdi mdi-check-circle mr-2"></i>{{ Session::get('success') }}
    </div>

@endif
@if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <i class="mdi mdi-close-circle mr-2"></i>{{ Session::get('error') }}
    </div>
@endif
