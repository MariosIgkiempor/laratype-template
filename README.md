## About the Template

A Laravel application template focusing on 100% test & type coverage, and maximum static analysis.

It is built on top of [Laravel Jetstream](https://github.com/laravel/jetstream) and includes the following tools pre-configured with sensible (strict) defaults:

- [RectorPHP](https://github.com/rectorphp/rector) for automatic refactoring
- [Larastan](https://github.com/nunomaduro/larastan) for static analysis
- [Pint](https://github.com/laravel/pint) for code formatting
- [PestPHP](https://pestphp.com) for testing
    - [Type Coverage Plugin](https://github.com/pestphp/pest-plugin-type-coverage) for type-safe testing
    - [Test Coverage](https://pestphp.com/docs/test-coverage)
- [Prettier](https://prettier.io) for Blade file formatting
    - Configured per [this article](https://mattstauffer.com/blog/how-to-set-up-prettier-on-a-laravel-app-to-lint-tailwind-class-order-and-more/) to automatically format Tailwind CSS classes inside Blade files
    - Using [prettier-plugin-blade](https://www.npmjs.com/package/prettier-plugin-blade) and [prettier-plugin-tailwindcss](https://github.com/tailwindlabs/prettier-plugin-tailwindcss)

## Getting Started

```bash
cp .env.example .env
```

Update the `.env` file with your `APP_NAME`, `APP_URL`, local database credentials.
Feel free to change any other variables to fit your local environment needs.

```bash
composer install
npm install && npm run build
touch database/database.sqlite
php artisan key:generate
php artisan migrate
composer refactor
vendor/bin/pest --update-snapshots
```

> [!WARNING]
> Rector may complain when you `composer install` or `composer require` because these commands can overwrite files in your `/bootstrap` directory.
> Simply run `composer refactor` to make Rector happy 👼

At this point, you can start the development server with `composer dev`.

You can run `composer test`, which should yield a passing test suite, with 100% test and type coverage.

## Tools

Tools are exposed as [Composer](https://getcomposer.org/) scripts.

```bash
composer test                 # @test:refactor && @test:lint
                              # && @test:types && @test:static-analysis && @test:unit

# `composer test` will run the tools in the following order:
composer test:refactor        # rector --dry-run
composer test:lint            # pint --test && prettier --check resources/
composer test:type            # pest --type-coverage --colors=always --memory-limit=512M --min=100
composer test:static-analysis # phpstan analyse --ansi --memory-limit=512M
composer test:unit            # pest --colors=always --coverage --parallel --min=100

# Tools are also individually exposed as separate scripts:
composer lint                 # pint && prettier --write resources/
composer lint:php <file>      # pint <file>
composer lint:blade <file>    # prettier --write <file>
composer refactor             # rector
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
