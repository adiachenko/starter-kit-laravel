# Project Conventions

## General

- Prefer guard clauses and straight-line control flow; keep nesting shallow.
- Avoid boolean flags — prefer distinct methods or separate functions.
- Favor Laravel collection methods (map/filter/reduce) over loops; use loops only for early exits or stateful logic.
- MUST NOT use `final`.
- All class properties, method parameters, and return types MUST have type declarations.
- Use docblocks only to expand on complex types (arrays, collections) or when a description adds context beyond the signature.
- Prefer string interpolation over `sprintf()` or `.` concatenation. Use concatenation for multi-line or complex strings when it improves readability.

## Method Complexity

Methods should operate at a single level of abstraction — describe _what_ happens, not _how_. If a method exceeds ~20 lines of logic (excluding validation arrays and return statements), it likely mixes concerns.

**Signs a method needs extraction:**

- Nested closures or callbacks with their own branching
- Multiple try/catch blocks or catch-and-retry patterns
- Data formatting or transformation mixed with business logic
- Sequential steps that each deserve a descriptive name

## Exceptions: Centralize, Don't Scatter

- Let exceptions bubble to the global handler/middleware by default.
- Add `try/catch` only when it meaningfully changes behavior: a fallback path, retry, or converting to a domain exception. Never use it for routine control flow.
- Use `finally` only for guaranteed resource cleanup (locks, temp files, external handles).

## Laravel

- Use `laravel-database-migrations` skill for migration rules and foreign key delete policy.
- Seeders: simple and deterministic. Seed only initial data required for the app to function — no appending, upserting, or complex logic.
- Polymorphic associations MUST define a morph map in the service provider's `boot()` method.
- Form request validation: always use array syntax for rules, not `|`-delimited strings.
- Models are unguarded by default. Only pass validated data or an explicit field allowlist to `create()`, `update()`, `fill()`.
- Read `config()` inline at call sites with explicit defaults — no pass-through wrappers.
- No inline route callbacks — use controllers.

## Controllers

Invokable `VerbNounController` (e.g. `StorePostController`). Avoid noun-first names like `PostController`.

## Naming Conventions

Omit Abstract/Interface/Contract/Trait from class names.

Treat acronyms as words (`HttpClient`, not `HTTPClient`). Exception: two-letter acronyms (`ID`, `UI`).

Booleans: prefix with `is`, `has`, `can`, `should`.

- **Actions**: `VerbNounAction`, e.g. `CreateOrderAction`, `SendInvitationAction`.
- **Commands**: Mirror the `app:` Artisan signature, kebab-case multi-word, e.g. `app:inventory:flush-records` → `Inventory\FlushRecordsCommand`.
- **Data**: `NounData`, e.g. `OrderData`, `UserProfileData`.
- **Enums**: No prefix/suffix, e.g. `OrderStatus`, `SubscriptionType`.
- **Events**: Tense conveys timing — progressive before (`RequestSending`), past after (`Registered`).
- **Facades**: Singular nouns, no suffix, e.g. `Inventory`, `Geocoder`.
- **Jobs**: Action + `Job` suffix, e.g. `CreateUserJob`, `PerformDatabaseCleanupJob`.
- **Listeners**: Action + `Listener` suffix, e.g. `SendInvitationMailListener`.
- **Mailables**: Noun + `Mail` suffix, e.g. `OrderConfirmationMail`.
- **Notifications**: Past tense + `Notification` suffix, e.g. `EmployeeAccountCreatedNotification`.
- **Services**: External service name + `Service`, e.g. `StripeService`.
