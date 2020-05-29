
require('./bootstrap');

//window.Vue = require('vue');
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

//Routers Import
import {routes} from './routes';

//import User Class 
import User from './Helpers/User';
window.User = User

//import user class
import Notification from './Helpers/Notification';
window.Notification = Notification

// Sweet Alert Start
import Swal from 'sweetalert2'
// const Swal = require('sweetalert2')
window.Swal = Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});

window.Toast = Toast;
 // Sweet Alert End

 window.Reload = new Vue();

const router = new VueRouter({
    routes,
    mode:'history'
  })

const app = new Vue({
    el: '#app',
    router
});
