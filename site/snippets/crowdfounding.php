<!-- Sprachen -->
<?php
if ($kirby->language()->code() == 'de') {
    $firstStep = 'Kleines Feuerwerk';
    $secondStep = 'Alle Räume bezahlt!';
    $thirdStep = 'Werbematerial gedeckt!';
    $fourthStep = 'Reisekosten für all unsere Gäste';
    $remainingDays = 'Verbleibende Tage';
    $submit = 'Spenden';
    $showGoodies = 'Goodies anzeigen';
    $urAmount = 'Dein Betrag';
} else {
    $firstStep = 'Small Firework';
    $secondStep = 'All rooms paid for!';
    $thirdStep = 'Advertising material covered!';
    $fourthStep = 'Travel expenses for all our guests';
    $remainingDays = 'Remaining Days';
    $submit = 'Submit';
    $showGoodies = 'Show Goodies';
    $urAmount = 'Your Amount';
}
?>
<!-- Payment Modal for Payrexx integration -->
<div id="payment-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <span id="modal-close" class="close">&times;</span>
        <iframe id="payment-iframe" frameborder="0" width="100%" height="100%"></iframe>
    </div>
</div>
<div class="campaignContainer">
    <h3 class="amount-raised" style="margin-bottom: 10px; margin-top: 50px;">
        <span id="amount-raised"></span>
    </h3>

    <div class="goal-amount">
        <span id="progress-text"></span>
        <br>
        <span id="supporters-count"></span>
    </div>

    <div class="container-progress">
        <div class="container-left">
            <div id="progress"></div>
        </div>
        <div class="container-right">
            <div class="Moped">
                <div class="targetObject">
                    <?= $firstStep ?>
                </div>
                <div class="targetMoney">
                    7’000
                </div>
            </div>
            <div class="Altes-Wohnmobil">
                <div class="targetObject">
                    <?= $secondStep ?>
                </div>
                <div class="targetMoney">
                    10’000
                </div>
            </div>

            <div class="Punkrock-Studiobus">
                <div class="targetObject">
                    <?= $thirdStep ?>
                </div>
            </div>
            <div class="Fancy-Traumbus">
                <div class="targetObject">
                    12'000 <?= $fourthStep ?>
                </div>
            </div>
        </div>
    </div>

    <div class="remaining-days">
        <span id="remaining-days"></span> <?= $remainingDays ?>
    </div>

    <div class="contributions">
        <form id="donate-form">
            <br>
            <div class="amount-input">
                <span class="currency-symbol">CHF</span> <br>
                <input type="number" id="amount" name="amount" min="1" placeholder="<?= $urAmount ?>">
            </div>
            <div class="suggested-amounts">
                <ul>
                    <li style="margin-left: 0;" onclick="setAmount(20)">CHF 20</li>
                    <li onclick="setAmount(50)">CHF 50</li>
                    <li onclick="setAmount(100)">CHF 100</li>
                    <li onclick="setAmount(500)">CHF 500</li>
                </ul>
            </div>
            <button type="submit"><?= $submit ?></button>
        </form>
        <br>
        <button id="rewards" onclick="showRewards()"><?= $showGoodies ?></button>
        <div class="goodiesWrapper">
            <div id="goodies-container">
                <br />
            </div>
        </div>
    </div>
</div>