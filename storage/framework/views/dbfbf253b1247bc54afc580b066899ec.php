<?php $__env->startSection('title', 'Buat Project Baru'); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width:720px;margin:40px auto;padding:0 16px 60px">

    <div style="margin-bottom:28px">
        <h1 style="font-size:24px;font-weight:800">Buat Project Baru</h1>
        <p style="color:#888;font-size:14px;margin-top:4px">Bagikan karya terbaikmu ke komunitas</p>
    </div>

    <?php if($errors->any()): ?>
    <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i>
        <div><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><div><?php echo e($e); ?></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
    </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('projects.store')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        
        <div class="form-group">
            <label class="form-label">Judul Project *</label>
            <input type="text" name="title" class="form-control"
                   value="<?php echo e(old('title')); ?>" placeholder="Nama project kamu" required>
        </div>

        
        <div class="form-group">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control"
                      placeholder="Ceritakan tentang project ini..."><?php echo e(old('description')); ?></textarea>
        </div>

        
        <div class="form-group">
            <label class="form-label">Cover Image</label>

            
            <div style="display:flex;gap:0;margin-bottom:12px;border:1px solid #e0e0e0;border-radius:8px;overflow:hidden;width:fit-content">
                <button type="button" id="tab-upload" onclick="switchTab('upload')"
                    style="padding:8px 18px;font-size:13px;font-weight:600;border:none;cursor:pointer;background:#0057ff;color:#fff">
                    Upload File
                </button>
                <button type="button" id="tab-url" onclick="switchTab('url')"
                    style="padding:8px 18px;font-size:13px;font-weight:600;border:none;cursor:pointer;background:#fff;color:#333">
                    Dari URL
                </button>
            </div>

            
            <div id="panel-upload">
                <label id="drop-zone" style="display:flex;flex-direction:column;align-items:center;justify-content:center;border:2px dashed #e0e0e0;border-radius:10px;padding:40px 20px;cursor:pointer;transition:border-color .15s;background:#fafafa">
                    <i class="fas fa-cloud-upload-alt" style="font-size:32px;color:#ccc;margin-bottom:10px"></i>
                    <span style="font-size:14px;font-weight:600;color:#666">Klik atau drag & drop gambar di sini</span>
                    <span style="font-size:12px;color:#bbb;margin-top:4px">PNG, JPG, WEBP — maks 5MB</span>
                    <input type="file" name="cover_file" id="cover_file" accept="image/*"
                           style="display:none" onchange="previewFile(this)">
                </label>
                <div id="file-preview" style="display:none;margin-top:10px;position:relative">
                    <img id="file-preview-img" src="" alt="Preview"
                         style="width:100%;max-height:280px;object-fit:cover;border-radius:8px;border:1px solid #e0e0e0">
                    <button type="button" onclick="clearFile()"
                        style="position:absolute;top:8px;right:8px;background:#fff;border:1px solid #ddd;border-radius:50%;width:28px;height:28px;cursor:pointer;font-size:14px">
                        ✕
                    </button>
                </div>
            </div>

            
            <div id="panel-url" style="display:none">
                <input type="url" name="cover_image" id="cover_image_input" class="form-control"
                       value="<?php echo e(old('cover_image')); ?>"
                       placeholder="https://..."
                       oninput="previewUrl(this.value)">
                <p class="form-hint">Masukkan URL gambar untuk cover project</p>
                <div id="url-preview" style="display:none;margin-top:10px">
                    <img id="url-preview-img" src="" alt="Preview"
                         style="width:100%;max-height:280px;object-fit:cover;border-radius:8px;border:1px solid #e0e0e0">
                </div>
            </div>
        </div>

        
        <div class="form-group">
            <label class="form-label">Kategori / Creative Fields</label>
            <div style="display:flex;flex-wrap:wrap;gap:8px">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label style="display:flex;align-items:center;gap:6px;padding:6px 12px;border:1.5px solid #e0e0e0;border-radius:20px;cursor:pointer;font-size:13px;font-weight:600;transition:all .12s" class="cat-label">
                    <input type="checkbox" name="categories[]" value="<?php echo e($cat->id); ?>"
                           <?php echo e(in_array($cat->id, old('categories', [])) ? 'checked' : ''); ?>

                           style="display:none" onchange="toggleCatLabel(this)">
                    <?php echo e($cat->name); ?>

                </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        
        <div class="form-group">
            <label class="form-label">Tools yang Digunakan</label>
            <div style="display:flex;flex-wrap:wrap;gap:8px">
                <?php $__currentLoopData = ['Figma','Adobe XD','Photoshop','Illustrator','Blender','After Effects','Sketch','Procreate','Cinema 4D','InDesign','Lightroom','Premiere Pro']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label style="display:flex;align-items:center;gap:6px;padding:6px 12px;border:1.5px solid #e0e0e0;border-radius:20px;cursor:pointer;font-size:13px;font-weight:600;transition:all .12s" class="tool-label">
                    <input type="checkbox" name="tools[]" value="<?php echo e($tool); ?>"
                           <?php echo e(in_array($tool, old('tools', [])) ? 'checked' : ''); ?>

                           style="display:none" onchange="toggleToolLabel(this)">
                    <?php echo e($tool); ?>

                </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        
        <div class="form-group">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="published" <?php echo e(old('status') == 'published' ? 'selected' : ''); ?>>Published</option>
                <option value="draft"     <?php echo e(old('status') == 'draft'     ? 'selected' : ''); ?>>Draft</option>
            </select>
        </div>

        <div style="display:flex;gap:10px;margin-top:8px">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i> Publikasikan Project
            </button>
            <a href="<?php echo e(url()->previous()); ?>" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function switchTab(tab) {
    const isUpload = tab === 'upload';
    document.getElementById('panel-upload').style.display = isUpload ? 'block' : 'none';
    document.getElementById('panel-url').style.display   = isUpload ? 'none' : 'block';
    document.getElementById('tab-upload').style.background = isUpload ? '#0057ff' : '#fff';
    document.getElementById('tab-upload').style.color      = isUpload ? '#fff' : '#333';
    document.getElementById('tab-url').style.background    = isUpload ? '#fff' : '#0057ff';
    document.getElementById('tab-url').style.color         = isUpload ? '#333' : '#fff';
    if (!isUpload) { document.getElementById('cover_file').value = ''; clearFile(); }
    else { document.getElementById('cover_image_input').value = ''; }
}

