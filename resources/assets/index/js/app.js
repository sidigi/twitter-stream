require('./bootstrap');

import Vue from 'vue'
import IndexPage from './pages/IndexPage'
import TweetPage from './pages/TweetPage'
import ImagePage from './pages/ImagesPage'
import store from './store';

Vue.component('image-page', ImagePage);
Vue.component('tweet-page', TweetPage);
Vue.component('index-page', IndexPage);

const app = new Vue({
    el: '#app',
    store,
});