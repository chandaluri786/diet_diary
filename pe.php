<?php
include_once('header.php');
?>

<body>

<?php
include_once('sideNavigation.php');
include_once('topNavigation.php');
?>

<table class="main">
    <tr>
        <td>
                <div class="container">
                        <div class="month">
                            <i class="fas fa-angle-left prev"></i>
                            <div class="date">
                                <h1></h1>
            
                            </div>
                            <i class="fas fa-angle-right next"></i>
                        </div>
                        <div class="weekdays">
                            <div>Sun</div>
                            <div>Mon</div>
                            <div>Tue</div>
                            <div>Wed</div>
                            <div>Thu</div>
                            <div>Fri</div>
                            <div>Sat</div>
                        </div>
                        <div class="days">
                        </div>
                    </div>
        </td>
        <td>
                <div class="container1">
                        <table class="legend">
                            <tr>
                                <td><i class="fas fa-grin-stars" style="color: gold;"></i></td>
                                <td>Excelent</td>
                            </tr>
                            <tr>
                                <td> <i class="fas fa-grin-beam" style="color: green;"></i></td>
                                <td>Good</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-meh" style="color: rgb(255, 230, 0);"></i></td>
                                <td>Satisfactory</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-frown" style="color:red;"></i></td>
                                <td>Poor</td>
                            </tr>
                        </table>
                    </div>
        </td>
    </tr>
</table>




<?php
include_once('scripts.php');
?>
</body>
