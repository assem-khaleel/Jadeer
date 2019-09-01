<?php

/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 10/3/17
 * Time: 4:20 PM
 */

namespace Facebook\WebDriver;

include 'login.php';

try {
    sleep(1);
    $driver->get('http://jplus.local/committee_work');

//    $full_screenshot = TakeScreenshot($driver);
//
//    $screenshot_of_element = TakeScreenshot($driver,$driver->findElement(WebDriverBy::tagName('select')));
    sleep(1);
//    $select = new WebDriverSelect($driver->findElement(WebDriverBy::tagName('select')));

    $formElement = $driver->findElement(WebDriverBy::tagName('form'));

    $allFormChildElements = $formElement->findElements(WebDriverBy::tagName('select'));

    foreach ($allFormChildElements as $option) {
        $selects = new WebDriverSelect($option);
        sleep(1);
        $selects->selectByIndex('1');
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}

try {
    // Add committee
    $driver->findElement(WebDriverBy::linkText('Add New'))->click();
    sleep(1);
    $formElement = $driver->findElement(WebDriverBy::id('committee-form'));
    $allFormChildElements = new WebDriverSelect($formElement->findElement(WebDriverBy::id('type')));
    $allFormChildElements->selectByIndex('1');
    sleep(2);
    $allFormChildElements = new WebDriverSelect($formElement->findElement(WebDriverBy::id('college_block')));
    $allFormChildElements->selectByIndex('1');
    sleep(1);
    $driver->findElement(WebDriverBy::id('editTitle_en'))->sendKeys('test committee english' . rand(10, 100));
    sleep(1);
    $driver->findElement(WebDriverBy::id('editTitle_ar'))->sendKeys('test committee arabic' . rand(10, 100));
    sleep(1);
    $driver->findElement(WebDriverBy::cssSelector('[name=description_en]'))->sendKeys('description_en english3');
    sleep(1);
    $driver->findElement(WebDriverBy::cssSelector('[name=description_ar]'))->sendKeys('description_ar english3');
    sleep(1);
    $driver->findElement(WebDriverBy::id('start_date'))->sendKeys('2017-10-09');
    sleep(1);
    $driver->findElement(WebDriverBy::id('end_date'))->sendKeys('2017-10-11');
    sleep(1);
    $driver->findElement(WebDriverBy::id('user_label_0'))->click();
    $my_frame = $driver->findElement(WebDriverBy::tagName('iframe'));
    $driver->switchTo()->frame($my_frame);
    $driver->findElement(WebDriverBy::cssSelector("input[type='radio']"))->click();
    sleep(1);
    $driver->findElement(WebDriverBy::id('addMore'))->click();
    $driver->findElement(WebDriverBy::id('user_label_1'))->click();
    $my_frame = $driver->findElement(WebDriverBy::tagName('iframe'));
    $driver->switchTo()->frame($my_frame);
    $driver->findElement(WebDriverBy::id('id_156'))->click();
    sleep(1);
    $driver->findElement(WebDriverBy::cssSelector("input[type='radio']"))->click();
    sleep(1);
    $driver->findElement(WebDriverBy::id('saveCommit'))->click();
    sleep(2);
} catch (\Exception $e) {
    echo $e->getMessage();
}
try{
    // View committee
    $driver->findElement(WebDriverBy::linkText('View'))->click();
    sleep(2);
} catch (\Exception $e) {
    echo $e->getMessage();
}
try {

    // Edit committee
    $driver->get('http://jplus.local/committee_work');
    $driver->findElement(WebDriverBy::linkText('Edit'))->click();
    sleep(2);

    $oldValue2=$driver->findElement(WebDriverBy::id('editTitle_ar'))->getText();
    $oldValue1=$driver->findElement(WebDriverBy::id('editTitle_en'))->getText();

    $driver->findElement(WebDriverBy::id('editTitle_en'))->sendKeys($oldValue2.' edit en'.rand(10, 100));
    sleep(1);
    $driver->findElement(WebDriverBy::id('editTitle_ar'))->sendKeys($oldValue1.' edit ar'.rand(10, 100));
    sleep(1);

    $driver->findElement(WebDriverBy::id('saveCommit'))->click();
    sleep(2);
} catch (\Exception $e) {
    echo $e->getMessage();
}
try{
    // PDF committee
    $driver->get('http://jplus.local/committee_work');
    $driver->findElement(WebDriverBy::linkText('PDF'))->click();
    sleep(3);
} catch (\Exception $e) {
    echo $e->getMessage();
}
try{
    // Delete committee

    $driver->findElement(WebDriverBy::linkText('Delete'))->click();
    sleep(1);
    $driver->findElement(WebDriverBy::cssSelector("button[data-bb-handler='confirm']"))->click();
    print_r('Finish successfully');
} catch (\Exception $e) {
    echo $e->getMessage();
}
//
// function TakeScreenshot($driver, $element=null) {
//    // Change the Path to your own settings
//    $screenshot = "/tmp/Hamza" . time() . ".png";
//
//    // Change the driver instance
//    $driver->takeScreenshot($screenshot);
//    if(!file_exists($screenshot)) {
//        throw new \Exception('Could not save screenshot');
//    }
//
//    if( ! (bool) $element) {
//        return $screenshot;
//    }
//
//    $element_screenshot = "/tmp/hamza". time() . ".png"; // Change the path here as well
//
//    $element_width = $element->getSize()->getWidth();
//    $element_height = $element->getSize()->getHeight();
//
//    $element_src_x = $element->getLocation()->getX();
//    $element_src_y = $element->getLocation()->getY();
//
//    // Create image instances
//    $src = imagecreatefrompng($screenshot);
//    $dest = imagecreatetruecolor($element_width, $element_height);
//
//    // Copy
//    imagecopy($dest, $src, 0, 0, $element_src_x, $element_src_y, $element_width, $element_height);
//
//    imagepng($dest, $element_screenshot);
//
//    // unlink($screenshot); // unlink function might be restricted in mac os x.
//
//    if( ! file_exists($element_screenshot)) {
//        throw new \Exception('Could not save element screenshot');
//    }
//
//    return $element_screenshot;
//}