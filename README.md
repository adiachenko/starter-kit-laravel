# Laravel Starter Kit

## What's Different from the Official Laravel Starter

- PHP `>=8.4` baseline with `declare(strict_types=1)` enforced by Pint.
- The default boilerplate is lean and backend/API-friendly rather than frontend-scaffold-heavy.
- `AppServiceProvider` comes preconfigured with useful safeguards like immutable dates and stricter Eloquent.
- Models are unguarded by default because I trust my validation more than my memory to keep $fillable in sync.
- Tooling is already wired: Pest (parallel tests), PHPStan + Larastan at max level, and Rector for refactors.
- Formatting is consistent out of the box: Pint for PHP and Prettier for everything else.

## Installation

Create application (replace `example-app` with desired project name):

```bash
composer create-project adiachenko/starter-kit-laravel --prefer-dist example-app
```

Navigate to your project and complete the setup:

```bash
cd example-app

# Installs dependencies, create .env file, generate app key, run migrations
composer setup

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

| Command                  | Purpose                                            |
| ------------------------ | -------------------------------------------------- |
| `composer test`          | Run the test suite (`pest --compact --parallel`).  |
| `composer format`        | Run Laravel Pint and Prettier formatting.          |
| `composer analyse`       | Run static analysis (`phpstan`).                   |
| `composer refactor`      | Apply Rector refactors.                            |
| `composer coverage`      | Run tests with local coverage (`pest --coverage`). |
| `composer coverage:herd` | Run coverage via Laravel Herd tooling.             |

## PhpStorm Setup

Recommended setup for consistent formatting:

- `Settings | Editor | Code Style`: ensure "Enable EditorConfig support" is checked.
- `Settings | PHP | Quality Tools | Laravel Pint`: use ruleset from `pint.json`
- `Settings | PHP | Quality Tools`: set Laravel Pint as external formatter
- `Settings | Tools | Actions on Save`: enable reformat on save
- `Settings | Languages & Frameworks | JavaScript | Prettier`: use automatic config, enable "Run on save", and prefer Prettier config. Include `md` in Prettier file extensions.

## VSCode/Cursor Setup

All formatting settings for VSCode and Cursor are included under `.vscode/` folder and should be picked up automatiically by the editor as long as you install suggested extensions.
