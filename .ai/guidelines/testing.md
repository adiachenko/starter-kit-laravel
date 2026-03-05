# Testing Guidelines

## Approach

Start with a failing test, then implement code to make it pass.

Avoid mocks unless the dependency is a network call, filesystem, or prohibitively slow. Prefer real instances.

## Test Suites

- `tests/Feature`: default. Test from the outside in by calling endpoints. Organize in subfolders by interface: `Web`, `Api`, `Mcp`, `Console`, etc.
- `tests/Unit`: tests for individual classes, mirroring `app/` namespaces. Strict isolation NOT required.
- `tests/External`: real interactions with external services (no mocking), organized by provider.

Unmocked external calls belong in `tests/External` only.

## File Naming

Always use `Test.php` suffix.

- **Unit**: mirror the class — `{ClassName}Test.php` (e.g. `UserTest.php`, `CreateUserJobTest.php`).
- **Feature**: mirror the controller action or command — `{ActionOrCommandName}Test.php` (e.g. `StoreUserTest.php`, `HealthcheckCommandTest.php`). One test file per controller action.
- **External**: descriptive names reflecting what's tested (e.g. `StripeWebhookTest.php`).

## Test Descriptions

Pattern: `<present-tense verb> <observable outcome> [when <condition>] [for <actor>]`

```php
test('returns validation errors when required registration fields are missing', function () {});
```

## Assertions

Prefer explicit, single-purpose assertions (one per line) over chained convenience helpers.

## Execution

Run the smallest scope that proves the change, expand when risk increases.

```bash
php artisan test --filter="hides sensitive attributes"
php artisan test tests/Unit/Models/UserTest.php
php artisan test --testsuite=Unit
```

## Verification

After changes, run `composer format` and `composer analyse` before finalizing.
