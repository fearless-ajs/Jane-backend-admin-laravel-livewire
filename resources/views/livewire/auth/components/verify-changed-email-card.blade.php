<div>
    @if($loading)
            <p class="card-text mb-2 text-center">Verifying your email </p>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
     @endif
   @if($failed)
            <p class="text-center" style="color: red;">{{$failed}}</p>
   @endif

    @if($success)
        <h2 class="brand-text text-primary ms-1 mb-0 text-center">Email verified!</h2>
        <a href="{{route('sign-in')}}" class="btn btn-primary w-100 mt-2">Proceed to sign-in</a>
    @endif
</div>
