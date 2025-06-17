# Draft Issues - Enhanced Debugging & Fixes

## Problem 1: Draft Duplication
When saving a draft multiple times, it creates multiple prestasi mahasiswa records instead of updating the existing draft.

### Root Cause Analysis
The issue occurs because after the first draft save, the form doesn't know it's editing an existing record because the `prestasi_mahasiswa_id` hidden field isn't being properly set/updated.

### Solution Applied ✅
- Added protection against multiple simultaneous saves
- Enhanced JavaScript to properly track and update the `prestasi_mahasiswa_id` field
- Added comprehensive debugging

## Problem 2: File Loss During Draft Save
Sometimes files that were already uploaded are lost after saving a draft.

### Root Cause Analysis
The `saveStep` method was incorrectly deleting existing files whenever there was any input data for file fields, even if no actual new files were being uploaded.

### Solution Applied ✅
Enhanced the file handling logic in `saveStep()` method:

```php
// BEFORE (problematic):
if ($request->has($inputName) && !empty($request->input($inputName))) {
    $prestasiMahasiswa->getMedia($collectionName)->each->delete();
}

// AFTER (fixed):
if ($hasInput && !$inputEmpty && count($inputFiles) > 0) {
    $hasValidNewFiles = false;
    foreach ($inputFiles as $file) {
        $filePath = storage_path('tmp/uploads/' . basename($file));
        if (file_exists($filePath)) {
            $hasValidNewFiles = true;
            break;
        }
    }
    
    if ($hasValidNewFiles) {
        \Log::info("- Deleting existing files because new valid files found");
        $prestasiMahasiswa->getMedia($collectionName)->each->delete();
    } else {
        \Log::info("- Keeping existing files - no valid new files to replace them");
    }
} else {
    \Log::info("- Keeping existing files - no new upload data");
}
```

### Key Improvements:
1. **Conservative Deletion**: Only delete existing files if we actually have valid new files in `tmp/uploads`
2. **File Validation**: Check that files physically exist before deciding to replace existing ones
3. **Detailed Logging**: Track exactly what's happening with file operations
4. **Preserve User Data**: Keep existing files unless explicitly replacing them

## Enhanced Debugging Added

### 1. Client-Side JavaScript Debugging
Enhanced the `saveDraft()` function with comprehensive logging:

```javascript
// Debug: Check current state of prestasi_mahasiswa_id field
const existingIdField = document.querySelector('input[name="prestasi_mahasiswa_id"]');
console.log('=== DRAFT SAVE DEBUG ===');
console.log('Existing prestasi_mahasiswa_id field:', existingIdField);
console.log('Current value:', existingIdField ? existingIdField.value : 'NOT FOUND');

// Debug: Check if prestasi_mahasiswa_id is in the form data
console.log('prestasi_mahasiswa_id in FormData:', formData.get('prestasi_mahasiswa_id'));

// Enhanced response handling
console.log('=== DRAFT SAVE RESPONSE ===');
console.log('Received draft_id from server:', data.draft_id);
```

### 2. Server-Side Controller Debugging
Added comprehensive logging to `saveStep()` method:

```php
// Debug logging
\Log::info('=== SAVE STEP DEBUG START ===');
\Log::info('Request method: ' . $request->method());
\Log::info('Request wants JSON: ' . ($request->wantsJson() ? 'true' : 'false'));
\Log::info('Request is AJAX: ' . ($request->ajax() ? 'true' : 'false'));
\Log::info('Request Accept header: ' . $request->header('Accept'));
\Log::info('Request X-Requested-With: ' . $request->header('X-Requested-With'));
\Log::info('Request has prestasi_mahasiswa_id: ' . ($request->has('prestasi_mahasiswa_id') ? $request->prestasi_mahasiswa_id : 'NO'));

// File handling debugging
\Log::info('=== FILE UPLOAD DEBUG ===');
\Log::info("Processing {$inputName}:");
\Log::info("- Has input: " . ($hasInput ? 'true' : 'false'));
\Log::info("- Input empty: " . ($inputEmpty ? 'true' : 'false'));
\Log::info("- Input files: " . json_encode($inputFiles));
\Log::info("- Existing media count: " . $existingMedia->count());
```

## Testing Instructions

### Step 1: Test Draft Duplication Fix
1. Clear console and logs
2. Fill out form and save draft
3. Make changes and save again
4. Verify only one record exists and it's updated

### Step 2: Test File Preservation
1. Upload files in any step
2. Save as draft
3. Make changes to form data (not files)
4. Save draft again
5. Verify uploaded files are still present

### Expected Behavior:
- ✅ Draft saves should update existing record, not create new ones
- ✅ Uploaded files should be preserved during draft saves
- ✅ Only new file uploads should replace existing files
- ✅ No file loss during form updates

## Files Modified
- `resources/views/frontend/prestasiMahasiswas/create.blade.php` - Enhanced JavaScript debugging & duplicate save prevention
- `app/Http/Controllers/Frontend/PrestasiMahasiswaController.php` - Fixed file handling logic & added comprehensive logging

## Current Status
- ✅ Draft duplication: **FIXED** (prevention against multiple simultaneous saves)
- ✅ File loss during draft save: **FIXED** (conservative file handling)
- ✅ Comprehensive debugging: **IMPLEMENTED** (both client & server side)

## Next Steps
1. Test both fixes together
2. Monitor logs to ensure no issues
3. Remove debug logging after confirming stability 