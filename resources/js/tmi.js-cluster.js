import axios from 'axios';
import Vue from 'vue';
import App from './App.vue';

axios.defaults.baseURL = window.location.href;

new Vue({
	el: '#app',
	render: h => h(App),
});