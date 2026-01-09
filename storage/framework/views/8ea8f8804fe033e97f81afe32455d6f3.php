<div 
    class="relative flex items-center h-[4.5rem] px-4 border-b border-gray-200/50 dark:border-white/5 backdrop-blur-xl transition-all duration-300 bg-white/50 dark:bg-gray-950/50"
    :class="$store.sidebar.isOpen ? 'justify-between' : 'justify-center'"
>
    <a 
        href="/" 
        class="flex items-center gap-3 group outline-none"
        x-show="$store.sidebar.isOpen"
        x-transition:enter="delay-75 duration-300 ease-out"
        x-transition:enter-start="opacity-0 -translate-x-2"
        x-transition:enter-end="opacity-100 translate-x-0"
    >
        <div class="relative flex items-center justify-center w-10 h-10 transition-transform duration-500 group-hover:scale-105">
            <div class="absolute inset-0 bg-primary-500/20 rounded-xl blur-sm group-hover:bg-primary-500/30 transition-colors"></div>
            
            <img 
                src="<?php echo e(asset('img/rsumpyk.png')); ?>" 
                alt="Logo" 
                class="relative w-full h-full p-0.5 rounded-lg object-contain"
            >
        </div>
        
        <div class="flex flex-col">
            <span class="text-base font-bold tracking-wide text-transparent bg-clip-text bg-gradient-to-br from-gray-900 via-gray-700 to-gray-500 dark:from-white dark:via-gray-200 dark:to-gray-400">
                <?php echo e(config('app.name')); ?>

            </span>
            <span class="text-[0.6rem] font-medium tracking-wider uppercase text-gray-500 dark:text-gray-400">
                Dashboard
            </span>
        </div>
    </a>

    <button 
        x-on:click="$store.sidebar.isOpen = !$store.sidebar.isOpen"
        type="button"
        class="flex items-center justify-center transition-all duration-300 rounded-lg group focus:outline-none focus:ring-2 focus:ring-primary-500/50"
        :class="$store.sidebar.isOpen 
            ? 'w-8 h-8 text-gray-400 hover:text-primary-600 hover:bg-primary-50 dark:hover:bg-primary-500/10 dark:hover:text-primary-400' 
            : 'w-full h-full bg-transparent'"
    >
        <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-chevron-double-left'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 transition-transform duration-300 group-hover:-translate-x-0.5','x-show' => '$store.sidebar.isOpen']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>

        <div 
            x-show="!$store.sidebar.isOpen" 
            style="display: none;" 
            class="relative flex flex-col items-center justify-center w-full h-full gap-2"
        >
            <div class="relative w-8 h-8 transition-all duration-300 group-hover:opacity-0 group-hover:scale-75">
                 <img src="<?php echo e(asset('img/rsumpyk.png')); ?>" alt="Logo" class="w-full h-full object-contain">
            </div>

            <div class="absolute inset-0 flex items-center justify-center transition-all duration-300 scale-50 opacity-0 group-hover:scale-100 group-hover:opacity-100">
                <div class="p-2 bg-white rounded-lg shadow-lg dark:bg-gray-800 ring-1 ring-gray-900/5 dark:ring-white/10">
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-chevron-double-right'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 text-primary-600 dark:text-primary-400']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                </div>
            </div>
        </div>
    </button>
</div><?php /**PATH E:\Magang\Inventaris AlKes\inventory-alkes\resources\views/filament/components/sidebar-header.blade.php ENDPATH**/ ?>