document.getElementById('drop-zone').addEventListener('click', function() {
    document.getElementById('cover_file').click();
});

window.addEventListener('load', function() {
    const data = sessionStorage.getItem('quick_upload_data');
    const name = sessionStorage.getItem('quick_upload_name');
    const type = sessionStorage.getItem('quick_upload_type');
    if (data && name && type) {
        sessionStorage.removeItem('quick_upload_data');
        sessionStorage.removeItem('quick_upload_name');
        sessionStorage.removeItem('quick_upload_type');
        const arr = data.split(',');
        const mime = arr[0].match(/:(.*?);/)[1];
        const bstr = atob(arr[1]);
        let n = bstr.length, u8arr = new Uint8Array(n);
        while(n--){ u8arr[n] = bstr.charCodeAt(n); }
        const file = new File([u8arr], name, { type: mime });
        const dt = new DataTransfer();
        dt.items.add(file);
        document.getElementById('cover_file').files = dt.files;
        previewFile(document.getElementById('cover_file'));
        document.getElementById('cover_file').scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});
document.getElementById('drop-zone').addEventListener('dragover', function(e) {
    e.preventDefault(); this.style.borderColor = '#0057ff';
});
document.getElementById('drop-zone').addEventListener('dragleave', function() {
    this.style.borderColor = '#e0e0e0';
});
document.getElementById('drop-zone').addEventListener('drop', function(e) {
    e.preventDefault(); this.style.borderColor = '#e0e0e0';
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        const dt = new DataTransfer(); dt.items.add(file);
        document.getElementById('cover_file').files = dt.files;
        previewFile(document.getElementById('cover_file'));
    }
});

function previewFile(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('file-preview-img').src = e.target.result;
            document.getElementById('file-preview').style.display = 'block';
            document.getElementById('drop-zone').style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function clearFile() {
    document.getElementById('cover_file').value = '';
    document.getElementById('file-preview').style.display = 'none';
    document.getElementById('drop-zone').style.display = 'flex';
}

function previewUrl(url) {
    const preview = document.getElementById('url-preview');
    const img = document.getElementById('url-preview-img');
    if (url) { img.src = url; preview.style.display = 'block'; img.onerror = () => preview.style.display = 'none'; }
    else { preview.style.display = 'none'; }
}

function toggleCatLabel(input) {
    const label = input.closest('label');
    label.style.background   = input.checked ? '#0057ff' : '';
    label.style.color        = input.checked ? '#fff' : '';
    label.style.borderColor  = input.checked ? '#0057ff' : '#e0e0e0';
}
function toggleToolLabel(input) {
    const label = input.closest('label');
    label.style.background   = input.checked ? '#111' : '';
    label.style.color        = input.checked ? '#fff' : '';
    label.style.borderColor  = input.checked ? '#111' : '#e0e0e0';
}
document.querySelectorAll('.cat-label input:checked').forEach(toggleCatLabel);
document.querySelectorAll('.tool-label input:checked').forEach(toggleToolLabel);
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Semester2\SBD\behance_sbd\resources\views/projects/create.blade.php ENDPATH**/ ?>