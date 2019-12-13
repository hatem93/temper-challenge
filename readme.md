# Temper Challenge

  Retention curve chart that shows how far a group of users (weekly cohorts) has progressed through the Onboarding Flow.
  - Get insight of how users flow through the onboarding process
  - Get insight in how the onboarding process improves over time
  - Get information on where we should improve the onboarding, where do users get

# Code Structure

  - CSVReader to read a csv file containing the users data.
  - CSVParser to parse the csv data in the file into users objects.
  - Validator to validate that the input data is in the correct format.
  - Reader Factory for future use to support multiple input options.
  - WeekHelper to get data needed for the graph
  - ChartController creates the graph
  - Router handles all the requests

# Installation

Temper challenge requires [PHP](https://www.php.net/) v5.3+  and [Composer](https://getcomposer.org/) to run.
Temper challenge requires [NodeJs](https://nodejs.org/en/)  and [VueJs](https://vuejs.org/) to run.

I was running PHP 7.1.23  and nodeJS v11.13.0 locally
Download the Project

To Run the backend 
```sh
$ cd temper_backend
$ composer install
$ composer dump-autoload -o
$ php -S localhost:8081
```

To Run the frontend 
```sh
$ cd temper_vue
$ npm install
$ npm run dev
```

# Testing

24 Tests with 46 assertions.
to run the  test use this command 
```sh
$ cd temper_backend
$ ./vendor/bin/phpunit tests/
```
# Assumptions
- Any data that is provided in a wrong manner in the csv file leads to a bad request.
- I have edited a single entry that didn't have an on boarding percentage.

# Notes
- I have implemented the backend in vanilla PHP as to get more bonus points.
- I have implemented the frontend in VueJS "note that this is my first ever experience in VueJS so i might have not followed all the best practices".


# Todos

 - Write more tests
 - Include a Service Layer and a Repository Layer but with the current requirements that was not needed.
 - Include more type of parsers and readers to allow for different input formats.
 
## Authors

 **Hatem Mohamed** [Email](mailto:hatem.hussin1993@gmail.com)
