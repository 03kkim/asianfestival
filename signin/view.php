<?php create_header("<style>  
  * {
    margin: 0;
    padding: 0;
  }
  body {
    display: flex;
    min-height: 100vh;
    flex-direction: column;
  }
  main {
    flex: 1 0 auto;
  } 
  h1 {
    margin: 5% auto;
    padding: 1.5%;
  }
  h5 {
    margin: 2% auto;
  }
  .practices {
    width: 40%;
    margin: 0 auto;
    margin-top: 5%;
    margin-bottom: 5%;
  }
  #logo {
    margin-left: 1%;
  }

  #home_logo {
    padding: 5% 0;
  }
  </style>"); ?>
<h2>Sign In</h2>
<form style="width:70%;margin: 0 auto" method="post" action="./index.php">
    <input type="hidden" name="action" id="sign_in">
    <div class="row">
        <div class="col s12">
            <label for="email"> Email </label>
            <input id="email" name="email" type="email">
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <label for="password"> Password </label>
            <input id="password" name="password" type="password">
        </div>
    </div>
    <div>
    <p>
        <label>
            <input type="checkbox" class="filled-in" id="remember" name="remember"/>
            <span>Remember Login?</span>
        </label>
    </p>
    <br>
    </div>
    </div>
    <button style="margin-bottom: 8%;margin-right:8%" class="btn waves-effect waves-light" value="Submit" type="submit" name="submit">
        Submit
        <i class="material-icons right">send</i>
    </button>
    <button style="margin-bottom: 8%" class="btn waves-effect waves-light" value="Cancel" type="submit" name="submit">Cancel</button>
</form>
<?php

create_footer();
?>