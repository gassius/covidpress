<?php
/**
 * COVIDPress Notice
 */

 $data = $this->getData();
 $news = $this->getNews();
?>

<div class="covidpress-advisor bottom">
    <div class="covidpress-advisor-display theme-ligth">
        <div class="covidpress-advisor-display-header">
            <div class="covidpress-advisor-display-title"><h1><?= _('COVID-19 Information') ?></h1></div>
            <div class="covidpress-advisor-display-dismiss"><a id="covidpress-advisor-dismiss"><?= _('Close') ?></a></div>
        </div>
        <div class="covidpress-advisor-display-content">
            <div class="covidpress-advisor-display-data"> 
                <div class="covidpress-advisor-display-data-element region">
                    <div class="covidpress-advisor-display-data-element-header"><?=  _('Region') ?>:</div>
                    <div class="covidpress-advisor-display-data-element-data"><?=   $data['region'] ?></div>
                </div>
                <div class="covidpress-advisor-display-data-element cases">
                    <div class="covidpress-advisor-display-data-element-header"><?=  _('Cases') ?>:</div>
                    <div class="covidpress-advisor-display-data-element-data"><?=    number_format($data['cases']) ?></div>
                </div>
                <div class="covidpress-advisor-display-data-element deaths">
                    <div class="covidpress-advisor-display-data-element-header"><?=  _('Deaths') ?>:</div>
                    <div class="covidpress-advisor-display-data-element-data"><?=    number_format($data['deaths']) ?></div>
                </div>
            </div>
            <div class="news-block">
                <div class="news-header">
                    <h2><?= _('Latest COVID-19 news from') . ' ' ?><a href="https://emm.newsbrief.eu/" target="_blank">EMM Newsbrief</a></h2>
                </div>
                <?php foreach($news as $newsPiece) { ?>
                    <div class="news-item">
                        <a href="<?= $newsPiece->link ?>" target="_blank">
                            <?= $newsPiece->title ?>
                        </a>
                        <span class="news-source"><?= _('Source') . ': '.  $newsPiece->source ?></span>
                    </div>
                <?php }; ?>
            </div>
        </div>
        <div class="covidpress-advisor-display-footer">
            <?= _('Data provided by data.europa.eu - Component initial developed at #EUvsVirus Hackaton') ?>
        </div>
    </div>
</>
