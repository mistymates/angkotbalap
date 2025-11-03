# TODO List for Angkot Balap Borrowing System

## 1. Database Migrations
- [ ] Modify users table to add role column
- [ ] Create profiles table migration
- [ ] Create categories table migration
- [ ] Create units table migration
- [ ] Create unit_category pivot table migration
- [ ] Create borrowings table migration
- [ ] Create borrowing_history table migration

## 2. Models
- [ ] Update User model (add role, relationships)
- [ ] Create Profile model
- [ ] Create Category model
- [ ] Create Unit model
- [ ] Create Borrowing model
- [ ] Create BorrowingHistory model

## 3. Middleware
- [ ] Create RoleMiddleware
- [ ] Register middleware in Kernel

## 4. Seeders
- [ ] Update DatabaseSeeder to create admin, users, profiles, categories, units

## 5. Controllers
- [ ] Create Admin\UserController (resource)
- [ ] Create Admin\CategoryController (resource)
- [ ] Create Admin\UnitController (resource)
- [ ] Create Admin\BorrowingController (resource)
- [ ] Create Admin\HistoryController (index)
- [ ] Create User\UnitController (index, show)
- [ ] Create User\BorrowingController (index, create, store)

## 6. Routes
- [ ] Add admin routes group
- [ ] Add user routes group
- [ ] Update web.php

## 7. Views
- [ ] Update dashboard.blade.php for role-based content
- [ ] Create admin views (users, categories, units, borrowings, history lists and forms)
- [ ] Create user views (unit list/search, borrow form, own borrowings)
- [ ] Update navigation for role-based links
- [ ] Add validation error displays

## 8. Requests (Validations)
- [ ] Create/Update request classes for forms with required validations

## 9. Testing
- [ ] Run php artisan migrate --seed
- [ ] Run php artisan serve
- [ ] Test login as admin and user
- [ ] Test borrowing, returning, fines
- [ ] Check validations

## 10. Fine System Enhancements
- [x] Create daily fine calculation command
- [x] Schedule fines:calculate command to run daily
- [x] Allow users to return units themselves
- [x] Add return functionality to user borrowing index view
- [x] Update routes for user return functionality
