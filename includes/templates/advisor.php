<?php
/**
 * COVIDPress Notice
 */

 $data = $this->getData()

?>

<div class="covidpress-advisor bottom theme-ligth">COVID ADVISOR <?=  'Region: '. $data['region'] . ' - '.'Cases: '. number_format($data['cases']) . ' - '.'Deaths: '. number_format($data['deaths']) ?></div>