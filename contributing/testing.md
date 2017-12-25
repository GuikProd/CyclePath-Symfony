# Testing

Testing is an important part of the development process and this project use a lot of tools in order to 
ease the evolution part ... 

## PHPSpec testing

## PHPUnit testing

## Behat testing

## PHPMetrics validation

In order to validate the internal logic and the "best practices" implementation, we use PHPMetrics, the implementation
is simple and you only need to launch a command in order to see the results : 

```bash
vendor/bin/phpmetrics --report-html=report/phpmetrics src/
vendor/bin/phpmetrics --report-html=report/phpmetrics tests/ # Can be useful for "evolution" purpose.
```

**_Once the metrics are generated, please check that the average Cyclomatic Complexity is close to 1 !_** 

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
