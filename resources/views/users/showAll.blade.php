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

    <script>
        Echo.channel('users')
            .listen('UserCreated', (e) => {
                const usersList = document.getElementById('users');
                let element = document.createElement('li');

                element.setAttribute('id', e.user.id);
                element.innerText = e.user.name;

                usersList.appendChild(element);
             
            })
            .listen('UserUpdated', (e) => {
            
                let user = document.getElementById(e.user.id);
                user.innerText = e.user.name;

            })
            .listen('UserDeleted', (e) => {
                let user = document.getElementById(e.user.id);
                user.parentNode.removeChild(user);
             
            })
    </script>

@endpush
