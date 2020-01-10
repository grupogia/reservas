window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$      = window.jQuery = require('jquery');
    window.swal   = require('sweetalert2');

    require('bootstrap');
    require('../bower_components/submodaljs/dist/bs.sm')
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/** Acciones predeterminadas de axios
 *
 * Se difine el comportamiento global de las peticiones HTTP.
 * Definiendo interceptores.
 */

const onSuccess = (response) => {
    return response
}

const onError = (fail) => {
    var message = 'Datos incorrectos'                
    let status  = fail.response.status

    if (status === 401 || status === 403) message = 'Acceso no autorizado'
    if (status === 404) message = '404 - El recurso no existe'
    if (status === 419) message = 'La página ha expirado, favor de recargar'

    if (message != 'Datos incorrectos') swal.fire({ type: 'error', title: message })
    return Promise.reject(fail)
}

window.axios.interceptors.response.use(onSuccess, onError)

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
