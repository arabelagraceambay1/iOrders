# iOrder

iOrder is a web-based pickup ordering and reservation system built with Laravel.

Current development status: around 55-60% complete (core workflow implemented, advanced modules intentionally left for Phase 2).

## Tech Stack

- Laravel 13 (PHP 8.3)
- Blade templates
- Vite + Tailwind CSS
- Role-based routing/middleware

## Implemented Features

### Customer Features

- User registration, login, logout
- Digital catalog browsing
- Virtual cart (add/update/remove/clear)
- Online order request for pickup
- Reservation/booking request
- Order and reservation status tracking
- Payment proof upload (manual receipt image)

### Admin Features

- Order monitoring and status updates
- Reservation monitoring and status updates
- Admin dashboard metrics (product count, low stock, pending orders/reservations)

### System-Level Features

- Admin dashboard with operational metrics
- Order approval/rejection via status updates
- Reservation management via status updates
- Inventory visibility through product stock and low-stock indicators

### System-Level Features

- Centralized database schema for users, products, orders, order items, reservations
- Role management: customer, admin
- Browser-accessible web interface

## Not Yet Implemented (Phase 2)

- In-app notification center for new orders/reservations
- Automated report generation (weekly/monthly PDF)
- Full system settings management panel
- True real-time push updates (WebSockets/events)
- Integrated online payment gateway
- Delivery tracking module
- Offline mode support

## Seeded Test Accounts

Use these seeded credentials after running database seeding:

- Admin: admin@iorder.test / password123
- Customer: customer@iorder.test / password123



## Notes

- Payment in this version is manual verification using uploaded proof.
- This version focuses on stable core flows with minimal bugs before adding advanced modules.
