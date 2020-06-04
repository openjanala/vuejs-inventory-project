 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/">Dashboard</a>
          </li>
          <li class="breadcrumb-item active"> All Products</li>
        </ol>
       
        <div class="card footer-update">
          <div class="card-header col-md-12 ">
            <i class="fas fa-chart-area"></i>
          All Products
            <router-link to="/add-product" class="btn btn-sm btn-info" id="add_new"> Add Product</router-link>
          </div>
          <div class="card-body">
 

        <!-- DataTables Example -->
     <div class="table-responsive">
      
                <label >Search</label>
               <input type="text" v-model="searchTerm" class="form-control" style="width:250px; " placeholder="Search Product Name"><br>

              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                    <tr>
                      <th>Name</th>
                      <th>Photo</th>
                       <th>Phone</th>
                      <th>Email</th>
                      <th>Address</th>
                      <th>Shop Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                <tbody>
                  <tr v-for="product in Filtersearch" :key="product.id">
                    <td>{{product.name}}</td>
                    <td><img :src=" supplier.photo" id="img_photo" /></td>
                    <td>{{product.phone}}</td>
                    <td>{{product.email}}</td>
                    <td>{{product.address}}</td>
                    <td>{{product.shopname}}</td>
                    <td>
                        <router-link :to="{name:'edit-product', params:{id:product.id} }" class="btn btn-sm btn-info">Edit</router-link>
                        <a @click="deleteProduct(product.id)"  class="btn btn-sm btn-danger">Delete</a>
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
        this.allProduct();
    }, 
    data(){
       return{
           products:[],
           searchTerm:''
       }
    },
    computed:{
        Filtersearch(){
      return this.products.filter( product=>{
            return product.product_name.match(this.searchTerm)  
      })
      }
    },
    methods:{
        allProduct(){
            axios.get('/api/products/')
            .then(({data})=>(this.products = data))
            .catch()
        },
    
    deleteProduct(id){
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
            axios.delete('/api/products/'+id)
            .then(()=>{
                this.products = this.products.filter(product =>{
                    return product.id !=id
                    
                })
            })
            .catch( ()=>{
                this.$router.push({name:'products'})
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