# Laravel Starter Kit

## Installation

> Requires PHP 8.4+

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

## Git Hooks

Install project hooks:

```bash
sh install-git-hooks.sh
```

Installed hooks:

- `pre-commit` runs `composer format`
- `pre-push` runs `composer analyse`

If you use Fork and hooks misbehave, see [this issue](https://github.com/fork-dev/Tracker/issues/996).

## PhpStorm Setup (Optional)

Recommended setup for consistent formatting:

- `Settings | Editor | Code Style`: ensure "Enable EditorConfig support" is checked.
- `Settings | PHP | Quality Tools | Laravel Pint`: use ruleset from `pint.json`
- `Settings | PHP | Quality Tools`: set Laravel Pint as external formatter
- `Settings | Tools | Actions on Save`: enable reformat on save
- `Settings | Languages & Frameworks | JavaScript | Prettier`: use automatic config, enable "Run on save", and prefer Prettier config. Include `md` in Prettier file extensions.
