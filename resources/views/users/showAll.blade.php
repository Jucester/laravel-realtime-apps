@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Users </div>

                <div class="card-body">
                        <ul id="users">

                        </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        window.axios.get('/api/users')
                    .then( res => {
                        console.log(res);
                        const usersList = document.getElementById('users');

                        let users = res.data;

                        users.forEach( (user, i) => {
                            let element = document.createElement('li');
                            element.setAttribute('id', user.id);
                            element.innerText = user.name;

                            usersList.appendChild(element);
                        })
                    })
                    .catch( err => {
                        console.log(err);
                    })

    </script>

@endpush
