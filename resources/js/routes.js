let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;

///end authentication------

export const routes = [
    { path: '/', component: login,  name:'/'},
    { path: '/register', component: register, name:'/register'}
    
]