# ringid Project

## Overview
This repository contains the codebase for the ringid platform, including:
- **admin/**: The admin backend, built with CodeIgniter (PHP MVC).
- **ringid.com/**: Main website content and configuration.
- **m.ringid.com/**: Mobile-optimized site or subdomain.
- **ringcoin/**: Mobile app (iOS .ipa, config, icon).

## Architecture & Data Flow

### Component Overview
- **Admin Backend (`admin/`)**: Handles all administrative functions, content management, and backend business logic. Built with CodeIgniter (PHP MVC).
- **Main Website (`ringid.com/`)**: Serves static and dynamic content to end-users. May act as a frontend for the admin backend or as a standalone site.
- **Mobile Site (`m.ringid.com/`)**: Optimized for mobile devices, may share content/config with the main website or have mobile-specific logic.
- **Mobile App (`ringcoin/`)**: Distributed as an iOS app (.ipa), may communicate with backend services via API if applicable.

### Data Flow
1. **User Request:**
   - User accesses the main website or mobile site via browser, or uses the mobile app.
2. **Frontend Interaction:**
   - The frontend (main website or mobile site) sends requests to the backend (admin/), typically via HTTP(S).
3. **Backend Processing:**
   - The admin backend processes requests, interacts with the database, and returns data or rendered views.
4. **API/Data Exchange:**
   - If the mobile app requires dynamic data, it communicates with the backend via RESTful APIs (future improvement suggestion).
5. **Response to User:**
   - The frontend receives data or rendered pages and displays them to the user.

## Directory Structure
```
ringid/
├── admin/           # Admin backend (CodeIgniter PHP app)
│   ├── application/   # MVC core: controllers, models, views, config, helpers, etc.
│   ├── images/
│   ├── scripts/
│   ├── styles/
│   ├── tools/
│   ├── index.php     # Entry point, CodeIgniter bootstrap
│   └── ...
├── ringid.com/      # Main website (static/dynamic content)
│   ├── config/
│   ├── content/
│   └── ...
├── m.ringid.com/    # Mobile site or mobile-specific content
│   ├── config/
│   ├── content/
│   └── ...
├── ringcoin/        # Mobile app (iOS .ipa, icon, config)
│   ├── ringCoin.ipa
│   ├── coin.plist
│   └── ...
└── .git/            # Version control
```

## Setup & Installation

### Prerequisites
- PHP 7.x or 8.x (for admin backend)
- Composer (recommended for dependency management)
- Web server (Apache/Nginx)
- MySQL or compatible database

### Getting Started
1. **Clone the repository:**
   ```
   git clone <repo-url>
   ```
2. **Configure your web server:**
   - Point your document root to the appropriate directory (e.g., `admin/` for backend).
   - Ensure `mod_rewrite` is enabled for CodeIgniter.
3. **Set up environment/config files:**
   - Copy sample config files from `admin/application/config/` and update as needed.
   - Store sensitive credentials in environment variables or a `.env` file (not committed).
4. **Install dependencies (if using Composer):**
   ```
   cd admin
   composer install
   ```
5. **Database setup:**
   - Import the initial schema if provided.
   - Update database credentials in the config.

## Development
- Follow MVC conventions for backend development in `admin/application/`.
- Modularize new features by creating dedicated subdirectories under `controllers`, `models`, and `views`.
- Write docblocks and add type hints where possible.
- Use PHPUnit for backend testing.

## Deployment
- Use Docker for consistent local and production environments (see `Dockerfile` if present).
- Set up CI/CD pipelines for automated testing and deployment.
- Exclude sensitive/config files using `.gitignore`.

## Security
- Never commit credentials or sensitive config to version control.
- Validate all user inputs and sanitize uploads.
- Restrict admin access and use HTTPS in production.

## Contributing
- Fork the repo and create feature branches for changes.
- Open pull requests with clear descriptions.
- Write or update tests for all new features.

## License
See `license.txt` for details.

---

For more information, contact the maintainers or refer to the documentation in each subdirectory.
