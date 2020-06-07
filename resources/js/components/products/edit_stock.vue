 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/">Dashboard</a>
          </li>
          <li class="breadcrumb-item active"> Update Stock</li>
        </ol>
       
        <div class="card footer-update">
          <div class="card-header col-md-12 ">
            <i class="fas fa-chart-area"></i>
            Stock Update 
            <router-link to="/stock" class="btn btn-sm btn-info" id="add_new"> All Stock</router-link>
          </div>
          <div class="card-body">
          	  <form @submit.prevent="stockUpdate">

                <div class="form-group">
	              <div class="form-row">
	               <div class="col-md-6">
	                <div class="form-label-group">
	                  <input type="text" v-model="form.product_name" class="form-control" readonly required="">
	                  <label for="phone">Quantity  </label>
	                  <small class="text-danger" v-if="errors.product_nameame">{{ errors.product_name[0] }}</small>
	                </div>
	               </div>
                   <div class="col-md-6">
	                <div class="form-label-group">
	                  <input type="text" v-model="form.product_quantity" class="form-control"  required="">
	                  <label for="phone">Quantity  </label>
	                  <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
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
        data(){
        	return{
        		form:{
        			product_quantity:''
        		},
        		errors:{},
        	}
        },
        methods:{ 	
        	stockUpdate(){
                  let id = this.$route.params.id
                axios.patch('/api/stock/update/'+id,this.form)
                .then( ()=>{
                    this.$router.push({name:'stock'})
                    Notification.success()
                })
        		.catch(error => this.errors = error.response.data.errors)
            },
            
        },
         created(){
            let id = this.$route.params.id
            axios.get('/api/products/'+id)
            .then(({data}) => (this.form = data))
            .catch(console.log('error'))
           
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

