<?php create_header(); ?>
<div class="slider">
    <ul class="slides">
        <li>
            <img src="images/asianfest1.jpg" style="filter:blur(8px);-webkit-filter:blur(5px)">
            <div class="caption center-align">
                <h2>Welcome to the practice manager!</h2>
                <h5 class="light grey-text text-lighten-3">Today's practice schedule is below.</h5>
            </div>
        </li>
        <li>
            <img src="images/asianfest2.jpg" style="filter:blur(8px);-webkit-filter:blur(5px)">
            <div class="caption center-align">
                <h2>Check out the navbar!</h2>
                <h5 class="light grey-text text-lighten-3">Sign up if you haven't already done for a more customized experience.</h5>
            </div>
        </li>
        <li>
            <img src="images/asianfest3.PNG" style="filter:blur(8px);-webkit-filter:blur(5px)">
            <div class="caption center-align">
                <h2>Welcome to the practice manager!</h2>
                <h5 class="light grey-text text-lighten-3">Today's practice schedule is below.</h5>
            </div>
        </li>
        <li>
            <img src="images/asianfest4.jpg" style="filter:blur(8px);-webkit-filter:blur(5px)">
            <div class="caption center-align">
                <h2>Check out the navbar!</h2>
                <h5 class="light grey-text text-lighten-3">Sign up if you haven't already done for a more customized experience.</h5>
            </div>
        </li>
    </ul>
</div>
<!--<div id="home_logo" style="background: #c09bd8;" class="row">-->
<!--    <span class="white-text center-align"><h1>Today's Schedule</h1></span>-->
<!--</div>-->
<div style="width:80%" class="practices carousel carousel-slider center z-depth-5 m12 s12" id="daily_schedule">
    <div class="carousel-fixed-item center">
        <a class="btn waves-effect white black-text">View Practices (Does nothing rn)</a>
    </div>
    <?php foreach($timeslots as $timeslot) {
     $practices = get_daily_practices_by_time_id($timeslot["time_id"]);   ?>
    <div style="background: #BFD7EA" class="carousel-item black-text" href="#<?php echo $timeslot["timeslot_id"]?>">
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
    $(document).ready(function(){
        $('.slider').slider({
            indicators: false
        });
    });
</script>

<?php create_footer(); ?>