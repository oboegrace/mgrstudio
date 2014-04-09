<!-- login.php -->
<div class="container">
	<form class="form-inline" role="form" method="post" action="">
	  <div class="form-group">
	    <label class="sr-only" for="inputEmail2">Email address</label>
	    <input type="email" class="form-control" id="inputEmail2" name="user" placeholder="Enter email">
	  </div>
	  <div class="form-group">
	    <label class="sr-only" for="inputPassword2">Password</label>
	    <input type="password" class="form-control" id="inputPassword2" name="password" placeholder="Password">
	  </div>
	  <div class="checkbox">
	    <label>
	      <input type="checkbox"> Remember me
	    </label>
	  </div>
	  <input type="hidden" name="action" value="login"/>
	  <button type="submit" class="btn btn-default">Sign in</button>
	</form>
</div>