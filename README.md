# Autoregression-for-stock-market-predictions
# Electronic Media Structure

The structure of the electronic media is organized as follows:

1. **main** - This folder contains .txt files that include filtered web scrapy pages.
2. **main** - It includes .php files, which are scripts for running the program.
3. **main** - **Rstudio_docs** - It contains images for testing statistics for stock assets.
4. **main** - **bootstrap** - It includes items for the design and appearance of the webpage.

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

