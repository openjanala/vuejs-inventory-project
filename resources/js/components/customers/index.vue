 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/">Dashboard</a>
          </li>
          <li class="breadcrumb-item active"> All Customers</li>
        </ol>
       
        <div class="card footer-update">
          <div class="card-header col-md-12 ">
            <i class="fas fa-chart-area"></i>
          All Customers
            <router-link to="/add-customer" class="btn btn-sm btn-info" id="add_new"> Add Customer</router-link>
          </div>
          <div class="card-body">
 

        <!-- DataTables Example -->
     <div class="table-responsive">
      
                <label >Search</label>
               <input type="text" v-model="searchTerm" class="form-control" style="width:200px; " placeholder="Search phone or name"><br>

              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Photo</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                <tbody>
                  <tr v-for="customer in Filtersearch" :key="customer.id">
                    <td>{{customer.name}}</td>
                     <td>{{customer.email}}</td>
                     <td>{{customer.phone}}</td>
                      <td>{{customer.address}}</td>
                    <td><img :src=" customer.photo" id="img_photo" /></td>
                    <td>
                        <router-link :to="{name:'edit-customer', params:{id:customer.id} }" class="btn btn-sm btn-info">Edit</router-link>
                        <a @click="deleteCustomer(customer.id)"  class="btn btn-sm btn-danger">Delete</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>





          </div>
        <div class="card-footer col-md-12 ">
             <div class="small update">Updated yesterday at 11:59 PM</div>
        </div>
       </div>
   </div>
</template>

<script>
    export default {
    	mounted(){
            if (!User.loggedIn()) {
               this.$router.push({ name:'/' })
            } 
        },
        created(){
        this.allCustomers();
    }, 
    data(){
       return{
           customers:[],
           searchTerm:''
       }
    },
    computed:{
        Filtersearch(){
      return this.customers.filter( customer=>{
            return customer.phone.match(this.searchTerm)
            return customer.name.match(this.searchTerm)  
      })
      }
    },
    methods:{
        allCustomers(){
            axios.get('/api/customers/')
            .then(({data})=>(this.customers = data))
            .catch()
        },
    
    deleteCustomer(id){
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete It!'
        }).then((result) => {
        if (result.value) {
            axios.delete('/api/customers/'+id)
            .then(()=>{
                this.customers = this.customers.filter(customer =>{
                    return customer.id !=id
                    
                })
            })
            .catch( ()=>{
                this.$router.push({name:'customers'})
            })

            Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
    )
  }
})
    }
},
  
    }




</script>

<style>
	
#add_new{
	float: right;
}
.footer-update{
margin-bottom: 10px;
}
#img_photo{
    width: 60px;
    height: 40px;
}
</style>