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

    <div id = "home_logo" class="row">
        <div class="col s12 m12">
            <div class="card-panel red darken-4 z-depth-5">
        <span class="white-text center-align"><h1>Asian Festival</h1>
        </span>
            </div>
        </div>
    </div>

<h5>Asian Festival is Ridgewood High School's program for various performance arts in Asian culture.</h5>
<div class="practices carousel carousel-slider center z-depth-5" id="daily_schedule">
    <div class="carousel-fixed-item center">
        <a class="btn waves-effect white black-text">View Practices</a>
    </div>
    <?php foreach($timeslots as $timeslot) {
     $practices = get_daily_practices_by_time_id($timeslot["time_id"]);   ?>
    <div class="carousel-item teal lighten-4 black-text" href="#<?php echo $timeslot["timeslot_id"]?>">
        <h2><?php echo $timeslot["time"]?></h2>
        <table class="centered">
            <thead>
                <tr>
                    <th>Location</th>
                    <th>Performance</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($practices as $practice) { ?>
                <tr>
                    <td><?php echo $practice["location_name"]?></td>
                    <td><?php echo $practice["name"]?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
<!--    <div class="carousel-item red white-text" href="#one!">-->
<!--        <h2>First Panel</h2>-->
<!--        <p class="white-text">This is your first panel</p>-->
<!--    </div>-->
<!--    <div class="carousel-item amber white-text" href="#two!">-->
<!--        <h2>Second Panel</h2>-->
<!--        <p class="white-text">This is your second panel</p>-->
<!--    </div>-->
<!--    <div class="carousel-item green white-text" href="#three!">-->
<!--        <h2>Third Panel</h2>-->
<!--        <p class="white-text">This is your third panel</p>-->
<!--    </div>-->
<!--    <div class="carousel-item blue white-text" href="#four!">-->
<!--        <h2>Fourth Panel</h2>-->
<!--        <p class="white-text">This is your fourth panel</p>-->
<!--    </div>-->
</div>

<script>
    $('.carousel.carousel-slider').carousel({
        fullWidth: true,
        indicators: true
    });
</script>

<?php create_footer(); ?>