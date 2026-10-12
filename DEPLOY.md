# Deploying to Hostinger VPS (Docker Manager)

Docker Manager pulls public images; it cannot build from source. GitHub Actions builds the image
and publishes it to GitHub Container Registry (GHCR) on every push to `main`
(`.github/workflows/docker-publish.yml`).

Image: `ghcr.io/archyjackson9-cloud/eldsolutions:latest`

## 1. Publish the image
1. Push to `main`. Watch the run under the repo's **Actions** tab.
2. First time only: GitHub profile -> **Packages** -> `eldsolutions` -> **Package settings** ->
   **Change visibility -> Public**. (Docker Manager can't pull a private image.)

## 2. Create the project in Docker Manager
- Compose from URL: use the **raw file link** (not the `.git` address):
  `https://raw.githubusercontent.com/archyjackson9-cloud/elkems/main/docker-compose.yml`
  (A private repo's raw link won't work; make the repo public or paste the YAML instead.)
- Environment: copy the variables from `.env.docker.example`.
  `APP_IMAGE=ghcr.io/archyjackson9-cloud/eldsolutions:latest`
  Generate `APP_KEY` with `php artisan key:generate --show`.

## 3. First run
```bash
docker exec -it eldsolutions-app php artisan db:seed --force   # once; needs ADMIN_PASSWORD
```

## Updating
Push to `main`, wait for the Action to finish, then redeploy/pull in Docker Manager.
Migrations run automatically on start. For a pinned release, use the `:<commit-sha>` tag.

## Local build (optional)
```bash
docker compose -f docker-compose.yml -f docker-compose.build.yml build app
```
