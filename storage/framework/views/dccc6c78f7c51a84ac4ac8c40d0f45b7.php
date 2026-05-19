
<?php $__env->startSection('title', $asset->title); ?>

<?php
    $userFollowing = auth()->check() && DB::table('follows')->where('follower_id', auth()->id())->where('following_id', $asset->user_id)->exists();
?>

<?php $__env->startSection('content'); ?>

<div style="max-width:900px;margin:0 auto;padding:0 16px;position:relative">

    
    <div style="position:fixed;right:24px;top:50%;transform:translateY(-50%);z-index:100;display:flex;flex-direction:column;gap:8px;align-items:center">

        
        <button id="btn-follow" onclick="toggleFollow(<?php echo e($asset->user_id); ?>, this)"
            style="width:48px;height:48px;border-radius:50%;background:<?php echo e($userFollowing ? '#0057ff' : '#fff'); ?>;border:1px solid #e0e0e0;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 2px 8px rgba(0,0,0,.1);flex-direction:column;font-size:9px;font-weight:600;color:<?php echo e($userFollowing ? '#fff' : '#333'); ?>;gap:2px">
            <i class="fas fa-<?php echo e($userFollowing ? 'check' : 'plus'); ?>" style="font-size:14px"></i>
            <span><?php echo e($userFollowing ? 'Following' : 'Follow'); ?></span>
        </button>

        
        <button onclick="shareAsset()"
            style="width:48px;height:48px;border-radius:50%;background:#fff;border:1px solid #e0e0e0;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 2px 8px rgba(0,0,0,.1);flex-direction:column;font-size:9px;font-weight:600;color:#333;gap:2px">
            <i class="fas fa-share-alt" style="font-size:14px"></i>
            <span>Share</span>
        </button>

        
        <button
            style="width:48px;height:48px;border-radius:50%;background:#0057ff;border:none;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 2px 8px rgba(0,86,255,.3);flex-direction:column;font-size:9px;font-weight:600;color:#fff;gap:2px">
            <i class="fas fa-thumbs-up" style="font-size:14px"></i>
            <span><?php echo e(number_format($asset->likes_count)); ?></span>
        </button>

    </div>

    
    <div style="border-radius:12px;overflow:hidden;margin-bottom:24px;background:#111">
        <img src="<?php echo e($asset->cover_image ?? 'https://picsum.photos/seed/'.$asset->id.'/900/500'); ?>"
             alt="<?php echo e($asset->title); ?>"
             style="width:100%;max-height:500px;object-fit:cover;display:block"
             onerror="this.src='https://picsum.photos/seed/<?php echo e($asset->id); ?>/900/500'">
    </div>

    
    <div style="margin-bottom:24px">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px">
            <h1 style="font-size:28px;font-weight:800;line-height:1.3">
                <?php echo e($asset->title); ?>

            </h1>
            
            <span style="padding:4px 10px;background:#f0f4ff;color:#0057ff;border-radius:20px;font-size:12px;font-weight:600;text-transform:uppercase;white-space:nowrap">
                <?php echo e($asset->asset_type); ?>

            </span>
        </div>

        
        <div style="margin-bottom:16px">
            <?php if($asset->license === 'free'): ?>
                <span style="padding:6px 14px;background:#e8f5e9;color:#2e7d32;border-radius:20px;font-size:13px;font-weight:700">
                    FREE
                </span>
            <?php else: ?>
                <span style="padding:6px 14px;background:#fff3e0;color:#e65100;border-radius:20px;font-size:13px;font-weight:700">
                    <?php echo e($asset->currency); ?> $<?php echo e(number_format($asset->price, 2)); ?>

                </span>
            <?php endif; ?>
        </div>

        <div style="display:flex;gap:20px;color:#aaa;font-size:14px;margin-bottom:16px;align-items:center">
            <span><i class="fas fa-eye"></i> <?php echo e(number_format($asset->views_count)); ?> views</span>
            <span><i class="fas fa-heart" style="color:#e74c3c"></i> <?php echo e(number_format($asset->likes_count)); ?> likes</span>
        </div>

        
        <div style="display:flex;align-items:center;gap:12px;padding:16px;background:#f8f8f8;border-radius:10px">
            <img src="<?php echo e($asset->creator_avatar ?? 'https://i.pravatar.cc/60?u='.$asset->creator_username); ?>"
                 alt="<?php echo e($asset->creator_name); ?>"
                 style="width:48px;height:48px;border-radius:50%;object-fit:cover"
                 onerror="this.src='https://i.pravatar.cc/60?u=<?php echo e($asset->creator_username); ?>'">
            <div>
                <a href="<?php echo e(route('profile.show', $asset->creator_username)); ?>" style="font-weight:700;font-size:15px;color:#111;text-decoration:none">
                    <?php echo e($asset->creator_name); ?>

                </a>
                <div style="color:#aaa;font-size:13px">{{ $asset->creator_username }}</div>
                <?php if($asset->followers_count > 0): ?>
                <div style="color:#aaa;font-size:12px;margin-top:2px"><?php echo e(number_format($asset->followers_count)); ?> followers</div>
                <?php endif; ?>
            </div>
            <?php if(auth()->guard()->check()): ?>
            <button onclick="toggleFollow(<?php echo e($asset->user_id); ?>, this)"
                style="margin-left:auto;padding:8px 16px;border-radius:20px;background:<?php echo e($userFollowing ? '#f0f0f0' : '#0057ff'); ?>;color:<?php echo e($userFollowing ? '#333' : '#fff'); ?>;border:none;cursor:pointer;font-size:13px;font-weight:600">
                <?php echo e($userFollowing ? 'Following' : 'Follow'); ?>

            </button>
            <?php endif; ?>
        </div>
    </div>

    
    <?php if($asset->description): ?>
    <div style="margin-bottom:32px;padding:20px;background:#fafafa;border-radius:10px;border-left:4px solid #0057ff">
        <h3 style="font-size:16px;font-weight:700;margin-bottom:8px">Tentang Asset</h3>
        <p style="color:#555;line-height:1.7;white-space:pre-line"><?php echo e($asset->description); ?></p>
    </div>
    <?php endif; ?>

    
    <div style="margin-bottom:32px;text-align:center">
        <?php if($asset->license === 'free'): ?>
        <a href="<?php echo e($asset->cover_image); ?>" target="_blank"
            style="display:inline-block;padding:14px 40px;background:#0057ff;color:#fff;border-radius:8px;font-size:16px;font-weight:700;text-decoration:none">
            <i class="fas fa-download"></i> Download Free
        </a>
        <?php else: ?>
        <a href="#"
            style="display:inline-block;padding:14px 40px;background:#ff6b00;color:#fff;border-radius:8px;font-size:16px;font-weight:700;text-decoration:none">
            <i class="fas fa-shopping-cart"></i> Get for <?php echo e($asset->currency); ?> $<?php echo e(number_format($asset->price, 2)); ?>

        </a>
        <?php endif; ?>
    </div>

    
    <?php if($related->count()): ?>
    <div style="margin-bottom:40px">
        <h3 style="font-size:18px;font-weight:700;margin-bottom:20px">Asset Lainnya dari <?php echo e($asset->creator_name); ?></h3>
        <div class="projects-grid">
            <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('assets.show', $rel->slug)); ?>" class="project-card">
                <div class="card-img-wrap">
                    <img src="<?php echo e($rel->cover_image ?? 'https://picsum.photos/seed/'.$rel->id.'/480/360'); ?>"
                         alt="<?php echo e($rel->title); ?>"
                         class="card-img-inner"
                         onerror="this.src='https://picsum.photos/seed/<?php echo e($rel->id); ?>/480/360'">
                </div>
                <div class="card-body">
                    <div class="card-title"><?php echo e($rel->title); ?></div>
                    <div class="card-meta">
                        <?php if(isset($rel->license) && $rel->license === 'free'): ?>
                            <span style="color:#2e7d32;font-weight:600;font-size:12px">FREE</span>
                        <?php else: ?>
                            <span style="color:#e65100;font-weight:600;font-size:12px">$<?php echo e(number_format($rel->price ?? 0, 2)); ?></span>
                        <?php endif; ?>
                        <span class="card-likes"><i class="fas fa-heart"></i> <?php echo e(number_format($rel->likes_count)); ?></span>
                    </div>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>

    <a href="<?php echo e(route('explore')); ?>?type=assets" class="btn btn-outline" style="margin-bottom:40px;display:inline-block">
        ← Kembali ke Assets
    </a>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
const csrf = document.querySelector('meta[name="csrf-token"]').content;

async function toggleFollow(userId, btn) {
    const res = await fetch(`/users/${userId}/follow`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }
    });
    if (res.status === 401) { window.location = '/login'; return; }
    if (res.ok) {
        const d = await res.json();
        const following = d.action === 'followed';
        btn.style.background = following ? '#0057ff' : '#f0f0f0';
        btn.style.color = following ? '#fff' : '#333';
        if (btn.querySelector('i')) {
            btn.querySelector('i').className = `fas fa-${following ? 'check' : 'plus'}`;
        }
        btn.querySelector('span') && (btn.querySelector('span').textContent = following ? 'Following' : 'Follow');
        if (!btn.querySelector('span')) btn.textContent = following ? 'Following' : 'Follow';
    }
}

function shareAsset() {
    if (navigator.share) {
        navigator.share({ title: document.title, url: window.location.href });
    } else {
        navigator.clipboard.writeText(window.location.href).then(() => {
            alert('Link copied to clipboard!');
        });
    }
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\semester2\SBD\TUBES\behance_sbd\resources\views/assets/show.blade.php ENDPATH**/ ?>