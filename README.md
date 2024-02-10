<p align="center">
<a href="https://github.com/dom-king/brewdog-beer-finder"><img src="https://i.ibb.co/G0Vv9dj/BEER-removebg-preview.png" alt="BEER-removebg-preview"></a>
</p>

# BrewDog Beer Finder

*BrewDog Beer Finder* is a web application designed for beer enthusiasts to explore and discover a diverse collection of craft beers. The application leverages the BrewDog Punk API to provide detailed information about various beers, including their names, taglines, brewing details, and flavor profiles.

## Features

1. **Beer Catalog:** Access an extensive catalog of craft beers, each accompanied by a rich set of details, such as alcohol by volume (ABV), International Bitterness Units (IBU), and food pairings.

2. **Search and Filter:** Utilise a robust search and filter functionality to find specific beers based on parameters like beer ID, name, or specific characteristics.

3. **User Authentication:** Enjoy a personalised experience by creating an account and logging in. Authenticated users can save favorite beers, contribute reviews, and receive personalised recommendations.

4. **Exception Handling:** The app is equipped with robust error handling to gracefully manage exceptions, ensuring a smooth user experience even in case of unexpected issues.

5. **Integration with External APIs:** Seamlessly integrate with external APIs, such as the BrewDog Punk API, to fetch real-time data about a vast selection of craft beers.

6. **User-Friendly Interface:** Benefit from an intuitive and user-friendly interface designed to enhance the beer exploration experience. The clean layout and straightforward navigation make it easy for users to discover new and exciting brews.

### Prerequisites

Before you begin, make sure you have the following installed on your machine:

- [Composer](https://getcomposer.org/)
- [Node.js and npm](https://nodejs.org/)
- [DBngin](https://dbngin.com/) for local database management
- [PHP 8.2](https://www.php.net/)

## Setup

Follow these steps to set up and run the BrewDog Beer Finder application locally:

1. **Clone the Repository:**
   ```bash
    git clone https://github.com/dom-king/brewdog-beer-finder.git
    ```
   
2. **Install PHP Dependencies:**
   ```bash
    cd brewdog-beer-finder
    composer install
    ```
   
3. **Install JavaScript Dependencies:**
   ```bash
    npm install
    ```

### Start Application

Update Environment Variables:

Create a copy of the .env.example file and save it as .env.
Update the .env file with your local database details (DB_DATABASE, DB_USERNAME, DB_PASSWORD).
- I used a Macbook so I set up DBngin for local set up

1. **Run the Application:**
   ```bash
    php artisan serve
    npm run dev
   ```

2. **Run Migrations and Seed the Database:**
   ```bash
    php artisan migrate
    php artisan db:seed
   ```

### Running Tests

1. **Standard PHPUnit Tests:**
   ```bash
    php artisan test
   ```

2. **CodeSniffer:**
   ```bash
    vendor/bin/phpcs
   ```
   
3. **Lint JavaScript:**
   ```bash
    npm run lint
   ```

### Contributing

Contributions are welcome! If you find any issues or have suggestions for improvements, feel free to open an issue or submit a pull request.

#### Future Work

- Artisan commands to handle the API requests and store the data in the DB
- Job queues to handle the data and keep it up to date
- Extend the search functionality - Builder Sieve pattern for filtering easily
- Component testing - Jest or Storybook for UI design Components
- Dockerise the application
