
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');
require('./hammer.min')

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');
require('vue-resource');

const moment = require('moment')
require('moment/locale/en-au')
import Paginate from './mixins/Paginate.vue'

Vue.use(require('vue-moment'), { moment })
Vue.component('Paginate', Paginate)

//global storage
import _env from '../../../env.js'
import Tools from './Core/Tools.js'
Vue.use(require('vue-env'), _env)
Vue.use(Tools)


var imagesLoaded = require('imagesloaded')

imagesLoaded.makeJQueryPlugin( $ );

var jQueryBridget = require('jquery-bridget')
var Masonry = require('masonry-layout')

jQueryBridget( 'masonry', Masonry, $ )
/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });