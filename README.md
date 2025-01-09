## About the Template

This template is a starting point for a new Laravel application.

It is built on top of [Laravel Jetstream](https://github.com/laravel/jetstream) and includes the following tools pre-configured with sensible defaults:

- [RectorPHP](https://github.com/rectorphp/rector) for automatic refactoring
- [Larastan](https://github.com/nunomaduro/larastan) for static analysis
- [Pint](https://github.com/laravel/pint) for code formatting
- [PestPHP](https://pestphp.com) for testing
    - [Type Coverage Plugin](https://github.com/pestphp/pest-plugin-type-coverage) for type-safe testing
    - [Test Coverage](https://pestphp.com/docs/test-coverage)

By default, the composer commands are configured to 100% test and type coverage, and maximum strictness for Larastan.

You can run the tools with:

```bash
composer test       # for all tests, including Rector, Pint and Larastan dry runs

# `composer test` will run the tools in the following order:
composer test:refactor  # for RectorPHP dry run
composer test:lint  # for Pint dry run
composer test:type  # for PestPHP type coverage tests
composer test:static-analysis # for Larastan static analysis
composer test:unit  # for unit (and feature) tests with PestPHP

# also exposed as composer scripts:
composer lint       # for Pint code formatting
composer refactor   # for RectorPHP refactoring
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
