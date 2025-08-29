<div class="contactContainer" id="contactScroller">
    <div class="closeContactContainer" id="closeContactScroller">
        <?php snippet('closeButton') ?>
    </div>
    <div class="contactContentContainer">
        <div class="contactFunding" id="">
            <small>Crowdfounding</small>
            <p>Platzhalter Ein kleines Bächlein namens Duden fließt durch ihren Ort und versorgt sie mit den nötigen Regelialien. </p>
        </div>
        <div class="contactNewsletter" id="">
            <small>Newsletter</small>
            <form class="newsletterForm">
                <input type="email" id="email" name="email" placeholder="name@email.com" required>
                <button type="submit">Confirm</button>
            </form>
        </div>
        <div class="contactMail" id="">
            <small>Kontakt</small>
            <a href="mailto:rotekulturtage@immerda.ch" target="_blank"><button>E-MAIL</button></a>
        </div>
        <div class="contactVerein" id="">
            <small>Verein</small>
            <p><?= $site->contactVereinText()->kt() ?></p>
        </div>
    </div>

</div>