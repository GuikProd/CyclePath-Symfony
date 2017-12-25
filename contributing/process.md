# Development process 

...

## CI/CD 

This project use multiples CI/CD tools in order to validate the quality and "viability" of the code, 
as every tools are different, here's the list of process to use : 

### CircleCI 

Using CircleCI is pretty straight forward, this way, you can find the config.yml file inside the .circleci folder, 
once you add a new line into this file, please, validate the syntax via the CLI, 
first, you need to download the CLI : [CircleCI]('https://circleci.com/docs/2.0/local-jobs/'), 
then, just use the CLI to validate the file : 

```bash
circleci config validate -c .circleci/config.yml
```

### Gitlab CI

