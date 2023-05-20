# Autoregression-for-stock-market-predictions
# Electronic Media Structure

The structure of the electronic media is organized as follows:

1. **analyza-webov** - This folder contains .txt files that include filtered web scrapy pages.
2. **analyza-webov** - It includes .php files, which are scripts for running the program.
3. **analyza-webov** - **Rstudio_docs** - It contains images for testing statistics for stock assets.
4. **analyza-webov** - **bootstrap** - It includes items for the design and appearance of the webpage.

## Instructions

To use the program, follow these steps:

1. The program is written in PHP and requires a server to run on.
2. We recommend installing XAMPP to run it on a local server.
3. After installation, move the entire `analyza_webov` folder to the `htdocs` folder in the XAMPP directory.
4. Once the database is running at `localhost/phpmyadmin`, create a database named 'analyza_webov' with username 'root' and no password. Alternatively, navigate through the .php files in the `analyza_webov` folder and find the 'DATABASE CONNECTION' comment section to modify the credentials for your own database login.
5. The `databaza.sql` file for the database is located in the `analyza_webov` folder. You can import it into your own database to have the observed data from the semester.
6. For web scraping data, analysis, and coefficient calculation, follow these steps:
   - Run the scripts in the `analyza_webov` folder in the following sequence: `web_scrap.php`, `data_filter_30rates.php`, `data_filter_govcapital.php`, `data_filter_longforecast.php`, `data_filter_walletinvestor.php`, `store_historical_data.php`, `coef_calculation.php`, `predic_calculation.php`.
7. After running each script, open `index.php` to view the page with predictions for the next week.
8. **WARNING**: The program will not work if the scripts from step 6 have not been run for each week for five consecutive weeks. The database needs to have data for the last five weeks for each stock asset; otherwise, the program will display an error message stating 'Missing data from the previous week.'
9. Data must be recorded from the past five weeks since the program calculates predictions for each upcoming week based on coefficients derived from the past five weeks. We cannot retrieve historical data as the websites we scrape from delete their data. They likely do this to protect their reputation.

## NOTES for running the program

The program is written in PHP and requires a server to run on.

We recommend installing XAMPP for local server deployment (https://www.apachefriends.org/index.html).

After installation, it is necessary to move the entire file "analyza_webov" to the "htdocs" folder within the XAMPP directory.

After starting the database at localhost/phpmyadmin, create a database named "analyza_webov" with the username "root" and an empty password. Alternatively, you can go through all the files with the .php extension in the "analyza_webov" folder and search for the "PRIPOJENIE K DATABAZE" comment section to modify the credentials for your own database login.

The "databaza.sql" file for the database is located in the "analyza_webov" folder. You can import it into your own database to have the observed data for the semester.

For web scraping data, analysis, and coefficient calculation: The "analyza_webov" folder contains several scripts that need to be executed sequentially: web_scrap.php, data_filter_30rates.php, data_filter_govcapital.php, data_filter_longforecast.php, data_filter_walletinvestor.php, store_historical_data.php, coef_calculation.php, predic_calculation.php.

After running each script, you can open "index.php" and view the page with predictions for the following week.

WARNING: The program will not work if the scripts from step 6 have not been executed consecutively for each week over a period of 5 weeks. It is necessary for the database to have data for the last 5 weeks for each stock activity; otherwise, the program cannot perform calculations. If this situation occurs, an error message "Chýbajú dáta z minulého týždňa" (Missing data from the previous week) will be displayed instead of predictions.

It is important to have data recorded from the past 5 weeks because the program calculates predictions for each upcoming week based on coefficient calculations from the last 5 weeks. We cannot retrieve historical data since the websites we scrape data from regularly delete their information, likely to protect their reputation.

