 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/">Dashboard</a>
          </li>
          <li class="breadcrumb-item active"> All Categories</li>
        </ol>
       
        <div class="card footer-update">
          <div class="card-header col-md-12 ">
            <i class="fas fa-chart-area"></i>
     Category Insert 
            <router-link to="/add-category" class="btn btn-sm btn-info" id="add_new"> Add Category</router-link>
          </div>
          <div class="card-body">
 

        <!-- DataTables Example -->
     <div class="table-responsive">
      
                <label >Search</label>
               <input type="text" v-model="searchTerm" class="form-control" style="width:200px; " placeholder="Search Category Name"><br>

              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                    <tr>
                      <th> Category Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                <tbody>
                  <tr v-for="category in Filtersearch" :key="category.id">
                    <td>{{category.category_name}}</td>
                    <td>
                        <router-link :to="{name:'edit-category', params:{id:category.id} }" class="btn btn-sm btn-info">Edit</router-link>
                        <a @click="deleteCategory(category.id)"  class="btn btn-sm btn-danger">Delete</a>
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
        this.allcategories();
    }, 
    data(){
       return{
           categories:[],
           searchTerm:'',
       }
    },
    computed:{
        Filtersearch(){
      return this.categories.filter( category=>{
            return category.category_name.match(this.searchTerm)  
      })
      }
    },
    methods:{
        allcategories(){
            axios.get('/api/categories/')
            .then(({data})=>(this.categories = data))
            .catch()
        },
    
    deleteCategory(id){
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
            axios.delete('/api/categories/'+id)
            .then(()=>{
                this.categories = this.categories.filter(category =>{
                    return category.id !=id
                    
                })
            })
            .catch( ()=>{
                this.$router.push({name:'categories'})
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