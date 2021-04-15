# 🌤 iSeekWeather

## Install

Clone the repository to your machine

	$ git clone https://github.com/fenski/iseekweather.git

Copy the example .env file

	$ cp .env.example .env

Generate the application key

	$ php artisan key:generate
	
Install composer dependencies

    $ composer install
	
Install npm packages

    $ npm install
	
Build assets

    $ npm run prod
    
## Using the application

### Frontend
Simply navigate to the root URL and use the on-page select box.

### Report
Use the following command to generate the report.

    $ php artisan report:forecast <comma separated list of city names>
    
Example:

    $ php artisan report:forecast "Adelaide, Brisbane, Canberra"

## Notes

### Packages used

- [Laravel OpenWeather](https://github.com/dnsimmons/openweather).

### Requirements

- [Open Weather Map Account](https://openweathermap.org/). A test API key has already been provided in this repository.

### Assumptions
- Cities can be populated with a unique slug that are stored along with a 'readable name' and coordinates

### Design choices
#### "City Keys" and coordinates
You will see that both the city name and a 'city key' (similar to a slug) can be used to retrieve results. This is to add usability but also future-proof. The usability of a user not having to understand specific slugs but rather be able to use the city full name when generating reports can not be underestimated. 

However, within Australia, and _especially_ if you were to scale this application to work internationally, you will run into scenarios where the city names are duplicated. This is where the unique city slug saves you. Eg. paris-us and paris-fr can be used to represent the two cities called "Paris" in the US, and in France.

Similarly you'll see the coordinates stored along with the cities in CityRepository. The simple `data()` method returns the list, but this would ideally be replaced with a data table, external search service, etc. The coordinates are required for the weather API.

 Cities you can use:
 
``
    ['Adelaide', 'Brisbane', 'Canberra', 'Darwin']
``

#### Repositories
I don't like any data access or mutation to happen within any controllers. I extracted that logic into repositories so that if we decide to switch which API to use for gathering the weather, all we need to do is update the internal repository API call and ensure that the returned data is transformed into the same format and everything should continue to work.

#### API
The 'API' referenced in the app is simply added on to the general front-end application. Typically, if time allowed, this would be extracted to the api.<app> space and treated with isolated tests and security.

#### Loading states (and the lackthereof)
You will see references to isLoading and the like in the ReactJS app. The truth is I ran out of time to display appropriate loading states during the API calls.

#### Using an existing API package for OpenWeather
As much as I would have enjoyed writing this, I don't believe in reinventing the wheel, _especially_ under time constraints, and taking on future update responsibilities. It would have been nice if this package already had a suite of unit tests, however.