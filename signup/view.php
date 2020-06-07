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
<h1>Sign Up</h1>

<form style="width:70%;margin: 0 auto" type="submit" >
    <input type="hidden" name="action" id="add_user">
    <div class="row">
        <div class="col s12">
            <label for="email"> Email </label>
            <input id="email" name="email" type="email">
        </div>
    </div>
    <div class="row">
        <div class="col s6">
            <label for="first_name"> First Name </label>
            <input type="text" name="first_name" id="first_name">
        </div>
        <div class="col s6">
            <label for="last_name"> Last Name </label>
            <input type="text" name="last_name" id="last_name">
        </div>
    </div>
    <div class="row">
        <div class="col s6">
            <label for="grade">Grade</label>
            <select id="grade" name="grade">
                <option disabled selected></option>
                <option value="9">9th Grade</option>
                <option value="10">10th Grade</option>
                <option value="11">11th Grade</option>
                <option value="12">12th Grade</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col s4">
            <label for="performance1">Performance 1</label>
            <select id="performance1" name="performance1">
                <option selected disabled value=""></option>
                <?php foreach($performances as $performance) { ?>
                <option class="<?php echo $performance['name']?>" value="<?php echo $performance['performance_id']?>"> <?php echo $performance["name"]?> </option>
                <?php } ?>
            </select>
        </div>
        <div class="col s4">
            <label for="performance2">Performance 2</label>
            <select id="performance2" name="performance2">
                <option selected disabled value=""></option>
                <?php foreach($performances as $performance) { ?>
                    <option class="<?php echo $performance['name']?>" value="<?php echo $performance['performance_id']?>"> <?php echo $performance["name"]?> </option>
                <?php } ?>
            </select>
        </div>
        <div class="col s4">
            <label id="hide-me" for="performance3">Performance 3</label>
            <select id="performance3" name="performance3">
                <option selected disabled></option>
                <?php foreach($performances as $performance) { ?>
                    <option class="<?php echo $performance['name']?>" value="<?php echo $performance['performance_id']?>"> <?php echo $performance["name"]?> </option>
                <?php } ?>
            </select>
        </div>
        </div>
    </div>

</form>

<script>
    $(document).ready(function(){
        $('select').formSelect();
    });

    $("#grade").change(function () {
        let elem = parseInt($("#grade").val());
        if (elem < 11) {
            $('#performance3').formSelect('destroy');
            document.getElementById("hide-me").style.display = "none";
        }
        else {
            $('#performance3').formSelect();
            document.getElementById("hide-me").style.display = "block";
        }
    });
</script>

<?php

create_footer();
?>