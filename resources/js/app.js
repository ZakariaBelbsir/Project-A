require('./bootstrap');

import Vue from 'vue';
import router from './routes.js';
import store from './store/store';
import axios from 'axios';

window.Vue = require('vue');

Vue.component('App', require('./App.vue').default);


const app = new Vue({
    el: '#app',
    router,
    store,
    created() {
        const userString = localStorage.getItem('user')
        if (userString) {
            const userData = JSON.parse(userString);
            this.$store.commit('SET_USER_DATA', userData);
        }
        axios.interceptors.response.use(
            response => response,
            error => {
                if(error.response.status===401){
                    this.$store.dispatch('logout');
                }
                return Promise.reject(error);
            }
        )
    },
});
