<template>
 <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Forgot Password</div>
      <div class="card-body">
       
        <form>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" class="form-control" placeholder="Existing email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Existing email address</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
        </form>
        <div class="text-center">
          <router-link to="/" class="d-block small">Back to Login </router-link>
         
        </div>
      </div>
    </div>
  </div>
</template>

<script type="text/javascript">
export default {
    
}
</script>


<style type="text/css" scoped>

</style>