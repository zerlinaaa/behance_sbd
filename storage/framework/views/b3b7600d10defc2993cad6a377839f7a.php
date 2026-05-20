
<?php $__env->startSection('title', $user->name); ?>

<?php $__env->startPush('styles'); ?>
<style>
.p-banner { width:100%;height:200px;background:#2d3748;position:relative;overflow:hidden;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.07);font-size:0;user-select:none; }
.p-wrap { max-width:1100px;margin:0 auto;padding:0 24px 80px;display:flex;gap:40px;align-items:flex-start; }
.p-sidebar { width:260px;flex-shrink:0;margin-top:-40px;position:relative; }
.p-main { flex:1;min-width:0;padding-top:16px; }

/* Avatar */
.p-avatar-wrap { position:relative;width:120px;margin-bottom:16px; }
.p-avatar { width:120px;height:120px;border-radius:50%;border:4px solid #fff;object-fit:cover;display:block;box-shadow:0 2px 12px rgba(0,0,0,.15);background:#eee; }
.p-avatar-initial { width:120px;height:120px;border-radius:50%;border:4px solid #fff;box-shadow:0 2px 12px rgba(0,0,0,.15);background:#e0e0e0;display:flex;align-items:center;justify-content:center;font-size:44px;font-weight:800;color:#999; }
.p-avatar-edit { position:absolute;inset:0;border-radius:50%;background:rgba(0,0,0,0.5);display:flex;flex-direction:column;align-items:center;justify-content:center;opacity:0;transition:opacity .2s;cursor:pointer;gap:4px;border:4px solid #fff; }
.p-avatar-wrap:hover .p-avatar-edit { opacity:1; }
.p-avatar-edit span { color:#fff;font-size:11px;font-weight:700; }
.p-avatar-edit i { color:#fff;font-size:18px; }

.p-name { font-size:22px;font-weight:800;color:#111;margin-bottom:2px;line-height:1.2; }
.p-location { font-size:13px;color:#666;margin-bottom:16px;display:flex;align-items:center;gap:6px; }
.p-avail { display:inline-flex;align-items:center;gap:5px;font-size:12px;font-weight:700;color:#27ae60;margin-bottom:12px; }
.p-avail-dot { width:7px;height:7px;border-radius:50%;background:#27ae60; }

.p-btn { display:block;width:100%;padding:11px;border-radius:6px;font-size:14px;font-weight:700;cursor:pointer;font-family:inherit;text-align:center;transition:all .15s;margin-bottom:10px;text-decoration:none; }
.p-btn-blue { background:#0057ff;color:#fff;border:none; }
.p-btn-blue:hover { background:#0041cc;color:#fff; }
.p-btn-outline { background:#fff;color:#333;border:1.5px solid #ddd; }
.p-btn-outline:hover { border-color:#333; }
.p-btn-follow { background:#fff;color:#333;border:1.5px solid #ddd; }
.p-btn-follow:hover { border-color:#0057ff;color:#0057ff; }
.p-btn-follow.following { background:#0057ff;color:#fff;border-color:#0057ff; }

.p-stats { display:flex;flex-direction:column;gap:0;border-top:1px solid #eee;margin-top:20px;padding-top:16px; }
.p-stat-row { display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid #f5f5f5;font-size:13px; }
.p-stat-label { color:#888; }
.p-stat-val { font-weight:700;color:#111; }

.p-bio { font-size:13px;color:#555;line-height:1.7;margin-top:16px;padding-top:16px;border-top:1px solid #eee; }
.p-member { font-size:11px;color:#bbb;font-weight:700;text-transform:uppercase;letter-spacing:.5px;margin-top:20px;padding-top:16px;border-top:1px solid #eee; }

/* Tabs */
.p-tabs { display:flex;gap:0;border-bottom:1px solid #eee;margin-bottom:28px; }
.p-tab { padding:14px 18px;font-size:14px;font-weight:600;color:#999;border-bottom:2px solid transparent;cursor:pointer;transition:all .15s;text-decoration:none;white-space:nowrap;background:none;border-top:none;border-left:none;border-right:none;font-family:inherit; }
.p-tab.active { color:#111;border-bottom-color:#111; }
.p-tab:hover { color:#333; }
.p-tab-sep { width:1px;background:#eee;margin:10px 8px; }

/* Tab panels */
.p-panel { display:none; }
.p-panel.active { display:block; }

/* Grid */
.p-grid { display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:16px; }
.p-card { display:block;border-radius:8px;overflow:hidden;text-decoration:none;color:inherit;background:#fff;box-shadow:0 1px 6px rgba(0,0,0,.08);transition:transform .2s,box-shadow .2s; }
.p-card:hover { transform:translateY(-3px);box-shadow:0 6px 20px rgba(0,0,0,.12); }
.p-card-img { width:100%;aspect-ratio:4/3;object-fit:cover;display:block; }
.p-card-body { padding:12px 14px; }
.p-card-title { font-weight:700;font-size:13px;margin-bottom:6px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;color:#111; }
.p-card-meta { display:flex;gap:12px;color:#bbb;font-size:12px;font-weight:600; }
.p-card-sub { font-size:11px;color:#aaa;margin-top:2px; }

/* Draft badge */
.draft-badge { display:inline-block;background:#f39c12;color:#fff;font-size:10px;font-weight:700;padding:2px 7px;border-radius:4px;margin-left:6px;vertical-align:middle; }

/* Empty */
.p-empty { border:2px dashed #eee;border-radius:10px;padding:60px 20px;text-align:center;color:#ccc; }
.p-empty-plus { width:56px;height:56px;border-radius:50%;background:#e8f0ff;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:24px;color:#0057ff; }
.p-empty p { font-size:14px;color:#aaa;margin-bottom:4px; }
.p-empty small { font-size:12px;color:#ccc; }

/* Stats panel */
.stats-grid { display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:16px;margin-bottom:28px; }
.stat-card { background:#fff;border:1px solid #eee;border-radius:10px;padding:20px;text-align:center; }
.stat-card .stat-num { font-size:28px;font-weight:900;color:#0057ff;line-height:1; }
.stat-card .stat-lbl { font-size:12px;color:#aaa;margin-top:6px;font-weight:600;text-transform:uppercase;letter-spacing:.5px; }

/* Modal */
.modal-overlay { display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:1000;align-items:center;justify-content:center; }
.modal-overlay.open { display:flex; }
.modal-box { background:#fff;border-radius:12px;padding:32px;width:100%;max-width:440px;box-shadow:0 20px 60px rgba(0,0,0,0.2);position:relative; }
.modal-title { font-size:20px;font-weight:800;margin-bottom:24px;color:#111; }
.modal-close { position:absolute;top:16px;right:16px;background:none;border:none;font-size:20px;color:#999;cursor:pointer;line-height:1; }
.modal-close:hover { color:#111; }
.form-row { margin-bottom:16px; }
.form-row label { display:block;font-size:13px;font-weight:700;color:#555;margin-bottom:6px; }
.form-row input, .form-row textarea, .form-row select {
    width:100%;padding:10px 12px;border:1.5px solid #ddd;border-radius:6px;font-size:14px;font-family:inherit;outline:none;transition:border-color .15s;box-sizing:border-box;
}
.form-row input:focus, .form-row textarea:focus { border-color:#0057ff; }
.form-row textarea { min-height:90px;resize:vertical; }
.form-row-2 { display:grid;grid-template-columns:1fr 1fr;gap:12px; }
.btn-submit { background:#0057ff;color:#fff;border:none;border-radius:6px;padding:12px 24px;font-size:14px;font-weight:700;cursor:pointer;width:100%;font-family:inherit;transition:background .15s; }
.btn-submit:hover { background:#0041cc; }

/* Avatar/Banner modal section */
.avatar-actions { display:flex;gap:10px;margin-top:16px; }
.avatar-actions label, .avatar-actions button {
    flex:1;padding:10px;border-radius:6px;font-size:13px;font-weight:700;cursor:pointer;text-align:center;font-family:inherit;border:1.5px solid #ddd;background:#fff;color:#333;transition:all .15s;display:flex;align-items:center;justify-content:center;gap:6px;
}
.avatar-actions label:hover { border-color:#0057ff;color:#0057ff; }
.avatar-actions .btn-remove-av { color:#e74c3c;border-color:#e74c3c; }
.avatar-actions .btn-remove-av:hover { background:#e74c3c;color:#fff; }
.avatar-preview-wrap { text-align:center;margin-bottom:8px; }
.avatar-preview-wrap img { width:90px;height:90px;border-radius:50%;object-fit:cover;border:3px solid #eee; }
.avatar-preview-initial { width:90px;height:90px;border-radius:50%;background:#e0e0e0;display:flex;align-items:center;justify-content:center;font-size:32px;font-weight:800;color:#999;margin:0 auto; }

/* Alert */
.alert-success { background:#d4edda;color:#155724;padding:12px 16px;border-radius:6px;margin-bottom:20px;font-size:14px;font-weight:600; }

@media(max-width:768px){
    .p-wrap{flex-direction:column;}
    .p-sidebar{width:100%;margin-top:-40px;}
    .p-tabs{overflow-x:auto;}
    .p-grid{grid-template-columns:1fr 1fr;}
    .form-row-2{grid-template-columns:1fr;}
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<?php if(session('success')): ?>
<div style="max-width:1100px;margin:16px auto;padding:0 24px">
    <div class="alert-success"><i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?></div>
</div>
<?php endif; ?>


<?php if(auth()->guard()->check()): ?>
<?php if(auth()->id() === $user->id): ?>
<form id="banner-upload-form" method="POST" action="<?php echo e(route('profile.updateBanner')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <input type="file" name="banner" id="banner-file-input" accept="image/*" style="display:none" onchange="previewAndSubmitBanner(this)">
</form>
<form id="banner-remove-form2" method="POST" action="<?php echo e(route('profile.removeBanner')); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
</form>
<div class="p-banner" onclick="openBannerModal()" style="cursor:pointer;flex-direction:column;gap:8px;color:rgba(255,255,255,0.6);font-size:14px;<?php echo e(!empty($user->banner) ? 'background-image:url('.asset($user->banner).');background-size:cover;background-position:center;' : ''); ?>">
    <?php if(empty($user->banner)): ?>
    <i class="fas fa-camera" style="font-size:28px"></i>
    <span style="font-weight:600">Add a Banner Image</span>
    <span style="font-size:11px;opacity:.7">Optimal dimensions 3200 x 410px</span>
    <?php endif; ?>
</div>
<?php else: ?>
<div class="p-banner" style="font-size:0;<?php echo e(!empty($user->banner) ? 'background-image:url('.asset($user->banner).');background-size:cover;background-position:center;' : ''); ?>"></div>
<?php endif; ?>
<?php endif; ?>
<?php if(auth()->guard()->guest()): ?>
<div class="p-banner" style="font-size:0;<?php echo e(!empty($user->banner) ? 'background-image:url('.asset($user->banner).');background-size:cover;background-position:center;' : ''); ?>"></div>
<?php endif; ?>

<div class="p-wrap">

    
    <div class="p-sidebar">

        
        <?php if(auth()->guard()->check()): ?>
        <?php if(auth()->id() === $user->id): ?>
        <div class="p-avatar-wrap" onclick="openAvatarModal()" style="cursor:pointer">
            <?php if(!empty($user->avatar)): ?>
            <img src="<?php echo e(asset($user->avatar)); ?>" alt="<?php echo e($user->name); ?>" class="p-avatar">
            <?php else: ?>
            <div class="p-avatar-initial"><?php echo e(strtoupper(substr($user->name, 0, 1))); ?></div>
            <?php endif; ?>
            <div class="p-avatar-edit" title="Change Photo">
                <i class="fas fa-camera"></i>
                <span>Change Photo</span>
            </div>
        </div>
        <?php else: ?>
        <div class="p-avatar-wrap" style="pointer-events:none">
            <?php if(!empty($user->avatar)): ?>
            <img src="<?php echo e(asset($user->avatar)); ?>" alt="<?php echo e($user->name); ?>" class="p-avatar">
            <?php else: ?>
            <div class="p-avatar-initial"><?php echo e(strtoupper(substr($user->name, 0, 1))); ?></div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php else: ?>
        <div class="p-avatar-wrap" style="pointer-events:none">
            <?php if(!empty($user->avatar)): ?>
            <img src="<?php echo e(asset($user->avatar)); ?>" alt="<?php echo e($user->name); ?>" class="p-avatar">
            <?php else: ?>
            <div class="p-avatar-initial"><?php echo e(strtoupper(substr($user->name, 0, 1))); ?></div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="p-name"><?php echo e($user->name); ?></div>

        <?php if(!empty($user->availability) && $user->availability !== 'not_available'): ?>
        <div class="p-avail"><div class="p-avail-dot"></div><?php echo e(ucfirst(str_replace('_', ' ', $user->availability))); ?></div>
        <?php endif; ?>

        <?php if(!empty($user->location)): ?>
        <div class="p-location"><i class="fas fa-globe" style="color:#bbb;font-size:12px"></i><?php echo e($user->location); ?></div>
        <?php endif; ?>

        <?php if(auth()->guard()->check()): ?>
            <?php if(auth()->id() === $user->id): ?>
            <button onclick="openEditModal()" class="p-btn p-btn-outline" style="cursor:pointer">Edit Profile Info</button>
            <?php else: ?>
            <button onclick="toggleFollowProfile(<?php echo e($user->id); ?>, this)"
                class="p-btn p-btn-follow <?php echo e($isFollowing ? 'following' : ''); ?>">
                <?php echo e($isFollowing ? 'Following' : '+ Follow'); ?>

            </button>
            <a href="#" class="p-btn p-btn-outline"><i class="fas fa-briefcase" style="margin-right:4px"></i>Hire</a>
            <?php endif; ?>
        <?php else: ?>
        <a href="<?php echo e(route('login')); ?>" class="p-btn p-btn-follow">+ Follow</a>
        <?php endif; ?>

        <div class="p-stats">
            <div class="p-stat-row"><span class="p-stat-label">Projects</span><span class="p-stat-val"><?php echo e($projects->count()); ?></span></div>
            <div class="p-stat-row"><span class="p-stat-label">Followers</span><span class="p-stat-val"><?php echo e(number_format($user->followers_count ?? 0)); ?></span></div>
            <div class="p-stat-row"><span class="p-stat-label">Following</span><span class="p-stat-val"><?php echo e(number_format($user->following_count ?? 0)); ?></span></div>
            <div class="p-stat-row"><span class="p-stat-label">Appreciations</span><span class="p-stat-val"><?php echo e(number_format($projects->sum('likes_count'))); ?></span></div>
            <div class="p-stat-row"><span class="p-stat-label">Views</span><span class="p-stat-val"><?php echo e(number_format($projects->sum('views_count'))); ?></span></div>
        </div>

        <?php if(!empty($user->bio)): ?>
        <div class="p-bio"><?php echo e($user->bio); ?></div>
        <?php endif; ?>

        <?php if(!empty($user->created_at)): ?>
        <div class="p-member">Member since: <?php echo e(\Carbon\Carbon::parse($user->created_at)->format('F j, Y')); ?></div>
        <?php endif; ?>
    </div>

    
    <div class="p-main">
        <div class="p-tabs">
            <button class="p-tab active" onclick="switchTab('work', this)">Work</button>
            <button class="p-tab" onclick="switchTab('appreciations', this)">Appreciations</button>
            <div class="p-tab-sep"></div>
            <?php if(auth()->guard()->check()): ?> <?php if(auth()->id() === $user->id): ?>
            <button class="p-tab" onclick="switchTab('stats', this)">Your Stats</button>
            <button class="p-tab" onclick="switchTab('drafts', this)">Drafts</button>
            <?php endif; ?> <?php endif; ?>
        </div>

        
        <div id="panel-work" class="p-panel active">
            <?php if($projects->isEmpty()): ?>
            <div class="p-empty">
                <div class="p-empty-plus"><i class="fas fa-plus"></i></div>
                <p>Create a Project</p>
                <small>Get feedback, views, and appreciations.</small>
                <?php if(auth()->guard()->check()): ?> <?php if(auth()->id() === $user->id): ?>
                <br><br>
                <button onclick="quickUpload()" class="p-btn p-btn-blue" style="display:inline-block;width:auto;padding:10px 24px">Create a Project</button>
                <?php endif; ?> <?php endif; ?>
            </div>
            <?php else: ?>
            <div class="p-grid">
                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('projects.show', $project->slug)); ?>" class="p-card">
                    <img src="<?php echo e($project->cover_image ? (str_starts_with($project->cover_image, '/') ? asset($project->cover_image) : $project->cover_image) : 'https://picsum.photos/seed/'.$project->id.'/400/300'); ?>"
                         alt="<?php echo e($project->title); ?>" class="p-card-img"
                         onerror="this.src='https://picsum.photos/seed/<?php echo e($project->id); ?>/400/300'">
                    <div class="p-card-body">
                        <div class="p-card-title"><?php echo e($project->title); ?></div>
                        <div class="p-card-meta">
                            <span><i class="fas fa-heart" style="color:#e74c3c"></i> <?php echo e(number_format($project->likes_count)); ?></span>
                            <span><i class="fas fa-eye"></i> <?php echo e(number_format($project->views_count)); ?></span>
                        </div>
                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
        </div>

        
        <div id="panel-appreciations" class="p-panel">
            <?php if($appreciations->isEmpty()): ?>
            <div class="p-empty">
                <div class="p-empty-plus"><i class="fas fa-heart"></i></div>
                <p>No Appreciations Yet</p>
                <small>Projects you like will appear here.</small>
            </div>
            <?php else: ?>
            <div class="p-grid">
                <?php $__currentLoopData = $appreciations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('projects.show', $project->slug)); ?>" class="p-card">
                    <img src="<?php echo e($project->cover_image ? (str_starts_with($project->cover_image, '/') ? asset($project->cover_image) : $project->cover_image) : 'https://picsum.photos/seed/'.$project->id.'/400/300'); ?>"
                         alt="<?php echo e($project->title); ?>" class="p-card-img"
                         onerror="this.src='https://picsum.photos/seed/<?php echo e($project->id); ?>/400/300'">
                    <div class="p-card-body">
                        <div class="p-card-title"><?php echo e($project->title); ?></div>
                        <div class="p-card-sub">by <?php echo e($project->creator_name); ?></div>
                        <div class="p-card-meta">
                            <span><i class="fas fa-heart" style="color:#e74c3c"></i> <?php echo e(number_format($project->likes_count)); ?></span>
                            <span><i class="fas fa-eye"></i> <?php echo e(number_format($project->views_count)); ?></span>
                        </div>
                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
        </div>

        <?php if(auth()->guard()->check()): ?> <?php if(auth()->id() === $user->id): ?>

        
        <div id="panel-stats" class="p-panel">
            <?php if($stats): ?>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-num"><?php echo e(number_format($stats->total_projects)); ?></div>
                    <div class="stat-lbl">Total Projects</div>
                </div>
                <div class="stat-card">
                    <div class="stat-num"><?php echo e(number_format($stats->total_likes)); ?></div>
                    <div class="stat-lbl">Total Likes</div>
                </div>
                <div class="stat-card">
                    <div class="stat-num"><?php echo e(number_format($stats->total_views)); ?></div>
                    <div class="stat-lbl">Total Views</div>
                </div>
                <div class="stat-card">
                    <div class="stat-num"><?php echo e(number_format($stats->followers_count)); ?></div>
                    <div class="stat-lbl">Followers</div>
                </div>
                <div class="stat-card">
                    <div class="stat-num"><?php echo e(number_format($stats->total_comments_received)); ?></div>
                    <div class="stat-lbl">Comments Received</div>
                </div>
                <div class="stat-card">
                    <div class="stat-num"><?php echo e(number_format($stats->total_bookmarks_received)); ?></div>
                    <div class="stat-lbl">Bookmarks</div>
                </div>
                <div class="stat-card">
                    <div class="stat-num"><?php echo e($stats->engagement_rate); ?>%</div>
                    <div class="stat-lbl">Engagement Rate</div>
                </div>
                <div class="stat-card">
                    <div class="stat-num"><?php echo e(number_format($stats->best_project_likes)); ?></div>
                    <div class="stat-lbl">Best Project Likes</div>
                </div>
            </div>
            <?php if($stats->last_posted_at): ?>
            <p style="color:#aaa;font-size:13px">Last posted: <?php echo e(\Carbon\Carbon::parse($stats->last_posted_at)->diffForHumans()); ?></p>
            <?php endif; ?>
            <?php else: ?>
            <div class="p-empty">
                <div class="p-empty-plus"><i class="fas fa-chart-bar"></i></div>
                <p>No stats yet</p>
                <small>Upload your first project to see stats.</small>
            </div>
            <?php endif; ?>
        </div>

        
        <div id="panel-drafts" class="p-panel">
            <?php if($drafts->isEmpty()): ?>
            <div class="p-empty">
                <div class="p-empty-plus"><i class="fas fa-file-alt"></i></div>
                <p>No Drafts</p>
                <small>Projects saved as draft will appear here.</small>
                <br><br>
                <button onclick="quickUpload()" class="p-btn p-btn-blue" style="display:inline-block;width:auto;padding:10px 24px">+ Create Project</button>
            </div>
            <?php else: ?>
            <div class="p-grid">
                <?php $__currentLoopData = $drafts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('projects.edit', $project->slug)); ?>" class="p-card">
                    <img src="<?php echo e($project->cover_image ? (str_starts_with($project->cover_image, '/') ? asset($project->cover_image) : $project->cover_image) : 'https://picsum.photos/seed/'.$project->id.'/400/300'); ?>"
                         alt="<?php echo e($project->title); ?>" class="p-card-img"
                         onerror="this.src='https://picsum.photos/seed/<?php echo e($project->id); ?>/400/300'">
                    <div class="p-card-body">
                        <div class="p-card-title">
                            <?php echo e($project->title); ?>

                            <span class="draft-badge">DRAFT</span>
                        </div>
                        <div class="p-card-meta">
                            <span><i class="fas fa-clock"></i> <?php echo e(\Carbon\Carbon::parse($project->created_at)->diffForHumans()); ?></span>
                        </div>
                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
        </div>

        <?php endif; ?> <?php endif; ?>

    </div>
</div>


<?php if(auth()->guard()->check()): ?>
<?php if(auth()->id() === $user->id): ?>


<div class="modal-overlay" id="modal-edit-profile">
    <div class="modal-box">
        <button class="modal-close" onclick="closeEditModal()">&times;</button>
        <div class="modal-title">Edit Profile</div>
        <form method="POST" action="<?php echo e(route('profile.update')); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="form-row-2 form-row">
                <div>
                    <label>First Name *</label>
                    <?php
                        $nameParts = explode(' ', $user->name, 2);
                        $firstName = $nameParts[0] ?? '';
                        $lastName  = $nameParts[1] ?? '';
                    ?>
                    <input type="text" name="first_name" value="<?php echo e($firstName); ?>" required placeholder="First name">
                </div>
                <div>
                    <label>Last Name</label>
                    <input type="text" name="last_name" value="<?php echo e($lastName); ?>" placeholder="Last name">
                </div>
            </div>
            <div class="form-row">
                <label>Location</label>
                <select name="location" style="width:100%;padding:10px 12px;border:1.5px solid #ddd;border-radius:6px;font-size:14px;font-family:inherit;outline:none;box-sizing:border-box">
                    <option value="">— Select Country —</option>
                    <?php $__currentLoopData = [
                        'Afghanistan','Albania','Algeria','Andorra','Angola','Antigua and Barbuda','Argentina','Armenia','Australia',
                        'Austria','Azerbaijan','Bahamas','Bahrain','Bangladesh','Barbados','Belarus','Belgium','Belize','Benin',
                        'Bhutan','Bolivia','Bosnia and Herzegovina','Botswana','Brazil','Brunei','Bulgaria','Burkina Faso','Burundi',
                        'Cabo Verde','Cambodia','Cameroon','Canada','Central African Republic','Chad','Chile','China','Colombia',
                        'Comoros','Congo','Costa Rica','Croatia','Cuba','Cyprus','Czech Republic','Denmark','Djibouti','Dominica',
                        'Dominican Republic','Ecuador','Egypt','El Salvador','Equatorial Guinea','Eritrea','Estonia','Eswatini',
                        'Ethiopia','Fiji','Finland','France','Gabon','Gambia','Georgia','Germany','Ghana','Greece','Grenada',
                        'Guatemala','Guinea','Guinea-Bissau','Guyana','Haiti','Honduras','Hungary','Iceland','India','Indonesia',
                        'Iran','Iraq','Ireland','Israel','Italy','Jamaica','Japan','Jordan','Kazakhstan','Kenya','Kiribati','Kuwait',
                        'Kyrgyzstan','Laos','Latvia','Lebanon','Lesotho','Liberia','Libya','Liechtenstein','Lithuania','Luxembourg',
                        'Madagascar','Malawi','Malaysia','Maldives','Mali','Malta','Marshall Islands','Mauritania','Mauritius','Mexico',
                        'Micronesia','Moldova','Monaco','Mongolia','Montenegro','Morocco','Mozambique','Myanmar','Namibia','Nauru',
                        'Nepal','Netherlands','New Zealand','Nicaragua','Niger','Nigeria','North Korea','North Macedonia','Norway',
                        'Oman','Pakistan','Palau','Palestine','Panama','Papua New Guinea','Paraguay','Peru','Philippines','Poland',
                        'Portugal','Qatar','Romania','Russia','Rwanda','Saint Kitts and Nevis','Saint Lucia',
                        'Saint Vincent and the Grenadines','Samoa','San Marino','Sao Tome and Principe','Saudi Arabia','Senegal',
                        'Serbia','Seychelles','Sierra Leone','Singapore','Slovakia','Slovenia','Solomon Islands','Somalia',
                        'South Africa','South Korea','South Sudan','Spain','Sri Lanka','Sudan','Suriname','Sweden','Switzerland',
                        'Syria','Taiwan','Tajikistan','Tanzania','Thailand','Timor-Leste','Togo','Tonga','Trinidad and Tobago',
                        'Tunisia','Turkey','Turkmenistan','Tuvalu','Uganda','Ukraine','United Arab Emirates','United Kingdom',
                        'United States','Uruguay','Uzbekistan','Vanuatu','Vatican City','Venezuela','Vietnam','Yemen','Zambia','Zimbabwe'
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($country); ?>" <?php echo e($user->location === $country ? 'selected' : ''); ?>><?php echo e($country); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-row">
                <label>Bio</label>
                <textarea name="bio" placeholder="Tell us about yourself..."><?php echo e($user->bio); ?></textarea>
            </div>
            <button type="submit" class="btn-submit">Save Changes</button>
        </form>
    </div>
</div>


<div class="modal-overlay" id="modal-banner">
    <div class="modal-box" style="max-width:360px">
        <button class="modal-close" onclick="closeBannerModal()">&times;</button>
        <div class="modal-title">Banner Image</div>
        <div style="text-align:center;margin-bottom:8px;">
            <img id="banner-preview"
                 src="<?php echo e(!empty($user->banner) ? asset($user->banner) : 'https://via.placeholder.com/320x100/2d3748/ffffff?text=No+Banner'); ?>"
                 alt="Banner Preview"
                 style="width:100%;height:100px;object-fit:cover;border-radius:8px;border:2px solid #eee;">
        </div>
        <div class="avatar-actions">
            <label for="banner-file-input">
                <i class="fas fa-upload"></i> Change Photo
            </label>
            <button class="btn-remove-av" onclick="removeBanner()">
                <i class="fas fa-trash"></i> Remove Photo
            </button>
        </div>
    </div>
</div>


<div class="modal-overlay" id="modal-avatar">
    <div class="modal-box" style="max-width:360px">
        <button class="modal-close" onclick="closeAvatarModal()">&times;</button>
        <div class="modal-title">Profile Photo</div>
        <div class="avatar-preview-wrap">
            <?php if(!empty($user->avatar)): ?>
            <img id="avatar-preview" src="<?php echo e(asset($user->avatar)); ?>" alt="Preview">
            <?php else: ?>
            <div class="avatar-preview-initial" id="avatar-preview-initial">
                <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

            </div>
            <?php endif; ?>
        </div>
        <form id="avatar-upload-form" method="POST" action="<?php echo e(route('profile.updateAvatar')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <input type="file" name="avatar" id="avatar-file-input" accept="image/*" style="display:none" onchange="previewAndSubmit(this)">
        </form>
        <form id="avatar-remove-form" method="POST" action="<?php echo e(route('profile.removeAvatar')); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
        </form>
        <div class="avatar-actions">
            <label for="avatar-file-input">
                <i class="fas fa-upload"></i> Change Photo
            </label>
            <button class="btn-remove-av" onclick="removeAvatar()">
                <i class="fas fa-trash"></i> Remove Photo
            </button>
        </div>
    </div>
</div>

<?php endif; ?>
<?php endif; ?>

<?php if(auth()->guard()->check()): ?>
<?php if(auth()->id() === $user->id): ?>
<input type="file" id="quick-upload-input" accept="image/*" style="display:none">
<?php endif; ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
const csrf = document.querySelector('meta[name="csrf-token"]').content;

// ── Tab switching ──
function switchTab(name, btn) {
    document.querySelectorAll('.p-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.p-tab').forEach(t => t.classList.remove('active'));
    const panel = document.getElementById('panel-' + name);
    if (panel) panel.classList.add('active');
    btn.classList.add('active');
}

// ── Edit Profile Modal ──
function openEditModal() {
    document.getElementById('modal-edit-profile').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeEditModal() {
    document.getElementById('modal-edit-profile').classList.remove('open');
    document.body.style.overflow = '';
}

// ── Avatar Modal ──
function openAvatarModal() {
    document.getElementById('modal-avatar').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeAvatarModal() {
    document.getElementById('modal-avatar').classList.remove('open');
    document.body.style.overflow = '';
}
function previewAndSubmit(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('avatar-preview');
            const initial = document.getElementById('avatar-preview-initial');
            if (preview) preview.src = e.target.result;
            if (initial) initial.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
        setTimeout(() => document.getElementById('avatar-upload-form').submit(), 300);
    }
}
function removeAvatar() {
    if (confirm('Hapus foto profil?')) {
        document.getElementById('avatar-remove-form').submit();
    }
}

// ── Banner Modal ──
function openBannerModal() {
    document.getElementById('modal-banner').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeBannerModal() {
    document.getElementById('modal-banner').classList.remove('open');
    document.body.style.overflow = '';
}
function previewAndSubmitBanner(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('banner-preview').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
        setTimeout(() => document.getElementById('banner-upload-form').submit(), 300);
    }
}
function removeBanner() {
    if (confirm('Hapus banner?')) {
        document.getElementById('banner-remove-form2').submit();
    }
}

// ── Close modal saat klik overlay ──
document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.remove('open');
            document.body.style.overflow = '';
        }
    });
});

// ── Follow toggle ──
async function toggleFollowProfile(userId, btn) {
    const res = await fetch(`/users/${userId}/follow`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }
    });
    if (res.status === 401) { window.location = '/login'; return; }
    if (res.ok) {
        const d = await res.json();
        const following = d.action === 'followed';
        btn.classList.toggle('following', following);
        btn.textContent = following ? 'Following' : '+ Follow';
    }
}

// ── Quick Upload ──
function quickUpload() {
    const input = document.getElementById('quick-upload-input');
    if (!input) { window.location = '<?php echo e(route("projects.create")); ?>'; return; }
    input.click();
    input.onchange = function() {
        if (!input.files || !input.files[0]) return;
        const file = input.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            sessionStorage.setItem('quick_upload_data', e.target.result);
            sessionStorage.setItem('quick_upload_name', file.name);
            sessionStorage.setItem('quick_upload_type', file.type);
            window.location = '<?php echo e(route("projects.create")); ?>';
        };
        reader.readAsDataURL(file);
    };
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\behance_sbd\resources\views/profile/show.blade.php ENDPATH**/ ?>