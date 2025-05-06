# Makefile for Monorepo: Install, Docker, Build, Deploy

.PHONY: install build docker deploy clean

# Install dependencies for backend, frontend, etc.
install:
	@if [ -f backend/requirements.txt ]; then \
		echo "Installing backend dependencies..."; \
		if command -v pip3 >/dev/null 2>&1; then \
			cd backend && pip3 install -r requirements.txt; \
		elif command -v pip >/dev/null 2>&1; then \
			cd backend && pip install -r requirements.txt; \
		else \
			echo 'Neither pip3 nor pip found. Please install Python and pip.'; \
			exit 1; \
		fi; \
	else \
		echo "No backend requirements.txt found."; \
	fi
	@if [ -f frontend/package.json ]; then \
		echo "Installing frontend dependencies..."; \
		cd frontend && npm install; \
	else \
		echo "No frontend package.json found."; \
	fi
	@if [ -f admin-panel/package.json ]; then \
		echo "Installing admin-panel dependencies..."; \
		cd admin-panel && npm install; \
	else \
		echo "No admin-panel package.json found."; \
	fi

# Build all components
build:
	@if [ -f frontend/package.json ]; then \
		echo "Building frontend..."; \
		cd frontend && npm run build; \
	else \
		echo "No frontend build script found."; \
	fi
	@if [ -f admin-panel/package.json ]; then \
		echo "Building admin-panel..."; \
		cd admin-panel && npm run build; \
	else \
		echo "No admin-panel build script found."; \
	fi

# Build Docker images using docker-compose
# Requires docker/docker-compose.yml to exist
# Usage: make docker

docker:
	@echo "Building Docker images..."
	@docker-compose -f docker/docker-compose.yml build

# Deploy (example: push Docker images, or trigger CI/CD)
deploy:
	@echo "Deploying application..."
	@# Insert your deployment commands here, e.g. docker-compose up -d or CI/CD trigger

# Clean build artifacts
clean:
	@if [ -f frontend/package.json ]; then \
		cd frontend && npm run clean || true; \
	fi
	@if [ -f admin-panel/package.json ]; then \
		cd admin-panel && npm run clean || true; \
	fi
	@if [ -d backend ]; then \
		cd backend && rm -rf __pycache__ *.pyc || true; \
	fi
