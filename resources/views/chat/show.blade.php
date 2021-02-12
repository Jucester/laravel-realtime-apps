@extends('layouts.app')

@push('styles')
    <style>
   
    </style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Chat </div>

                <div class="card-body">
                    <div class="row p-2">
                        <div class="col-10">
                            <div class="row">
                                
                                <div class="col-12 border rounded-lg p-3">
                                    <ul id="message" class="list-unstyled overflow-auto" style="height: 45vh">
                                        <li> Andros: Hi </li>
                                        <li> Doriangelo: Hi </li>
                                    </ul>
                                </div>
                            </div>
                            <form action="">
                                <div class="row py-3">
                                    <div class="col-10">
                                        <input type="text" id="message" class="form-control">
                                    </div>
                                    <div class="col-2">
                                        <button id="send" type="submit" class="btn btn-primary btn-block"> Send </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-2">
                            <p> <strong> Online now: </strong></p>

                            <ul 
                                id="users" 
                                class="list-unstyled overflow-auto text-info" 
                                style="height: 45vh;"
                            >
                                <li> Andros </li>
                                <li> Ryan </li>
                            </ul>
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

    <script>

          
            
    </script>
   
@endpush
