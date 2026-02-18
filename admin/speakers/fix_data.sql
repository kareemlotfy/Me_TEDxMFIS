-- SQL Fix Script for Speaker Management System
-- Run this to fix any existing data issues

-- 1. Check for problematic status values
SELECT 
    id, 
    full_name, 
    CONCAT('[', status, ']') as status_with_brackets,
    LENGTH(status) as status_length,
    CHAR_LENGTH(status) as status_char_length
FROM speakers
WHERE status != TRIM(status) 
   OR status = '' 
   OR status IS NULL
   OR status NOT IN ('draft', 'published', 'archived');

-- 2. Fix any whitespace in status column
UPDATE speakers 
SET status = TRIM(status) 
WHERE status != TRIM(status);

-- 3. Fix empty or null status values (set to draft)
UPDATE speakers 
SET status = 'draft' 
WHERE status = '' OR status IS NULL;

-- 4. Fix any invalid status values (set to draft)
UPDATE speakers 
SET status = 'draft' 
WHERE status NOT IN ('draft', 'published', 'archived');

-- 5. Verify all status values are now clean
SELECT 
    id,
    full_name,
    status,
    created_at,
    updated_at
FROM speakers
ORDER BY id;

-- 6. Check status distribution
SELECT 
    status,
    COUNT(*) as count
FROM speakers
GROUP BY status;

-- 7. Verify published_date is set for published speakers
SELECT 
    id,
    full_name,
    status,
    published_date,
    CASE 
        WHEN status = 'published' AND published_date IS NULL THEN 'NEEDS FIX'
        ELSE 'OK'
    END as check_status
FROM speakers
WHERE status = 'published';

-- 8. Fix missing published_date for published speakers
UPDATE speakers 
SET published_date = created_at 
WHERE status = 'published' 
  AND published_date IS NULL;

-- VERIFICATION QUERIES
-- Run these to confirm everything is fixed:

-- Should return 0 rows
SELECT * FROM speakers WHERE status IS NULL OR status = '';

-- Should only show 'draft', 'published', 'archived'
SELECT DISTINCT status FROM speakers;

-- Should show clean lengths (5, 9, or 8)
SELECT status, LENGTH(status), COUNT(*) 
FROM speakers 
GROUP BY status;
