window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });

import axios from 'axios'
import OAuth  from 'oauth-1.0a'
import crypto from 'crypto'

const ck = '[MY_CLIENT_KEY]'
const cs = '[MY_SECRET_KEY]'
const url = '[MY_URL]/wp-json/wc/v2/products'

const oauth = OAuth({
    consumer: {
        key: ck,
        secret: cs
    },
    signature_method: 'HMAC-SHA1',
    hash_function: function(base_string, key) {
        return crypto.createHmac('sha1', key).update(base_string).digest('base64')
    }
})

const token = {
    key: ck,
    secret: cs
}

var request_data = {
    method: 'GET',
    url: url
}

var params = oauth.authorize(request_data, token)
console.log(params)

axios.get(url + '/?oauth_signature=' + params.oauth_signature +
    '&oauth_consumer_key=' + ck +
    '&oauth_nonce=' + params.oauth_nonce +
    '&oauth_signature_method=HMAC-SHA1&oauth_timestamp=' + params.oauth_timestamp +
    '&oauth_token=' + params.oauth_token +
    '&oauth_version=1.0')
    .then(function(data){
        console.log(data)
    }, function(error){
        console.log(error)
    })
