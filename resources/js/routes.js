let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forgot = require('./components/auth/forgot.vue').default;
let logout = require('./components/auth/logout.vue').default;

// end Authenticates
let home = require('./components/home.vue').default;

// for Employee
let addemployee = require('./components/employees/create.vue').default;
let employees = require('./components/employees/index.vue').default;
let editemployee = require('./components/employees/edit.vue').default;

 //for suppliers
 let addsupplier = require('./components/suppliers/create.vue').default;
 let suppliers = require('./components/suppliers/index.vue').default;
 let editsupplier = require('./components/suppliers/edit.vue').default;

 //for Categories
 let addcategory = require('./components/categories/create.vue').default;
 let categories = require('./components/categories/index.vue').default;
 let editcategory = require('./components/categories/edit.vue').default;

  //for Products
  let addproduct = require('./components/products/create.vue').default;
  let products = require('./components/products/index.vue').default;
  let editproduct = require('./components/products/edit.vue').default;
 


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
    { path: '/employees', component: employees, name:'employees'},
    { path: '/edit-employee/:id', component: editemployee, name:'edit-employee'},

    //for suppliers
    { path: '/add-supplier', component: addsupplier, name:'add-supplier'},
    { path: '/suppliers', component: suppliers, name:'suppliers'},
    { path: '/edit-supplier/:id', component: editsupplier, name:'edit-supplier'},
   
//for Categories
    { path: '/add-category', component: addcategory, name:'add-category'},
    { path: '/categories', component: categories, name:'categories'},
    { path: '/edit-category/:id', component: editcategory, name:'edit-category'},
  
  //for Products
  { path: '/add-product', component: addproduct, name:'add-product'},
  { path: '/products', component: products, name:'products'},
  { path: '/edit-product/:id', component: editproduct, name:'edit-product'},

    
]