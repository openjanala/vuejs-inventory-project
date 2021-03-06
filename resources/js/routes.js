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
 
//for Expeses
  let addexpense = require('./components/expenses/create.vue').default;
  let allexpense = require('./components/expenses/index.vue').default;
  let editexpense = require('./components/expenses/edit.vue').default;

//for Salary
let givensalary = require('./components/salary/all_employee.vue').default;
let paysalary = require('./components/salary/create.vue').default;
let allsalary = require('./components/salary/index.vue').default;
let viewsalary = require('./components/salary/view.vue').default;
let editsalary = require('./components/salary/edit.vue').default;

//stock
let stock = require('./components/products/stock.vue').default;
let editstock = require('./components/products/edit_stock.vue').default;

//for Customers
  let addcustomer = require('./components/customers/create.vue').default;
  let allcustomer = require('./components/customers/index.vue').default;
  let editcustomer = require('./components/customers/edit.vue').default;


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

  
//for Expense
 { path: '/add-expense', component: addexpense, name:'add-expense'},
 { path: '/expenses', component: allexpense, name:'expenses'},
 { path: '/edit-expense/:id', component: editexpense, name:'edit-expense'},

//for Salary
{ path: '/given-salary', component: givensalary, name:'given-salary'},
{ path: '/pay-salary/:id', component: paysalary, name:'pay-salary'},
{ path: '/salary', component: allsalary, name:'salary'},
{ path: '/view-salary/:id', component: viewsalary, name:'view-salary'},
{ path: '/edit-salary/:id', component: editsalary, name:'edit-salary'},

//stock
{ path: '/stock', component: stock, name:'stock'},
{ path: '/edit-stock', component: editstock, name:'edit-stock'},

//for Customer
{ path: '/add-customer', component: addcustomer, name:'add-customer'},
{ path: '/customers', component: allcustomer, name:'customers'},
{ path: '/edit-customer/:id', component: editcustomer, name:'edit-customer'},


]