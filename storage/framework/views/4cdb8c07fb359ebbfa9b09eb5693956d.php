<footer class="bg-[#191919] text-white px-6 md:px-14 pt-24 pb-12 font-['Inter']">
    <div class="max-w-[1440px] mx-auto">
        <div class="grid grid-cols-2 md:grid-cols-5 gap-y-12 gap-x-12 lg:gap-x-20">
            <div class="col-span-2 md:col-span-1">
                <span class="text-[28px] font-[900] tracking-tighter cursor-pointer">Bēhance</span>
            </div>

            <?php
                $foot = [
                    'Built For Creatives' => ['Try Behance Pro', 'Find Inspiration', 'Get Hired', 'Sell Creative Assets', 'Sell Freelance Services'],
                    'Find Talent' => ['Post a Job', 'Graphic Designers', 'Photographers', 'Video Editors', 'Web Designers', 'Illustrators'],
                    'Behance' => ['About Behance', 'Adobe Portfolio', 'Download the App', 'Blog', 'Careers', 'Help Center', 'Contact Us', 'Popular Search Terms', 'Login'],
                    'Social' => ['Instagram', 'Twitter', 'Pinterest', 'Facebook', 'LinkedIn']
                ];
            ?>

            <?php $__currentLoopData = $foot; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title => $links): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div>
                <h4 class="font-bold text-[14px] mb-8 tracking-tight"><?php echo e($title); ?></h4>
                <ul class="text-white text-[14px] space-y-4 font-bold">
                    <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="group cursor-pointer">
                            <span class="group-hover:underline decoration-1 underline-offset-4 transition-all">
                                <?php echo e($l); ?>

                            </span>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

       <div class="mt-24 pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center text-[12px] font-bold text-white">
            <div class="flex items-center gap-7 mb-4 md:mb-0">
                <div class="flex items-center gap-2 cursor-pointer">
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M12.7 3H19V17L12.7 3Z"/><path d="M7.3 3H1V17L7.3 3Z"/><path d="M10 8.5L14.2 17H11.5L10.7 15.1H9.3L8.5 17H5.8L10 8.5Z"/>
                    </svg>
                    <span class="text-[15px] font-[900] tracking-tight">Adobe</span>
                </div>
                <span class="font-medium">© 2026 Adobe Inc. All rights reserved.</span>
            </div>

            <div class="flex flex-wrap items-center gap-x-6 gap-y-3">
                <div class="flex items-center gap-1.5 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                    </svg>
                    <span class="hover:underline underline-offset-4">English</span>
                    <span class="text-[8px] mt-0.5">▼</span>
                </div>
                <a href="#" class="hover:underline underline-offset-4">TOU</a>
                <a href="#" class="hover:underline underline-offset-4">Privacy</a>
                <a href="#" class="hover:underline underline-offset-4">Community</a>
                <a href="#" class="hover:underline underline-offset-4">Cookie preferences</a>
                <a href="#" class="font-medium hover:underline underline-offset-4">Do not sell or share my personal information</a>
            </div>
        </div>
</footer><?php /**PATH C:\Semester2\SBD\behance_sbd\resources\views/partials/footer.blade.php ENDPATH**/ ?>