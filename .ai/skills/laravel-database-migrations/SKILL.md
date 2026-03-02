---
name: laravel-database-migrations
description: "Apply these rules when creating or editing Laravel migrations, especially for foreign key delete behavior."
---

# Laravel Database Migrations

## Migrations

Define only the `up` method — omit `down` entirely, including default scaffolding.

Migrations are for schema changes only. Simple data manipulations tied to those changes (adjusting data for new columns/formats) are acceptable. Never seed application data or run business logic in migrations — use dedicated one-off console commands.

## Foreign Key Delete Policy

All foreign keys MUST explicitly declare `nullOnDelete`, `cascadeOnDelete`, or `restrictOnDelete`.

**Many-to-Many (pivot tables)**
Always `cascadeOnDelete()`.

**Owned children (composition)**
Child is inseparable from parent, no independent meaning → `cascadeOnDelete()`.

**Optional references (nullable FKs)**
Descriptive, attribution-based, or non-owning relationships → `nullOnDelete()`.
Applies to: `*_by`, `assigned_to`, `owner_id`, `parent_id` (default), `last_*_id`.

**Business-critical or historical records**
Financial, audit, security, legal, or historical data → `restrictOnDelete()` (or soft deletes).

**Shared or polymorphic resources**
Referenced by multiple parents → never `cascadeOnDelete()`.

**Tie-breaker**
Owned data → `cascadeOnDelete()`. References → `nullOnDelete()`. Use `restrictOnDelete()` only with a clear business reason.
