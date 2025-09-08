            <!-- Verstehe nicht für was das ist … -->
            <!-- <div id="payment-modal" class="modal">
                <div class="modal-content">
                    <span id="modal-close" class="close">&times;</span>
                    <iframe id="payment-iframe" frameborder="0" width="100%" height="100%"></iframe>
                </div>
            </div> -->
            <div class="campaignContainer">
                <h3 class="amount-raised" style="margin-bottom: 10px; margin-top: 10px;">
                    <span id="amount-raised"></span> 
                </h3>

                <div class="goal-amount">
                    <span id="progress-text"></span> von CHF 50’000
                    <br>
                    <span id="supporters-count"></span> Unterstützer:innen
                </div>

                <div class="container-progress">
                    <div class="container-left">
                        <div id="progress"></div>
                    </div>
                    <div class="container-right">
                        <div class="Moped">
                            <div class="targetObject">
                                Kleines Feuerwerk
                            </div>
                            <div class="targetMoney">
                                7’000
                            </div>
                        </div>
                        <div class="Altes-Wohnmobil">
                            <div class="targetObject">
                                Alle Räume bezahlt! 
                            </div>
                            <div class="targetMoney">
                                10’000
                            </div>
                        </div>

                        <div class="Punkrock-Studiobus">
                            <div class="targetObject">
                                Werbematerial gedeckt!
                            </div>
                        </div>
                        <div class="Fancy-Traumbus">
                            <div class="targetObject">
                                12'000 Reisekosten für all unsere Gäste
                            </div>
                        </div>
                    </div>
                </div>

                <div class="remaining-days">
                    <span id="remaining-days"></span> Verbleibende Tage
                </div>

                <div class="contributions">
                    <form id="donate-form">
                        <br>
                        <div class="amount-input">
                            <span class="currency-symbol">CHF</span> <br>
                            <input type="number" id="amount" name="amount" min="1" placeholder="Dein Betrag">
                        </div>
                        <div class="suggested-amounts">
                            <ul>
                                <li style="margin-left: 0;" onclick="setAmount(25)">CHF 25</li>
                                <li onclick="setAmount(50)">CHF 50</li>
                                <li onclick="setAmount(100)">CHF 100</li>
                                <li onclick="setAmount(500)">CHF 500</li>
                            </ul>
                        </div>
                        <button type="submit">Spenden</button>
                    </form>
                    <br>
                    <button id="rewards" onclick="showRewards()">Goodies anzeigen</button>
                    <div id="goodies-container">
                        <br/>
                    </div>
                </div>
            </div>