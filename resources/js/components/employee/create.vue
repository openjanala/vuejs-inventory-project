<template>
  <h1>This is employee</h1>
</template>

<script type="text/javascript">
export default {
   created(){
     if (User.loggedIn()){
       this.$router.push({name:'add-employee'})
     }
   },
//    data(){
//      return{
//        form:{
//          name:null,
//          email:null,
//          password:null,
//          confirm_password:null
//        },
//      errors:{}, 
//      }
//    },
//   methods:{
//     signup(){
//      axios.post('/api/auth/signup',this.form)
//      .then(res=> {
//        User.responseAfterLogin(res)

//       Toast.fire({
//       icon: 'success',
//       title: 'Registered in successfully'
//       })

//      this.$router.push({ name:'home'})
//      })
//      .catch(error => this.errors = error.response.data.errors)
 
//     }
//   }  
}
</script>


<style type="text/css" scoped>

</style>