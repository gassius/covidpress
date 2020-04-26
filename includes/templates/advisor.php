<?php
/**
 * COVIDPress Notice
 */

 $data = $this->getData();
 $news = $this->getNews();
?>

<div class="covidpress-advisor bottom theme-ligth">
    COVID ADVISOR
    <div> <?=  'Region: '. $data['region'] . ' - '.'Cases: '. number_format($data['cases']) . ' - '.'Deaths: '. number_format($data['deaths']) ?></div>
    <?php foreach($news as $newsPiece) { ?>
        <div>
            <div><a href="<?= $newsPiece->link ?>" target="_blank">
                <?= $newsPiece->title ?>
            </a></div>
        </div>
    <?php }; ?>
</div>
