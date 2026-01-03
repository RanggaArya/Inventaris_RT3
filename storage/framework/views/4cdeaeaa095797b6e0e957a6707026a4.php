<?php
    $panel = filament()->getCurrentPanel();

    $logo = $panel->getBrandLogo();
    $name = $panel->getBrandName();
?>

<a href="<?php echo e($panel->getHomeUrl()); ?>" class="flex items-center gap-3">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($logo): ?>
        <div class="shrink-0">
            
            <?php echo $logo; ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($name): ?>
        <div class="text-base font-semibold whitespace-nowrap">
            <?php echo e($name); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</a>
<?php /**PATH E:\Magang\Inventaris AlKes\inventory-alkes\resources\views/filament/brand.blade.php ENDPATH**/ ?>