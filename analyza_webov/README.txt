Notes for running the program:

The program is written in PHP and requires a server to run on.

We recommend installing XAMPP for local server deployment (https://www.apachefriends.org/index.html).

After installation, it is necessary to move the entire file "analyza_webov" to the "htdocs" folder within the XAMPP directory.

After starting the database at localhost/phpmyadmin, create a database named "analyza_webov" with the username "root" and an empty password. Alternatively, you can go through all the files with the .php extension in the "analyza_webov" folder and search for the "PRIPOJENIE K DATABAZE" comment section to modify the credentials for your own database login.

The "databaza.sql" file for the database is located in the "analyza_webov" folder. You can import it into your own database to have the observed data for the semester.

For web scraping data, analysis, and coefficient calculation: The "analyza_webov" folder contains several scripts that need to be executed sequentially: web_scrap.php, data_filter_30rates.php, data_filter_govcapital.php, data_filter_longforecast.php, data_filter_walletinvestor.php, store_historical_data.php, coef_calculation.php, predic_calculation.php.

After running each script, you can open "index.php" and view the page with predictions for the following week.

WARNING: The program will not work if the scripts from step 6 have not been executed consecutively for each week over a period of 5 weeks. It is necessary for the database to have data for the last 5 weeks for each stock activity; otherwise, the program cannot perform calculations. If this situation occurs, an error message "Chýbajú dáta z minulého týždňa" (Missing data from the previous week) will be displayed instead of predictions.

It is important to have data recorded from the past 5 weeks because the program calculates predictions for each upcoming week based on coefficient calculations from the last 5 weeks. We cannot retrieve historical data since the websites we scrape data from regularly delete their information, likely to protect their reputation.
