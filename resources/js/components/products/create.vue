 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/">Dashboard</a>
          </li>
          <li class="breadcrumb-item active"> Add Product</li>
        </ol>
       
        <div class="card footer-update">
          <div class="card-header col-md-12 ">
            <i class="fas fa-chart-area"></i>
            Product Insert 
            <router-link to="/products" class="btn btn-sm btn-info" id="add_new"> All Products</router-link>
          </div>
          <div class="card-body">
          	  <form @submit.prevent="productInsert" enctype="multipart/form-data">
                <div class="form-group">
	              <div class="form-row">
	               <div class="col-md-6">
	                <div class="form-label-group">
	                  <input type="text" v-model="form.product_name" class="form-control"   required="">
	                  <small class="text-danger" v-if="errors.product_name">{{ errors.product_name[0] }}</small>
	                  <label for="firstName">Product Name</label>
	                </div>
	               </div>
	               <div class="col-md-6">
	                <div class="form-label-group">
	                  <input type="text" v-model="form.product_name" class="form-control"  required="">
	                  <small class="text-danger" v-if="errors.product_name">{{ errors.product_name[0] }}</small>
	                  <label for="lastName">Product Code</label>
	                </div>
	               </div>
	             </div>
	          </div>
	          <div class="form-group">
	              <div class="form-row">
	               <div class="col-md-6">
	                  <div class="form-group">
	                  <label for="category">Categories</label>
                        <select class="form-control" id="category" v-model="form.category_id">
                            <option :value="category.id" v-for="category in categories">{{category.category_name}}</option>
                        </select>
                        <small class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</small>
	                </div>
	               </div>
                   <div class="col-md-6">
	                  <div class="form-group">
	                  <label for="supplier">Suppliers</label>
                        <select class="form-control" id="supplier" v-model="form.supplier_id">
                            <option :value="supplier.id" v-for="supplier in suppliers">{{supplier.name}}</option>
                        </select>
                        <small class="text-danger" v-if="errors.supplier_id">{{ errors.supplier_id[0] }}</small>
	                </div>
	               </div>
	             </div>
	          </div>
	          <div class="form-group">
	              <div class="form-row">
						<div class="col-md-6">
							<div class="form-label-group">
							<input type="text" v-model="form.phone" class="form-control"  required="">
							<label for="phone">Phone Number</label>
							<small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
							</div>
						</div>

	               <div class="col-md-6">
						<div class="form-label-group">
							<input type="text" v-model="form.shopname" class="form-control"  required="">
							<label for="nid">Shop Name</label>
							<small class="text-danger" v-if="errors.shopname">{{ errors.shopname[0] }}</small>
						</div>
	               </div>
	              
	             </div>
	          </div>
               <div class="form-group">
	              <div class="form-row">

	               <div class="col-md-6">
	                <div class="form-label-group">
	                 <input type="file" class="btn btn-info" @change="onFileselected">
	                  <small class="text-danger" v-if="errors.image">{{ errors.image[0] }}</small>
	                </div>
	               </div>
	                <div class="col-md-6">
	                	<img :src="form.image" style="height:80px; width: 80px;">
	                </div>
	             </div>
	          </div>
               <button type="submit" class="btn btn-success">Submit</button>
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
        			product_name :'',
        			product_code :'',
        			category_id:'',
        			supplier_id:'',
        			root :'',
        			buying_price:'',
        			selling_price : '',
        			buying_date:'',
        			image:'',
        			product_quantity:''
        		},
        		errors:{},
        		categories:{},
        		suppliers:{},
        	}
        },
        methods:{ 	
        	onFileselected(event){
        		let file=event.target.files[0];
        		if (file.size > 1048770) {
        			Notification.image_validation()
        		}else{
        			let reader = new FileReader();
        			reader.onload = event => {
        				this.form.image = event.target.result

        				console.log(event.target.result);
        			};
        			reader.readAsDataURL(file);
        		}
        	},
        	productInsert(){
                axios.post('/api/add-product/',this.form)
                .then( ()=>{
                    this.$router.push({name:'products'})
                    Notification.success()
                })
        		.catch(error => this.errors = error.response.data.errors)
            },
            
        },
         created(){
             axios.get('/api/categories')
            .then(({data}) => (this.categories = data))
            .catch()

            axios.get('/api/suppliers')
            .then(({data}) => (this.suppliers = data))
            .catch()
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