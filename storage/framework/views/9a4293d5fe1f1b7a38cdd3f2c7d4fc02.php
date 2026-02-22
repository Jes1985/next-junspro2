<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Subscription Log')); ?></h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="<?php echo e(route('seller.dashboard')); ?>">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Payment')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Subscription Log')); ?></a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title d-inline-block"><?php echo e(__('Subscription Log')); ?></div>
            </div>
            <div class="col-lg-3">
            </div>
            <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
              <form action="<?php echo e(url()->current()); ?>" class="d-inline-block float-right">
                <input class="form-control" type="text" name="search"
                  placeholder="<?php echo e(__('Search by Transaction ID')); ?>"
                  value="<?php echo e(request()->input('search') ? request()->input('search') : ''); ?>">
              </form>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($memberships) == 0): ?>
                <h3 class="text-center"><?php echo e(__('NO MEMBERSHIP FOUND')); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col"><?php echo e(__('Transaction Id')); ?></th>
                        <th scope="col"><?php echo e(__('Amount')); ?></th>
                        <th scope="col"><?php echo e(__('Payment Status')); ?></th>
                        <th scope="col"><?php echo e(__('Payment Method')); ?></th>
                        <th scope="col"><?php echo e(__('Receipt')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <?php echo e(strlen($membership->transaction_id) > 30 ? mb_substr($membership->transaction_id, 0, 30, 'UTF-8') . '...' : $membership->transaction_id); ?>

                          </td>
                          <?php
                            $bex = json_decode($membership->settings);
                          ?>
                          <td>
                            <?php if($membership->price == 0): ?>
                              <?php echo e(__('Free')); ?>

                            <?php else: ?>
                              <?php echo e(format_price($membership->price)); ?>

                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if($membership->status == 1): ?>
                              <h3 class="d-inline-block badge badge-success"><?php echo e(__('Success')); ?></h3>
                            <?php elseif($membership->status == 0): ?>
                              <h3 class="d-inline-block badge badge-warning"><?php echo e(__('Pending')); ?></h3>
                            <?php elseif($membership->status == 2): ?>
                              <h3 class="d-inline-block badge badge-danger"><?php echo e(__('Rejected')); ?></h3>
                            <?php endif; ?>
                          </td>
                          <td><?php echo e($membership->payment_method); ?></td>
                          <td>
                            <?php if(!empty($membership->receipt)): ?>
                              <a class="btn btn-sm btn-info" href="#" data-toggle="modal"
                                data-target="#receiptModal<?php echo e($membership->id); ?>"><?php echo e(__('Show')); ?></a>
                            <?php else: ?>
                              -
                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if(!empty($membership->name !== 'anonymous')): ?>
                              <a class="btn btn-sm btn-info" href="#" data-toggle="modal"
                                data-target="#detailsModal<?php echo e($membership->id); ?>"><?php echo e(__('Detail')); ?></a>
                            <?php else: ?>
                              -
                            <?php endif; ?>
                          </td>
                        </tr>
                        <div class="modal fade" id="receiptModal<?php echo e($membership->id); ?>" tabindex="-1" role="dialog"
                          aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Receipt Image')); ?>

                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <?php if(!empty($membership->receipt)): ?>
                                  <img src="<?php echo e(asset('assets/front/img/membership/receipt/' . $membership->receipt)); ?>"
                                    alt="Receipt" width="100%">
                                <?php endif; ?>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?>

                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal fade" id="detailsModal<?php echo e($membership->id); ?>" tabindex="-1" role="dialog"
                          aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Owner Details')); ?>

                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <h3 class="text-warning"><?php echo e(__('Member details')); ?></h3>
                                <label><?php echo e(__('Name')); ?></label>
                                <p>
                                  <?php echo e(@$membership->seller->seller_info()->where('language_id', $defaultLang->id)->first()->name); ?>

                                </p>
                                <label><?php echo e(__('Email')); ?></label>
                                <p><?php echo e(@$membership->seller->email); ?></p>
                                <label><?php echo e(__('Phone')); ?></label>
                                <p><?php echo e(@$membership->seller->phone_number); ?></p>
                                <h3 class="text-warning"><?php echo e(__('Payment details')); ?></h3>
                                <p><strong><?php echo e(__('Package Price')); ?>: </strong> <?php echo e($membership->price); ?>

                                </p>
                                <p><strong><?php echo e(__('Currency')); ?>: </strong> <?php echo e($membership->currency); ?>

                                </p>
                                <p><strong><?php echo e(__('Method')); ?>: </strong> <?php echo e($membership->payment_method); ?>

                                </p>
                                <h3 class="text-warning"><?php echo e(__('Package Details')); ?></h3>
                                <p><strong><?php echo e(__('Title')); ?>:
                                  </strong><?php echo e(!empty($membership->package) ? $membership->package->title : ''); ?>

                                </p>
                                <p><strong><?php echo e(__('Term')); ?>: </strong>
                                  <?php echo e(!empty($membership->package) ? $membership->package->term : ''); ?>

                                </p>
                                <p><strong><?php echo e(__('Start Date')); ?>: </strong>
                                  <?php if(\Illuminate\Support\Carbon::parse($membership->start_date)->format('Y') == '9999'): ?>
                                    <span class="badge badge-danger"><?php echo e(__('Never Activated')); ?></span>
                                  <?php else: ?>
                                    <?php echo e(\Illuminate\Support\Carbon::parse($membership->start_date)->format('M-d-Y')); ?>

                                  <?php endif; ?>
                                </p>
                                <p><strong><?php echo e(__('Expire Date')); ?>: </strong>

                                  <?php if(\Illuminate\Support\Carbon::parse($membership->start_date)->format('Y') == '9999'): ?>
                                    -
                                  <?php else: ?>
                                    <?php if($membership->modified == 1): ?>
                                      <?php echo e(\Illuminate\Support\Carbon::parse($membership->expire_date)->addDay()->format('M-d-Y')); ?>

                                      <span class="badge badge-primary btn-xs"><?php echo e(__('modified by Admin')); ?></span>
                                    <?php else: ?>
                                      <?php echo e($membership->package->term == 'lifetime' ? 'Lifetime' : \Illuminate\Support\Carbon::parse($membership->expire_date)->format('M-d-Y')); ?>

                                    <?php endif; ?>
                                  <?php endif; ?>
                                </p>
                                <p>
                                  <strong><?php echo e(__('Purchase Type')); ?>: </strong>
                                  <?php if($membership->is_trial == 1): ?>
                                    <?php echo e(__('Trial')); ?>

                                  <?php else: ?>
                                    <?php echo e($membership->price == 0 ? 'Free' : 'Regular'); ?>

                                  <?php endif; ?>
                                </p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                  <?php echo e(__('Close')); ?>

                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="d-inline-block mx-auto">
              <?php echo e($memberships->links()); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('seller.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\seller\subscription_log.blade.php ENDPATH**/ ?>