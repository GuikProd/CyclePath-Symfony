# Testing

Testing is an important part of the development process and this project use a lot of tools in order to 
ease the evolution part ... 

## PHPSpec testing

```bash
vendor/bin/phpspec run
```

## PHPUnit testing

```bash
vendor/bin/phpunit -v
```

## Behat testing

For the functional approach, Behat is used ... 

If you need to obtain a coverage of the tests, here's the process : 

```bash
vendor/bin/behat
vendor/bin/behat --profile coverage
```

As CyclePath use a GraphQL API, a dedicated context has been created along with features, in order to launch it : 

```bash
vendor/bin/behat --profile graphql
```

## PHPMetrics validation

In order to validate the internal logic and the "best practices" implementation, we use PHPMetrics, the implementation
is simple and you only need to launch a command in order to see the results : 

```bash
vendor/bin/phpmetrics --report-html=report/phpmetrics src/
vendor/bin/phpmetrics --report-html=report/phpmetrics tests/ # Can be useful for "evolution" purpose.
```

**_Once the metrics are generated, please check that the average Cyclomatic Complexity is close to 1 !_** 

## Blackfire SDK Testing

By default, we use Blackfire SDK in order to test our code and Context (if needed), in order to use it, you must
define the identifiers used in order to call the Blackfire server, here's the process : 

```bash
blackfire config 
# -> Enter your identifiers (already configured in the .env file)
```

...

## Jest testing

As the frontend part is build using React, we've decide to use Jest in order to test our components, 
in order to simplify the process, here's the requirements : 

First, install the dependencies using Yarn : 

```bash
yarn upgrade 
yarn install
```

Now, let's use Encore in order to watch the continuous addition inside the assets folder: 

```bash
./node_modules/.bin/encore dev --watch
```

Alright, now, time to _watch_ the test as soon as we add one : 

```bash
yarn test -- --watch
```

In CI environment, please consider using the following command: 

```bash
yarn test
```
