<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title"><?php echo e($post->title); ?></h3>
                    <p><?php echo e($post->content); ?></p>
                </div>

            </div>
            <div class="row">
                <?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div>
                    <div class="card ml-2 mt-2 p-2">
                        <p class="card-text"><?php echo e($tag->title); ?></p>
                    </div>

                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title">Commentaires <?php echo e($post->comments->count()); ?> </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 ">
                            <img style="height:65px;width:65px;" src="<?php echo e($post->author->avatar); ?>" alt="User profile" class="rounded-circle">
                        </div>
                        <div class="col-md-10">
                            <form method="POST" action="<?php echo e(route('posts.do-comment',$post->id)); ?> ">
                                <?php echo csrf_field(); ?>
                                <div class="form-group row">

                                    <div class="col-md-9">
                                        
                                        <textarea id="content" type="text" class="form-control <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="content" value="<?php echo e(old('content')); ?>" rows="1" required autocomplete="content" autofocus>write your comment</textarea>
                                        <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">
                                            <?php echo e(__('Comment')); ?>

                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <?php $__currentLoopData = $post->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row mb-4">
                        <div class="col-md-2 ">
                            <img style="height:70px;width:70px;" src="<?php echo e($comment->author->avatar); ?>" alt="User profile" class="rounded-circle" />
                        </div>
                        <div class="col-md-9">
                            <p><em><?php echo e($comment->author->first_name .' . '); ?> <?php echo e($comment->updated_at->diffForHumans()); ?></em> </p>

                            <p><strong><?php echo e($comment->content); ?></strong></p>
                            <form action="<?php echo e(route('posts.delete-comment', [$post->id,$comment->id])); ?>" method="post">
                                <?php echo method_field('DELETE'); ?>
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </div>

        </div>
        <div class="col-md-4">
            <?php $__currentLoopData = $post->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <img class="img-thumbnail rounded-left mb-2 "  src="<?php echo e(asset($image->image_url)); ?>" alt="Post image" />
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php $__currentLoopData = $post->videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <img class="img-thumbnail rounded-left" src="<?php echo e($video->url); ?>" alt="Post image" />
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>


    <hr>
    <div class="row mb-0 justify-content-center ">

        <div class="col-md-6">
            <a href="<?php echo e(route('posts.posts')); ?>" class="btn btn-info">Back to all posts <i class="fas fa-sign-in-alt"></i> </a> <a href="<?php echo e(route('posts.edit-post', $post->id)); ?>" class="btn btn-primary">Edit <i class="fas fa-edit"></i></a>
        </div>

        <div class="col-md-4 ">

            <form action="<?php echo e(route('posts.delete-post', $post->id)); ?>" method="post">
                <?php echo method_field('DELETE'); ?>
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-danger">
                    Delete <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </form>

        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/posts/post.blade.php ENDPATH**/ ?>