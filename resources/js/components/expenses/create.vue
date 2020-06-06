 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/">Dashboard</a>
          </li>
          <li class="breadcrumb-item active"> Add Expense</li>
        </ol>
       
        <div class="card footer-update">
          <div class="card-header col-md-12 ">
            <i class="fas fa-chart-area"></i>
            Category Insert 
            <router-link to="/expenses" class="btn btn-sm btn-info" id="add_new"> All Expenses</router-link>
          </div>
          <div class="card-body">
          	  <form @submit.prevent="expenseInsert">
               
                <div class="form-group">
	              <div class="form-row">

                  <div class="col-md-6">
	                <div class="form-group">
                     <label for="exampleFormControlTextarea1">Details Of Expense</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="form.details"   required=""></textarea>
	                  <small class="text-danger" v-if="errors.details">{{ errors.details[0] }}</small>
	                
	                </div>
	               </div>

                    <div class="col-md-6">
	                <div class="form-group">
                    <label for="firstName">Amount Tk. </label>
	                  <input type="text" v-model="form.amount" class="form-control"   required="">
	                  <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
	                  
	                </div>
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
        			details :'',
        			amount :'',
        		},
        		errors:{},
        	}
        },
       
        methods:{
				expenseInsert(){
                axios.post('/api/add-expense/',this.form)
                .then( ()=>{
                    this.$router.push({name:'expenses'})
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