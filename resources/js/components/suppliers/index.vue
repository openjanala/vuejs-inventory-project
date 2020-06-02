 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/">Dashboard</a>
          </li>
          <li class="breadcrumb-item active"> All Suppliers</li>
        </ol>
       
        <div class="card footer-update">
          <div class="card-header col-md-12 ">
            <i class="fas fa-chart-area"></i>
          All Suppliers
            <router-link to="/add-supplier" class="btn btn-sm btn-info" id="add_new"> Add Supplier</router-link>
          </div>
          <div class="card-body">
 

        <!-- DataTables Example -->
     <div class="table-responsive">
      
                <label >Search</label>
               <input type="text" v-model="searchTerm" class="form-control" style="width:200px; " placeholder="Search phone"><br>

              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                    <tr>
                      <th>Name</th>
                      <th>Photo</th>
                       <th>Phone</th>
                      <th>Email</th>
                      <th>Shop Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                <tbody>
                  <tr v-for="supplier in Filtersearch" :key="supplier.id">
                    <td>{{supplier.name}}</td>
                    <td><img :src=" supplier.photo" id="img_photo" /></td>
                    <td>{{supplier.name}}</td>
                    <td>{{supplier.email}}</td>
                    <td>{{supplier.shopname}}</td>
                    <td>
                        <router-link :to="{name:'edit-supplier', params:{id:supplier.id} }" class="btn btn-sm btn-info">Edit</router-link>
                        <a @click="deleteSupplier(supplier.id)"  class="btn btn-sm btn-danger">Delete</a>
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
        this.allSupplier();
    }, 
    data(){
       return{
           suppliers:[],
           searchTerm:''
       }
    },
    computed:{
        Filtersearch(){
      return this.suppliers.filter( supplier=>{
            return supplier.phone.match(this.searchTerm)
            return supplier.name.match(this.searchTerm)  
      })
      }
    },
    methods:{
        allSupplier(){
            axios.get('/api/suppliers/')
            .then(({data})=>(this.suppliers = data))
            .catch()
        },
    
    deleteSupplier(id){
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
            axios.delete('/api/suppliers/'+id)
            .then(()=>{
                this.suppliers = this.suppliers.filter(supplier =>{
                    return supplier.id !=id
                    
                })
            })
            .catch( ()=>{
                this.$router.push({name:'suppliers'})
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