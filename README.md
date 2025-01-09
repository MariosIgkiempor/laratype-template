## About the Template

This template is a starting point for a new Laravel application.

It is built on top of [Laravel Jetstream](https://github.com/laravel/jetstream) and includes the following tools pre-configured with sensible defaults:

- [RectorPHP](https://github.com/rectorphp/rector) for automatic refactoring
- [Larastan](https://github.com/nunomaduro/larastan) for static analysis
- [Pint](https://github.com/laravel/pint) for code formatting
- [PestPHP](https://pestphp.com) for testing
    - [Type Coverage Plugin](https://github.com/pestphp/pest-plugin-type-coverage) for type-safe testing
    - [Test Coverage](https://pestphp.com/docs/test-coverage)
- [Prettier](https://prettier.io) for Blade file formatting
    - Configured per [this article](https://mattstauffer.com/blog/how-to-set-up-prettier-on-a-laravel-app-to-lint-tailwind-class-order-and-more/) to automatically format Tailwind CSS classes inside Blade files
    - Using [prettier-plugin-blade](https://www.npmjs.com/package/prettier-plugin-blade) and [prettier-plugin-tailwindcss](https://github.com/tailwindlabs/prettier-plugin-tailwindcss)

By default, the composer commands are configured to 100% test and type coverage, and maximum strictness for Larastan.

You can run the tools with:

```bash
composer test       # for all tests, including Rector, Pint and Larastan dry runs

# `composer test` will run the tools in the following order:
composer test:refactor  # RectorPHP dry run
composer test:lint      # Pint & Prettier dry run
composer test:type      # PestPHP type coverage tests
composer test:static-analysis # Larastan static analysis
composer test:unit      # PestPHP unit (and feature) tests

# also exposed as composer scripts:
composer lint             # Pint & Prettier code formatting
composer lint:php-file    # Pint code formatting
composer lint:blade-file  # Prettier code formatting
composer refactor         # RectorPHP refactoring
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
