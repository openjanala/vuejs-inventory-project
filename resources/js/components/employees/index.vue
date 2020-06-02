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
          All Employees
            <router-link to="/add-employee" class="btn btn-sm btn-info" id="add_new"> Add Employee</router-link>
          </div>
          <div class="card-body">
 

        <!-- DataTables Example -->
     <div class="table-responsive">
      
                <label >Search</label>
               <input type="text" v-model="searchTerm" class="form-control" style="width:200px; " placeholder="Search phone"><br>

              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                    <tr>
                      <th>Name</th>
                      <th>Photo</th>
                      <th>Phone</th>
                      <th>Salary</th>
                      <th>Joining date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                <tbody>
                  <tr v-for="employee in Filtersearch" :key="employee.id">
                    <td>{{employee.name}}</td>
                    <td><img :src=" employee.photo" id="img_photo" /></td>
                    <td>{{employee.phone}}</td>
                    <td>{{employee.salary}}</td>
                    <td>{{employee.joining_date}}</td>
                    <td>
                        <router-link :to="{name:'edit-employee', params:{id:employee.id} }" class="btn btn-sm btn-info">Edit</router-link>
                        <a @click="deleteEmployee(employee.id)"  class="btn btn-sm btn-danger">Delete</a>
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
        this.allEmployee();
    }, 
    data(){
       return{
           employees:[],
           searchTerm:''
       }
    },
    computed:{
        Filtersearch(){
      return this.employees.filter( employee=>{
            return employee.phone.match(this.searchTerm)
            return employee.name.match(this.searchTerm)  
      })
      }
    },
    methods:{
        allEmployee(){
            axios.get('/api/employees/')
            .then(({data})=>(this.employees = data))
            .catch()
        },
    
    deleteEmployee(id){
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
            axios.delete('/api/employees/'+id)
            .then(()=>{
                this.employees = this.employees.filter(employee =>{
                    return employee.id !=id
                    
                })
            })
            .catch( ()=>{
                this.$router.push({name:'employees'})
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