-- Query untuk soft delete penugasan_auditors yang user_id nya tidak ada di table users
-- Ini akan mengatasi error 500 di checkAuditActivities karena relationship yang broken

-- Langkah 1: Cek dulu berapa banyak data yang akan di-update
SELECT 'Data yang akan di-soft delete:' as info;
SELECT COUNT(*) as total_orphaned
FROM penugasan_auditors pa 
LEFT JOIN users u ON pa.user_id = u.id 
WHERE u.id IS NULL AND pa.user_id IS NOT NULL AND pa.deleted_at IS NULL;

-- Langkah 2: Lihat contoh data yang akan di-update
SELECT 'Contoh data orphaned (limit 5):' as info;
SELECT pa.id, pa.pengajuan_ami_id, pa.user_id, pa.role, pa.created_at
FROM penugasan_auditors pa 
LEFT JOIN users u ON pa.user_id = u.id 
WHERE u.id IS NULL AND pa.user_id IS NOT NULL AND pa.deleted_at IS NULL
LIMIT 5;

-- Langkah 3: Update deleted_at untuk semua penugasan yang user_id nya tidak ada
UPDATE penugasan_auditors pa 
LEFT JOIN users u ON pa.user_id = u.id 
SET pa.deleted_at = NOW(), 
    pa.updated_at = NOW()
WHERE u.id IS NULL AND pa.user_id IS NOT NULL AND pa.deleted_at IS NULL;

-- Langkah 4: Verifikasi hasil update
SELECT 'Verifikasi: Data yang masih orphaned setelah cleanup:' as info;
SELECT COUNT(*) as remaining_orphaned
FROM penugasan_auditors pa 
LEFT JOIN users u ON pa.user_id = u.id 
WHERE u.id IS NULL AND pa.user_id IS NOT NULL AND pa.deleted_at IS NULL;
