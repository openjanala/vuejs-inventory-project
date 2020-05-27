<template>
    <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Register A New Account</div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputName" class="form-control" placeholder="Your Full Name" required="required" autofocus="autofocus">
              <label for="inputName">Full Name</label>
            </div>
          </div>

            <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Email address</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputConPassword" class="form-control" placeholder=" Confirm Password" required="required">
              <label for="inputConPassword">Confirm Password</label>
            </div>
          </div>

          <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
        <div class="text-center">
          <router-link to="/" class="d-block small mt-3">All Ready Have an Account</router-link>
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