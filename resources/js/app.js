const { default: Echo } = require('laravel-echo');

require('./bootstrap');

Echo.channel('notifications')
    .listen('UserSessionChanged', () => {
        console.log(e.message);
        console.log(e.type);

        const notificationElement = document.querySelector('#notification');

        notificationElement.innerText = e.message;

        notificationElement.classList.remove('invisible');
        notificationElement.classList.remove('alert-success');
        notificationElement.classList.remove('alert-danger');


        notificationElement.classList.add('alert-' + e.type);
    })