import Echo from "laravel-echo"

const token = $('meta[name=csrf-token]').attr('content');

const echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001',
    auth: {
        headers: {
            Authorization: "Bearer " + token
        }
    },
});

export {echo};
