require('./bootstrap');

import Vue from 'vue'
import IndexPage from './pages/IndexPage'
import TweetPage from './pages/TweetPage'
import ContentPage from './pages/ContentPage'
import store from './store';

Vue.component('content-page', ContentPage);
Vue.component('tweet-page', TweetPage);
Vue.component('index-page', IndexPage);

const app = new Vue({
    el: '#app',
    store
});