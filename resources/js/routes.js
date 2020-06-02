let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forgot = require('./components/auth/forgot.vue').default;
let logout = require('./components/auth/logout.vue').default;

// end Authenticates
let home = require('./components/home.vue').default;

// for Employee
let employees = require('./components/employees/index.vue').default;
let addemployee = require('./components/employees/create.vue').default;
let editemployee = require('./components/employees/edit.vue').default;

 //for suppliers
 let suppliers = require('./components/suppliers/index.vue').default;
 let addsupplier = require('./components/suppliers/create.vue').default;
 let editsupplier = require('./components/suppliers/edit.vue').default;


// end authentication------

export const routes = [
    { path: '/', component: login,  name:'/'},
    { path: '/register', component: register, name:'register'},
    { path: '/forgot', component: forgot, name:'forgot'},
    { path: '/logout', component: logout, name:'logout'},

// end authentication------
    { path: '/home', component: home, name:'home'},

// for Employee
    { path: '/add-employee', component: addemployee, name:'add-employee'},
    { path: '/edit-employee/:id', component: editemployee, name:'edit-employee'},
    { path: '/employees', component: employees, name:'employees'},

    //for suppliers
    { path: '/add-supplier', component: addsupplier, name:'add-supplier'},
    { path: '/edit-supplier/:id', component: editsupplier, name:'edit-supplier'},
    { path: '/suppliers', component: suppliers, name:'suppliers'},





    
]