<?php $__env->startSection('title', 'Edit Project'); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width:720px;margin:40px auto;padding:0 16px 60px">

    <div style="margin-bottom:28px">
        <h1 style="font-size:24px;font-weight:800">Edit Project</h1>
        <p style="color:#888;font-size:14px;margin-top:4px"><?php echo e($project->title); ?></p>
    </div>

    <?php if($errors->any()): ?>
    <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i>
        <div>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div><?php echo e($e); ?></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('projects.update', $project->slug)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <div class="form-group">
            <label class="form-label">Judul Project *</label>
            <input type="text" name="title" class="form-control"
                   value="<?php echo e(old('title', $project->title)); ?>" required>
        </div>

        
        <div class="form-group">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control"><?php echo e(old('description', $project->description)); ?></textarea>
        </div>

        
        <div class="form-group">
            <label class="form-label">URL Cover Image</label>
            <input type="url" name="cover_image" id="cover_image_input" class="form-control"
                   value="<?php echo e(old('cover_image', $project->cover_image)); ?>"
                   placeholder="https://..."
                   oninput="previewCover(this.value)">
            <div id="cover-preview" style="margin-top:10px;<?php echo e($project->cover_image ? '' : 'display:none'); ?>">
                <img id="cover-img"
                     src="<?php echo e($project->cover_image); ?>"
                     alt="Preview"
                     style="width:100%;max-height:280px;object-fit:cover;border-radius:8px;border:1px solid #e0e0e0">
            </div>
        </div>

        
        <div class="form-group">
            <label class="form-label">Kategori / Creative Fields</label>
            <div style="display:flex;flex-wrap:wrap;gap:8px">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label style="display:flex;align-items:center;gap:6px;padding:6px 12px;border:1.5px solid #e0e0e0;border-radius:20px;cursor:pointer;font-size:13px;font-weight:600;transition:all .12s"
                       class="cat-label">
                    <input type="checkbox" name="categories[]" value="<?php echo e($cat->id); ?>"
                           <?php echo e(in_array($cat->id, old('categories', $selected)) ? 'checked' : ''); ?>

                           style="display:none" onchange="toggleCatLabel(this)">
                    <?php echo e($cat->name); ?>

                </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        
        <div class="form-group">
            <label class="form-label">Tools yang Digunakan</label>
            <?php
                $selectedTools = old('tools', json_decode($project->tools ?? '[]', true) ?? []);
            ?>
            <div style="display:flex;flex-wrap:wrap;gap:8px">
                <?php $__currentLoopData = ['Figma','Adobe XD','Photoshop','Illustrator','Blender','After Effects','Sketch','Procreate','Cinema 4D','InDesign','Lightroom','Premiere Pro']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label style="display:flex;align-items:center;gap:6px;padding:6px 12px;border:1.5px solid #e0e0e0;border-radius:20px;cursor:pointer;font-size:13px;font-weight:600;transition:all .12s"
                       class="tool-label">
                    <input type="checkbox" name="tools[]" value="<?php echo e($tool); ?>"
                           <?php echo e(in_array($tool, $selectedTools) ? 'checked' : ''); ?>

                           style="display:none" onchange="toggleToolLabel(this)">
                    <?php echo e($tool); ?>

                </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <p class="form-hint">Pilih tools yang kamu gunakan dalam project ini</p>
        </div>

        
        <div class="form-group">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="published" <?php echo e(old('status', $project->status) == 'published' ? 'selected' : ''); ?>>Published</option>
                <option value="draft"     <?php echo e(old('status', $project->status) == 'draft'     ? 'selected' : ''); ?>>Draft</option>
                <option value="archived"  <?php echo e(old('status', $project->status) == 'archived'  ? 'selected' : ''); ?>>Archived</option>
            </select>
        </div>

        <div style="display:flex;gap:10px;margin-top:8px">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
            <a href="<?php echo e(route('projects.show', $project->slug)); ?>" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function previewCover(url) {
    const preview = document.getElementById('cover-preview');
    const img = document.getElementById('cover-img');
    if (url) {
        img.src = url;
        preview.style.display = 'block';
        img.onerror = () => { preview.style.display = 'none'; };
    } else {
        preview.style.display = 'none';
    }
}

function toggleCatLabel(input) {
    const label = input.closest('label');
    if (input.checked) {
        label.style.background = '#0057ff';
        label.style.color = '#fff';
        label.style.borderColor = '#0057ff';
    } else {
        label.style.background = '';
        label.style.color = '';
        label.style.borderColor = '#e0e0e0';
    }
}

function toggleToolLabel(input) {
    const label = input.closest('label');
    if (input.checked) {
        label.style.background = '#111';
        label.style.color = '#fff';
        label.style.borderColor = '#111';
    } else {
        label.style.background = '';
        label.style.color = '';
        label.style.borderColor = '#e0e0e0';
    }
}

// Init state
document.querySelectorAll('.cat-label input:checked').forEach(toggleCatLabel);
document.querySelectorAll('.tool-label input:checked').forEach(toggleToolLabel);
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\behance_sbd\resources\views/projects/edit.blade.php ENDPATH**/ ?>