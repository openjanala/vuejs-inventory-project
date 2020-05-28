let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forgot = require('./components/auth/forgot.vue').default;
let logout = require('./components/auth/logout.vue').default;

//end Authenticates
let home = require('./components/home.vue').default;

//for Employee
let employee = require('./components/employee/create.vue').default;




///end authentication------

export const routes = [
    { path: '/', component: login,  name:'/'},
    { path: '/register', component: register, name:'register'},
    { path: '/forgot', component: forgot, name:'forgot'},
    { path: '/logout', component: logout, name:'logout'},

///end authentication------
    { path: '/home', component: home, name:'home'},

//for Employee
    { path: '/add-employee', component: employee, name:'add-employee'},





    
]