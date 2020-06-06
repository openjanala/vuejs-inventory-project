 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/">Dashboard</a>
          </li>
          <li class="breadcrumb-item active"> All Salary</li>
        </ol>
       
        <div class="card footer-update">
          <div class="card-header col-md-12 ">
            <i class="fas fa-chart-area"></i>
             All Salary Details
          </div>
          <div class="card-body">
 

        <!-- DataTables Example -->
     <div class="table-responsive">
      
                <label >Search</label>
               <input type="text" v-model="searchTerm" class="form-control" style="width:200px; " placeholder="Search Salary Month "><br>

              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                    <tr>
                      <th>Salary Months</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                <tbody>
                  <tr v-for="salary in Filtersearch" :key="salary.salary_month">
                    <td>{{salary.salary_month}}</td>
                    <td>
                        <router-link :to="{name:'view-salary', params:{id:salary.salary_month} }" class="btn btn-sm btn-info">View Salary</router-link>
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
        this.allSalary();
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
            return salary.salary_month.match(this.searchTerm)  
      })
      }
    },
    methods:{
        allSalary(){
            axios.get('/api/salary/')
            .then(({data})=>(this.salaries = data))
            .catch()
        }
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
#img_photo{
    width: 60px;
    height: 40px;
}
</style>