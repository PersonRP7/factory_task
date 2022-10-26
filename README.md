# Factory task

## Architecture overview:

### The application's main entrypoint ('/') is handled by the MealController's index method which in turn returns the data provided by the Data\MealDataGenerator's static main method..

### The application will error out if the tags argument isn't present in the query string.


