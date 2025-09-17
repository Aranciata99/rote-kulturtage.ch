# FTP Deployment Guide for Rote Kulturtage

## 1. Pre-Deployment Checklist

### Files to Upload
- ✅ `index.php`
- ✅ `assets/` (entire folder)
- ✅ `content/` (entire folder) 
- ✅ `kirby/` (entire folder)
- ✅ `site/` (entire folder)
- ✅ `vendor/` (entire folder)
- ✅ `media/` (if exists)
- ✅ `composer.json`
- ❌ `server.php` (local development only)
- ❌ `README.md` (optional)

### File Permissions (via FTP client or hosting panel)
```
site/storage/           → 755 (rwxr-xr-x)
site/cache/            → 755 (rwxr-xr-x) 
site/sessions/         → 755 (rwxr-xr-x)
media/                 → 755 (rwxr-xr-x)
```

## 2. Database Setup

**Good news: No setup required!**

- SQLite database creates automatically
- File location: `site/storage/crowdfunding.sqlite`
- No MySQL credentials needed
- No additional hosting costs

## 3. Webhook Configuration

### Update Payrexx Webhook URL
Change from: `https://3f254c056eb0.ngrok-free.app/api/payrexx-webhook`
To: `https://yourdomain.com/api/payrexx-webhook`

### Test Webhook
```bash
curl -X POST "https://yourdomain.com/api/payrexx-webhook" \
  -H "Content-Type: application/json" \
  -d '{"transaction":{"id":999,"status":"confirmed","amount":5000}}'
```

## 4. Security Considerations

### Protect Sensitive Directories
Add `.htaccess` files to:
- `site/storage/.htaccess`
- `site/cache/.htaccess` 
- `site/sessions/.htaccess`

Content for each `.htaccess`:
```apache
Order deny,allow
Deny from all
```

### Optional: Add Webhook Secret
In `site/config/config.php`:
```php
<?php
return [
  'debug' => false, // Set to false in production
  
  'crowdfunding' => [
    'webhook_secret' => 'your-secret-key-here', // Add this for security
  ]
];
```

## 5. Testing After Deployment

### 1. Test Website
- Visit: `https://yourdomain.com`
- Check crowdfunding page loads correctly

### 2. Test API Endpoints
- Campaign Status: `https://yourdomain.com/api/campaign-status`
- Should return JSON with current campaign data

### 3. Test Donation Flow
- Try making a test donation
- Check if amounts update correctly

## 6. Monitoring

### Check Database
Most FTP hosts provide file manager access where you can:
- View `site/storage/crowdfunding.sqlite` 
- Download for local inspection if needed

### Check Logs
- PHP errors usually logged in hosting control panel
- Webhook processing logged via `error_log()` calls

## 7. Backup Strategy

### Automated Backup (recommended)
- Database: `site/storage/crowdfunding.sqlite`
- Content: `content/` folder
- Media: `media/` folder

### Manual Backup
Download these folders regularly:
- `site/storage/`
- `content/`
- `media/`

## 8. Common Issues & Solutions

### Issue: Database Permission Error
**Solution:** Set `site/storage/` to 755 permissions

### Issue: Webhook Not Working
**Solution:** 
1. Check Payrexx webhook URL is correct
2. Test with curl command above
3. Check hosting provider allows incoming webhooks

### Issue: Campaign Status Not Loading
**Solution:**
1. Check `api/campaign-status` endpoint directly
2. Verify database file exists and has data
3. Check PHP error logs in hosting panel

## 9. Performance Optimization

### Enable Caching
In `site/config/config.php`:
```php
'cache' => [
  'pages' => [
    'active' => true,
    'type'   => 'file'
  ]
]
```

### Optimize Images
- Compress images in `assets/img/`
- Use appropriate formats (WebP if supported)

---

**Support:** If issues arise, check the database content and PHP error logs first.
