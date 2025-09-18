<div class="programmContainer" id="programmScroller">
    <div class="filterButtonsContainer" id="filter-buttons">
        <div class="closeProgrammContainer" id="closeProgrammScroller">
            <?php snippet('closeButton') ?>
        </div>
        <Button data-filter="alle">Alle</Button>
        <Button data-filter="musik">Musik</Button>
        <Button data-filter="film">Film</Button>
        <Button data-filter="theorie">Theorie</Button>
        <Button data-filter="sport">Sport</Button>
        <Button data-filter="kinderprogramm">Kinderprogramm</Button>
        <Button data-filter="weiteres">Weiteres</Button>
    </div>
    <div class="programmContentContainer" id="programmGrid">
        <?php snippet('porgrammPunkt') ?>
    </div>
</div>