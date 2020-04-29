/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('../../../../../resources/js/bootstrap');
window.Vue = require('vue');
import Echo from "laravel-echo"
window.io = require('socket.io-client');


window.echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':60001',
});

Vue.component('chat-app', require('./components/ChatApp.vue').default);

const app = new Vue({
    el: '#app',
});
