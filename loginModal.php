<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
          <div class="loginmodal-container">
            <h1>Login to Your Account</h1><br>
            <form id="loginForm" method="POST" onsubmit="return false">
              <input type="text" name="userId" id="userId" placeholder="Username" required>
              <input type="password" name="pass" id="pass" placeholder="Password" required>
              <input type="submit" name="login" class="login loginmodal-submit" value="Login">
            </form>		
            <div class="login-help">
              <a href="signup_page.php">Sign Up</a>
            </div>
        </div>
    </div>
</div>