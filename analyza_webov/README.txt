poznámky k spusteniu programu:

1.program je napísaný v jazyku php, potrebuje server, na ktorom bude bežať

2. odporúčame nainštalovať XAMPP pre spustenie na lokálnom servery (https://www.apachefriends.org/index.html)

3. po nainštalovaní je potrebné celý súbor analyza_webov presunúť do htdocs v priečinku xampp

4. po spustení databázy localhost/phpmyadmin je potrebné si vytvoriť databázu s názvom 
"analyza_webov" a username "root" a heslom "". Alternatívna možnosť je prejsť všetky súbory s koncovkou .php v priečinku analyza_webov a vyhľadať v nich časť komentáru "PRIPOJENIE K DATABAZE" a zmeniť údaje pre svoj vlastný login do databázy.

5. databaza.sql súbor k databáze sa nachádza v priečinku analyza_webov, môžete si ho importovať do vlastnej databázy pre odpozorované dáta počas semestra

6. pre webscrap dát, analýzu a výpočet koeficientov: priečinok analyza_webov obsahuje niekoľko skriptov, ktoré je potrebné spustiť po sebe v následnosti: web_scrap.php, data_filter_30rates.php, data_filter_govcapital.php, data_filter_longforecast.php, data_filter_walletinvestor.php, store_historical_data.php, coef_calculation,php, predic_calculation.php

7. po zbehnutí každého skriptu môžeme otvoriť index.php a uvidíme stránku s predpoveďami pre nasledujúci týždeň

8. UPOZORNENIE: program nebude fungovať ak neboli 5 týždňov po sebe spustené skripty z bodu 6. pre každý týždeň. Je potrebné, aby v databáze boli totiž uložené dáta pre posledných 5 týždňov pre každé burzové aktívum, program inak nemá z čoho robiť výpočty. Ak nastane táto situácia na stránke namiesto predpovedí je vypísaná chyba "Chýbajú dáta z minulého týždňa".

9. Dáta je potrebné mať zaznamenané z posledných 5 týždňov z dôvodu, že programrobí výpočty pre každý nasledujúci týždeň z výpočtu koeficientov z posledných 5 týždňov. Nevieme sa k týmto dátam historicky vrátiť, pretože stránky svoje údaje, z ktorých scrapujeme, mažú. je tomu tak pravdepodobne z dôvodov nepokazenia si reputácie

