 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/">Dashboard</a>
          </li>
          <li class="breadcrumb-item active"> All Employees</li>
        </ol>
       
        <div class="card footer-update">
          <div class="card-header col-md-12 ">
            <i class="fas fa-chart-area"></i>
           Employee Salary Details
             <router-link to="/salary" class="btn btn-sm btn-info" id="add_new"> All salaries</router-link>
          </div>
          <div class="card-body">
 

        <!-- DataTables Example -->
     <div class="table-responsive">
      
                <label >Search</label>
               <input type="text" v-model="searchTerm" class="form-control" style="width:200px; " placeholder="Search Employee Name"><br>

              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                    <tr>
                      <th>Name</th>
                      <th>Month</th>
                      <th>Amount</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                <tbody>
                  <tr v-for="salary in Filtersearch" :key="salary.id">
                    <td>{{salary.name}}</td>
                    <td>{{salary.salary_month}}</td>
                    <td>{{salary.amount}}</td>
                    <td>{{salary.salary_date}}</td>
                    <td>
                        <router-link :to="{name:'edit-salary', params:{id:salary.id} }" class="btn btn-sm btn-info">Edit Salary</router-link>
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
        this.viewSalary();
    }, 
    data(){
       return{
           salaries:[],
           searchTerm:''
       }
    },
    computed:{
        Filtersearch(){
      return this.salaries.filter( salary=>{
            return salary.name.match(this.searchTerm)  
      })
      }
    },
    methods:{
         viewSalary(){
            let id = this.$route.params.id
                axios.get('/api/salary/view/'+id)
                 .then(({data})=>(this.salaries = data))
                .catch(error => this.errors = error.response.data.errors)
    },
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