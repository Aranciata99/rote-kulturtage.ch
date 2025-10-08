<div class="programmContainer" id="programmScroller">
    <div class="programmContainerHeader" id="filter-buttons">
        <div class="closeProgrammContainer" id="closeProgrammScroller">
            <?php snippet('closeButton') ?>
        </div>
        <div class="toggleFilterMenue" id="toggleFilterMenue"><span>Programm Filter</span></div>
        <div class="filterButtonsContainer">
            <div class="closeFilterMenue" id="closeFilterMenue"><span>×</span></div>
            <Button data-filter="alle"><?= page('programm')?->alle() ?></Button>
            <Button data-filter="performatives"><?= page('programm')?->performatives() ?></Button>
            <Button data-filter="musik"><?= page('programm')?->musik() ?></Button>
            <Button data-filter="film"><?= page('programm')?->film() ?></Button>
            <Button data-filter="theorie"><?= page('programm')?->theorie() ?></Button>
            <Button data-filter="sport"><?= page('programm')?->sport() ?></Button>
            <Button data-filter="kinderprogramm"><?= page('programm')?->kinderprogramm() ?></Button>
            <Button data-filter="weiteres"><?= page('programm')?->weiteres() ?></Button>
        </div>
    </div>
    <div class="programmContentContainer" id="programmGrid">
        <?php snippet('porgrammPunkt') ?>
    </div>
</div>