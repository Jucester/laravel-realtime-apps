@extends('layouts.app')

@push('styles')
    <style>
            #users > li {
                cursor: pointer;
            }
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
                                    <ul id="messages" class="list-unstyled overflow-auto" style="height: 45vh">
                                      
                                    </ul>
                                </div>
                            </div>
                            <form>
                                <div class="row py-3">
                                    <div class="col-10">
                                        <input id="message" type="text" class="form-control">
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
        const usersList = document.getElementById('users');
        const messagesBox = document.getElementById('messages');

     
        Echo.join('chat')
            .here( (users) => {
            

                users.forEach( (user, i) => {
                            console.log(user)
                            let element = document.createElement('li');

                            element.setAttribute('id', user.id);

                            element.setAttribute('onclick', 'greetUser("' + user.id +'")');
                            
                            element.innerText = user[1];

                            usersList.appendChild(element);
                        })
            })
            .joining( (user) => {
                let element = document.createElement('li');

                element.setAttribute('id', user.id);
                element.innerText = user[1];

                usersList.appendChild(element);
            })
            .leaving( (user) => {
                let element = document.getElementById(user.id);
                element.parentNode.removeChild(element);
            })
            .listen('MessageSend', (e) => {

                let element = document.createElement('li');

                element.setAttribute('id', e.user.id);
                element.innerText = `${e.user.name} : ${e.message}`;

                messagesBox.appendChild(element);
            });
            
    </script>

    <script>
        const send = document.getElementById('send');
        const message = document.getElementById('message');

        send.addEventListener('click', (e) => {
            const message = document.getElementById('message');
            e.preventDefault();
            console.log(message);

            window.axios.post('/chat/message', {
                message: message.value
            });

            message.value = "";

        });

    </script>

    <script>
        const greetUser = (id) => {
            console.log(id);
            window.axios.post(`/chat/greet/${id}`);

        }
    </script>

    <script>
        Echo.private(`chat.greet.{{ auth()->user()->id }}`)
            .listen('GreetingSend', (e) => {

                let element = document.createElement('li');

               
                element.innerText = `${e.message}`;
                element.classList.add('text-success');

                messagesBox.appendChild(element);

            });
    </script>
   
@endpush
