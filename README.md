# Factory task

## Architecture overview:

### The application's main entrypoint ('/') is handled by the Data\MealController's index method which in turn returns the data provided by the MealDataGenerator's static main class.

### The application will error out if the tags argument isn't present in the query string.


