 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/">Dashboard</a>
          </li>
          <li class="breadcrumb-item active"> All Expenses</li>
        </ol>
       
        <div class="card footer-update">
          <div class="card-header col-md-12 ">
            <i class="fas fa-chart-area"></i>
     Expense Insert 
            <router-link to="/add-expense" class="btn btn-sm btn-info" id="add_new"> Add Expense</router-link>
          </div>
          <div class="card-body">
 

        <!-- DataTables Example -->
     <div class="table-responsive">
      
                <label >Search</label>
               <input type="text" v-model="searchTerm" class="form-control" style="width:200px; " placeholder="Search Expense Name"><br>

              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                    <tr>
                      <th> Expense Details</th>
                      <th> Amounts</th>
                       <th> Expense Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                <tbody>
                  <tr v-for="expense in Filtersearch" :key="expense.id">
                    <td>{{expense.details}}</td>
                    <td>{{expense.amount}}</td>
                     <td>{{expense.expense_date}}</td>
                    <td>
                        <router-link :to="{name:'edit-expense', params:{id:expense.id} }" class="btn btn-sm btn-info">Edit</router-link>
                        <a @click="deleteExpense(expense.id)"  class="btn btn-sm btn-danger">Delete</a>
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
        this.allexpenses();
    }, 
    data(){
       return{
           expenses:[],
           searchTerm:'',
       }
    },
    computed:{
        Filtersearch(){
      return this.expenses.filter( expense=>{
            return expense.details.match(this.searchTerm)  
      })
      }
    },
    methods:{
        allexpenses(){
            axios.get('/api/expenses/')
            .then(({data})=>(this.expenses = data))
            .catch()
        },
    
    deleteExpense(id){
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
            axios.delete('/api/expenses/'+id)
            .then(()=>{
                this.expenses = this.expenses.filter(expense =>{
                    return expense.id !=id
                    
                })
            })
            .catch( ()=>{
                this.$router.push({name:'expenses'})
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