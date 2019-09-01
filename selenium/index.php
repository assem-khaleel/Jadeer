<?php

error_reporting(-1);
ini_set('display_errors', 1);

define('BASEPATH', realpath(dirname(__FILE__) . '/../') . DIRECTORY_SEPARATOR);
define('SENARIOS_PATH', BASEPATH . 'selenium/Test/Senarios' . DIRECTORY_SEPARATOR);

$senarios = [];
foreach (scandir(SENARIOS_PATH) as $senario) {
    if (preg_match('/(.php)$/', $senario)) {
        $senario = strtok($senario, '.php');
        $senarios[$senario] = "Selenium\\Test\\Senarios\\{$senario}";
    }
}

?>

<ul>
    <?php foreach ($senarios as $name => $class) { ?>
    <li>
        <a href="run.php?class=<?php echo $class ?>" target="_blank"><?php echo $name ?></a>
    </li>
    <?php } ?>
</ul>
