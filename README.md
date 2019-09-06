# PHP Lightweight App Structure

## Requirements
* NodeJS

To use the PHP dev server you need PHP installed on your dev machine.

## Features
* No PHP dependencies
* SCSS styles
* JS bundle code splitting
* Full routing logic with clean URLs
* Can use the basic PHP dev server for development purposes

## Routing

### Views
TODO Explain the logic.

### API endpoints
We assume some sort of API version identifier to follow the "/api/" part of the URL e.g. "/api/v1/".

That version identifier is accessible to the API endpoint handler script through the `$app['api_version']` string.

## Package versions
* Version 2 of clean-webpack-plugin seems to behave completely differently. A good idea would be to just use rimraf to clean up the dist foler.

## TODO
- [x] Do it like React with a rotating logo :D
- [ ] Test what happens when just using root_url/api
- [x] Make the document title dynamic
- [ ] Add autoprefixer to the webpack config for regular .css files
- [x] Test on Windows
- [ ] Add a Dockerfile

## To explain
- Explain how to add a CSS framework
- Talk about tests somewhere
- Explain how to add more JS bundles
- Explain how you can inline page content inside a view PHP file and how we sort of moved away from absolute separation of concern (404.php will use that I think)
- There is no caching for templates - assets paths or fully processed partials could be cached
- Link the "PHP templating" page from the official doc (native PHP templating?)
- Explain how to add Babel and why I'm not using it in the baseline
- Explain that the PHP dev server depends on the locally installed extensions and how to enable them on Windows