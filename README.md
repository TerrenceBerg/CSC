# 976-Tuna Country Importer Package

A Laravel package for importing **countries, states, and cities** along with their ZIP codes and geographic coordinates.

## 🚀 Features
- Imports **countries** with ISO codes and phone codes.
- Imports **states** associated with their respective countries.
- Imports **cities** with ZIP codes.
- Reads data from a **JSON file** and saves it to the database.

---

## 📦 Installation

### 1️⃣ Install the Package (if private, use your package repository)
```bash
composer require 976-tuna/csc

php artisan migrate

php artisan country-importer:import
