            <!-- Verstehe nicht für was das ist … -->
            <!-- <div id="payment-modal" class="modal">
                <div class="modal-content">
                    <span id="modal-close" class="close">&times;</span>
                    <iframe id="payment-iframe" frameborder="0" width="100%" height="100%"></iframe>
                </div>
            </div> -->
                <div class="campaignContainer">
                    <h3 class="amount-raised" style="margin-bottom: 10px; margin-top: 10px;">
                        CHF 0<span id="amount-raised"></span> <!-- XXXX Zahl weg -->
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
                                    Moped mit Megaphon
                                </div>
                                <div class="targetMoney">
                                    10’000
                                </div>
                            </div>
                            <div class="Altes-Wohnmobil">

                                <div class="targetObject">
                                    Opas altes Wohnmobil
                                </div>
                                <div class="targetMoney">
                                    20’000
                                </div>
                            </div>

                            <div class="Punkrock-Studiobus">

                                <div class="targetObject">

                                    Punkrock Studiobus </div>

                            </div>
                            <div class="Fancy-Traumbus">

                                <div class="targetObject">
                                    30'000 Fancy Traumbus
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
                                <span class="currency-symbol">CHF</span>
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
                        <button id="rewards" onclick="showRewards()">Alle Goodies ansehen</button>
                        <div id="goodies-container">
                            <br />
                        </div>
                    </div>
                </div>