# Laravel Starter Kit

## What's Different from the Official Laravel Starter

- PHP `>=8.4` baseline with `declare(strict_types=1)` enforced by Pint.
- The default boilerplate is lean and backend/API-friendly rather than frontend-scaffold-heavy.
- `AppServiceProvider` comes preconfigured with useful safeguards like immutable dates and stricter Eloquent.
- Models are unguarded by default because I trust my validation more than my memory to keep $fillable in sync.
- Tooling is already wired: Pest (parallel tests), PHPStan + Larastan at max level, and Rector for refactors.
- Better testing defaults with clear conventions and separate test suite for external dependencies.
- Laravel Boost is included during setup and appropriate .gitignore rules for it are supplied by default.
- SQLite is set as the default database, offering a clean, minimal starting point that you can easily customize for your preferred database setup.
- Formatting is consistent out of the box: Pint for PHP and Prettier for everything else.

## Installation

Create application (replace `example-app` with desired project name):

```bash
composer create-project adiachenko/starter-kit-laravel --prefer-dist example-app
```

> Keep in mind that `composer create-project` already does most of the setup for you. It will install dependencies, create .env file, generate app key, and prompt you to configure Laravel Boost.

Navigate to your project and complete the setup:

```bash
cd example-app

# Initialize git repo
git init
sh install-git-hooks.sh

# Optionally, scaffold API routes with Sanctum or Passport (add --passport flag)
php artisan install:api
```

Installed Git hooks:

- `pre-commit` runs `composer format`
- `pre-push` runs `composer analyse`

If you use [Fork](https://git-fork.com/) and hooks misbehave, see [this issue](https://github.com/fork-dev/Tracker/issues/996).

## Development Commands

| Command                  | Purpose                                               |
| ------------------------ | ----------------------------------------------------- |
| `composer test`          | Run the test suite (`pest --compact --parallel`).     |
| `composer test:external` | Run the external test suite (`--testsuite=External`). |
| `composer format`        | Run Laravel Pint and Prettier formatting.             |
| `composer analyse`       | Run static analysis (`phpstan`).                      |
| `composer refactor`      | Apply Rector refactors.                               |
| `composer coverage`      | Run tests with local coverage (`pest --coverage`).    |
| `composer coverage:herd` | Run coverage via Laravel Herd tooling.                |

## Additional Folders

Not strictly Laravel-official, but enforced as a common practice by the community:

- `app/Actions`: invokable classes for encapsulating business logic.
- `app/Enums`: self-explanatory.
- `app/Services`: for calling external services.

## Tests Structure and Conventions

The tests are organized into three test suites:

- `tests/Unit`: Focuses on individual classes that reflect the structure of the `app/` namespace. These tests target specific classes directly. While they focus on single classes, they are not strictly isolated. Feel free to work with a real database or trigger logic that calls other classes. For example, `Tests\Unit\Models\UserTest` should test the `User` model.
- `tests/Feature`: Covers broader application behavior from entry points such as HTTP endpoints, console commands, or message handlers. Tests here should mirror your communication interfaces. For example, `Tests\Feature\Http\StorePostTest` should call `StorePostController` or `store` method of `PostController`.
- `tests/External`: Interacts with real external services, organized by provider or domain (e.g., `Stripe`, `Ipinfo`, `Shippo`).

By default, running `composer test` executes the `Unit` and `Feature` suites. To run the external tests, use `composer test:external`.

Favor `Feature` tests for most scenarios. Select `Unit` tests when validating complex or critical individual classes, and use `External` tests when verifying integrations with third-party dependencies that cannot be mocked.

## PhpStorm Setup

Recommended setup for consistent formatting:

- `Settings | Editor | Code Style`: ensure "Enable EditorConfig support" is checked.
- `Settings | PHP | Quality Tools | Laravel Pint`: use ruleset from `pint.json`
- `Settings | PHP | Quality Tools`: set Laravel Pint as external formatter
- `Settings | Tools | Actions on Save`: enable reformat on save
- `Settings | Languages & Frameworks | JavaScript | Prettier`: use automatic config, enable "Run on save", and prefer Prettier config. Include `md` in Prettier file extensions.

## VSCode/Cursor Setup

VSCode and Cursor will automatically detect formatting settings defined in the `.vscode/` folder – no additional setup is needed beyond installing the suggested extensions.
