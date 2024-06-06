@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="w-75">
                        <h4>Redirigiendo a Webpay...</h4>
                    </div>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ $url }}">
                        @csrf
                        <input type="hidden" name="token_ws" value="{{ $token }}">
                        <input type="submit" value="Haga clic aquí si no es redirigido automáticamente" class="btn btn-primary">
                    </form>
                    <script type="text/javascript">
                        document.forms[0].submit();
                    </script>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
