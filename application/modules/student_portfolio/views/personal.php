<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/6/16
 * Time: 10:09 PM
 */
/** @var Orm_Stp_Social $social */
/** @var Orm_Stp_Community_Services[] $services */
/** @var Orm_Stp_Activities[] $activities */
/** @var Orm_Stp_Skill[] $skills */
/** @var int $user_id */
?>
<div id="personal_container">
    <?php echo $personal ?>
</div>
<hr>

<div id="social_container">
    <?php echo $social ?>
</div>

<div id="services_container">
    <?php echo $services ?>
</div>

<div id="activities_container">
    <?php echo $activities ?>
</div>

<div id="skill_container">
    <?php echo $skills ?>
</div>
