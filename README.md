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

## TODO
- [ ] Explain how to add a CSS framework
- [ ] Do it like React with a rotating logo :D
- [ ] Test what happens when just using root_url/api
- [ ] Make the document title dynamic
- [ ] Talk about tests somewhere
- [ ] Explain how to add more JS bundles