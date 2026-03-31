# TMS Download 401 Error Fix - TODO Steps

## Plan Breakdown (Approved)

### Step 1: Verify Local Environment (COMPLETED)
- [x] storage:link exists (already created)
- [x] Route confirmed: trainee.materials.download ✓
- [x] No session_materials seeded (empty table expected)
- [x] Cloudinary config present, depends on .env vars

### Step 2: Code Improvements (COMPLETED)
- [x] Added logging to download method
- [x] Added Cloudinary fallback to local storage in upload
- [x] Fixed syntax errors, added use statements
- [x] Updated nixpacks.toml for prod deploy

### Step 2: Upload Test Material (Pending)
Create test material via trainer interface or seeder to test download path (Cloudinary vs local).

### Step 3: Code Improvements (Pending)
- Update SessionViewController::download with logging & better error handling
- Add fallback for missing Cloudinary
- Ensure prod-ready download logic

### Step 4: Production Deployment Fixes (Pending)
- Add Railway deploy script: storage:link, migrate, env vars
- Railway env vars: CLOUDINARY_URL etc.
- Update railway.json/nixpacks.toml

### Step 5: Testing
- Local full flow: enroll, trainer upload, trainee download
- Deploy & test on Railway

### Step 6: Complete
Use attempt_completion

**Next Action: Proceed to Step 2?**
