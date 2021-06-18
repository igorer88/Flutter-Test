<?php $__env->startSection('content'); ?>
<?php if(session('message')): ?>
<div class="alert alert-success">
    <?php echo e(session('message')); ?>

</div>
<?php endif; ?>
<div class="row">
    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-3 mt-2 mb-2">
        <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-md-3 ">
                        <img style="height:65px;width:65px;" src="<?php echo e(asset($post->author->user_image)); ?>" alt="User profile" class="rounded-circle">
                    </div>
                    <div class="col-md-9">
                        <p><?php echo e($post->author->first_name); ?></p>
                        <p><?php echo e($post->author->last_name); ?></p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-text"><?php echo e($post->title); ?></h5>
            </div>
            <div class="card-footer">
                <div class="form-group row">
                    <div class="col-md-9">
                        <a href="<?php echo e(route('posts.post', $post->id)); ?>" class="btn btn-secondary">
                            <i class="fas fa-eye"></i>
                            Read Me
                        </a>
                        <a href="<?php echo e(route('posts.edit-post', $post->id)); ?>" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>

                    <div class="col-md-3">

                        <form action="<?php echo e(route('posts.delete-post', $post->id)); ?>" method="post">
                            <?php echo method_field('DELETE'); ?>
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </form>

                    </div>
                </div>

            </div>

        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="col-md-12">
    <?php echo e($posts->links()); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/posts/posts.blade.php ENDPATH**/ ?>