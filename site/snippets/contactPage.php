<div class="contactContainer" id="contactScroller">
    <div class="closeContactContainer" id="closeContactScroller">
        <?php snippet('closeButton') ?>
    </div>
    <div class="contactContentContainer">
        <div class="contactFunding">
            <?php snippet('sticker') ?>
        </div>
        <div class="contactNewsletter" id="">
            <small>Newsletter</small>
            <form method="post" action="https://newsletter.infomaniak.com/v3/api/1/newsletters/webforms/21653/submit" class="inf-form"><input type="email" name="email" style="display:none" /><input type="hidden" name="key" value="eyJpdiI6Ik9XTVM3aFFZazZ0RVF0TTFBa3VTd0p5NytaR2NtSE01c3NzYktrOHN2K3c9IiwibWFjIjoiZWM2MGM2ZTcxMGI5NDVlYzZmYTJkN2Y5YTI2MmQ3M2UzMzk5MjRkZTkzZjNiOTI1NDBjYzBhMTU4MDBjMGEzOSIsInZhbHVlIjoiQUhZXC9McnlaVXg2M0V0UjNacWtVVjArSFJWeCtcL1ZlMjhGME9aT0FOelNnPSJ9"><input type="hidden" name="webform_id" value="21653">
                <style>
                    .inf-main_98ea09126edd6eea0b7affbbeb0d9b17 {
                        background-color: none;
                        padding: none;
                        margin: none;
                    }

                    .inf-main_98ea09126edd6eea0b7affbbeb0d9b17 .inf-content {
                        margin-top: 0;
                    }

                    .inf-main_98ea09126edd6eea0b7affbbeb0d9b17 h4,
                    .inf-main_98ea09126edd6eea0b7affbbeb0d9b17 span,
                    .inf-main_98ea09126edd6eea0b7affbbeb0d9b17 label,
                    .inf-main_98ea09126edd6eea0b7affbbeb0d9b17 input,
                    .inf-main_98ea09126edd6eea0b7affbbeb0d9b17 .inf-submit,
                    .inf-main_98ea09126edd6eea0b7affbbeb0d9b17 .inf-success p a {
                        color: black;
                        font-size: 2.2vh;
                    }

                    .inf-main_98ea09126edd6eea0b7affbbeb0d9b17 h4 {
                        font-size: 2.2vh;
                        margin: 0;
                    }

                    .inf-main_98ea09126edd6eea0b7affbbeb0d9b17 .inf-input {
                        margin-bottom: 0;
                    }

                    .inf-main_98ea09126edd6eea0b7affbbeb0d9b17 label {
                        display: block;
                    }

                    .inf-main_98ea09126edd6eea0b7affbbeb0d9b17 input {
                        height: calc(var(--header-footer-height-width) / 5 * 4);
                        color: black;
                        border: var(--border-thickness) solid black;
                        padding-inline: 2vh;
                    }

                    .inf-main_98ea09126edd6eea0b7affbbeb0d9b17 .inf-input.inf-error label,
                    .inf-main_98ea09126edd6eea0b7affbbeb0d9b17 .inf-input.inf-error span.inf-message {
                        color: var(--rkt-red);
                    }

                    .inf-main_98ea09126edd6eea0b7affbbeb0d9b17 .inf-input.inf-error input {
                        border: var(--border-thickness) solid var(--rkt-red);
                    }

                    .inf-main_98ea09126edd6eea0b7affbbeb0d9b17 .inf-input input {
                        width: calc(100% - var(--header-footer-height-width)/5*4);
                    }

                    .inf-main_98ea09126edd6eea0b7affbbeb0d9b17 .inf-input.inf-error span.inf-message {
                        display: block;
                    }

                    .inf-main_98ea09126edd6eea0b7affbbeb0d9b17 .inf-submit {
                        text-align: left;
                    }

                    .inf-main_98ea09126edd6eea0b7affbbeb0d9b17 .inf-submit input {
                        background-color: black;
                        color: white;
                        border: var(--border-thickness) solid black;
                        font-weight: normal;
                        height: var(--header-footer-height-width);
                        padding-inline: 2vh;
                        top: -18px;
                        cursor: pointer;
                        width: 100%;
                    }

                    .inf-main_98ea09126edd6eea0b7affbbeb0d9b17 .inf-submit input:hover {
                        border: var(--border-thickness) solid black;
                        background-color: white;
                        color: black;
                    }

                    .inf-main_98ea09126edd6eea0b7affbbeb0d9b17 .inf-submit input.disabled {
                        opacity: 0.5;
                    }

                    /*.inf-btn {
                        color: rgb(85, 85, 85);
                        border: medium none;
                        font-weight: normal;
                        height: auto;
                        padding: 7px;
                        display: inline-block;
                        background-color: white;
                        box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.24);
                        border-radius: 2px;
                        line-height: 1em;
                    }*/

                    .inf-rgpd {
                        position: relative;
                        margin: 0;
                        color: black;
                        font-size: 1.3vh;
                    }

                </style>
                <div class="inf-main_98ea09126edd6eea0b7affbbeb0d9b17">
                    <div class="inf-success" style="display:none">
                        <small><a href="#" class="inf-btn">Ihre Anmeldung wurde erfolgreich registriert!</a></small>
                    </div>
                    <div class="inf-content">
                        <div class="inf-input inf-input-text"> <input type="email" name="inf[1]" data-inf-meta="1" data-inf-error="" required="required" placeholder="Email *"> </div>
                        <script src="https://eu.altcha.org/js/latest/altcha.min.js" type="module" defer></script> <altcha-widget hidelogo hidefooter floating challengeurl="https://newsletter.infomaniak.com/v3/altcha-challenge"></altcha-widget>
                        <script src="https://newsletter.storage5.infomaniak.com/mcaptcha/altcha.js" defer> </script>
                        <script type="text/javascript" src="https://newsletter.infomaniak.com/v3/static/webform_index.js?v=1758577023"></script>
                        <div class="inf-submit"> <input type="submit" style="margin-top: 25px;" name="" value="Bestätigen"> </div>
                        <div class="inf-rgpd">Ihre E-Mail-Adresse wird nur verwendet, um Ihnen unseren Newsletter und Informationen über unsere Aktivitäten zuzusenden. Sie können jederzeit den Abmeldelink in unseren E-Mails nutzen.</div>
                    </div>
                </div>
            </form>
        </div>
        <div class="contactMail" id="">
            <small>Kontakt</small>
            <a href="mailto:rotekulturtage@immerda.ch" target="_blank"><button>E-Mail</button></a>
        </div>
        <div class="contactVerein" id="">
            <small>Verein</small>
            <p><?= page('contact')?->contactVereinText()->kt() ?></p>
        </div>
    </div>

</div>