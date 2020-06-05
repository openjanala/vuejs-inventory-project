 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/">Dashboard</a>
          </li>
          <li class="breadcrumb-item active"> Edit Expense</li>
        </ol>
       
        <div class="card footer-update">
          <div class="card-header col-md-12 ">
            <i class="fas fa-chart-area"></i>
            Expenses Update 
            <router-link to="/expenses" class="btn btn-sm btn-info" id="add_new"> All Expenses</router-link>
          </div>
          <div class="card-body">
          	  <form @submit.prevent="expenseUpdate">
                <div class="form-label-group">
	              <div class="form-row">

                      <div class="col-md-6">
	                <div class="form-label-group">
	                  <input type="textarea" v-model="form.details" class="form-control"   required="">
	                  <small class="text-danger" v-if="errors.details">{{ errors.details[0] }}</small>
	                  <label for="firstName">Expense Details</label>
	                </div>
	               </div>

                   <div class="col-md-6">
	                <div class="form-label-group">
	                  <input type="text" v-model="form.amount" class="form-control"   required="">
	                  <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
	                  <label for="firstName">Amount </label>
	                </div>
	               </div>

	             </div>
	          </div><br>
                
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
            axios.get('/api/expenses/'+id)
            .then(({data}) => (this.form = data))
            .catch(console.log('error'))
        },
        data(){
        	return{
        		form:{
        			details :'',
                    amount :'',
                    expense_date :'',
        		},
        		errors:{},
        	}
        },
        methods:{ 	
        	expenseUpdate(){
                   let id = this.$route.params.id
                axios.patch('/api/expenses/'+id,this.form)
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