 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/">Dashboard</a>
          </li>
          <li class="breadcrumb-item active"> Edit Category</li>
        </ol>
       
        <div class="card footer-update">
          <div class="card-header col-md-12 ">
            <i class="fas fa-chart-area"></i>
            Category Update 
            <router-link to="/categories" class="btn btn-sm btn-info" id="add_new"> All Categories</router-link>
          </div>
          <div class="card-body">
          	  <form @submit.prevent="categoryUpdate">
                <div class="form-group">
	              <div class="form-row">
	               <div class="col-md-12">
	                <div class="form-label-group">
	                  <input type="text" v-model="form.category_name" class="form-control"   required="">
	                  <small class="text-danger" v-if="errors.category_name">{{ errors.category_name[0] }}</small>
	                  <label for="firstName">Full Name</label>
	                </div>
	               </div>
	             </div>
	          </div>
               <button type="submit" class="btn btn-success">Update</button>
              </form>
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
            let id = this.$route.params.id
            axios.get('/api/categories/'+id)
            .then(({data}) => (this.form = data))
            .catch(console.log('error'))
        },
        data(){
        	return{
        		form:{
        			details :'',
        			amount :'',
        		},
        		errors:{},
        	}
        },
        methods:{ 	
        	categoryUpdate(){
                   let id = this.$route.params.id
                axios.patch('/api/categories/'+id,this.form)
                .then( ()=>{
                    this.$router.push({name:'categories'})
                    Notification.success()
                })
        		.catch(error => this.errors = error.response.data.errors)
            },
        }
    }
</script>

<style>
	
#add_new{
	float: right;
}
.footer-update{
margin-bottom: 10px;
}
</style>