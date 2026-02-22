<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title">
      <?php if(empty(request()->input('ticket_status'))): ?>
        <?php echo e(__('All Tickets')); ?>

      <?php elseif(request()->input('ticket_status') == 'pending'): ?>
        <?php echo e(__('Pending Tickets')); ?>

      <?php elseif(request()->input('ticket_status') == 'open'): ?>
        <?php echo e(__('Open Tickets')); ?>

      <?php elseif(request()->input('ticket_status') == 'closed'): ?>
        <?php echo e(__('Closed Tickets')); ?>

      <?php endif; ?>
    </h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="<?php echo e(route('admin.dashboard')); ?>">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Support Tickets')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">
          <?php if(empty(request()->input('ticket_status'))): ?>
            <?php echo e(__('All Tickets')); ?>

          <?php elseif(request()->input('ticket_status') == 'pending'): ?>
            <?php echo e(__('Pending Tickets')); ?>

          <?php elseif(request()->input('ticket_status') == 'open'): ?>
            <?php echo e(__('Open Tickets')); ?>

          <?php elseif(request()->input('ticket_status') == 'closed'): ?>
            <?php echo e(__('Closed Tickets')); ?>

          <?php endif; ?>
        </a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-10">
              <form id="searchForm" action="<?php echo e(route('admin.support_tickets')); ?>" method="GET">
                <div class="row">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label><?php echo e(__('Ticket ID')); ?></label>
                      <input name="ticket_no" type="text" class="form-control" placeholder="Search by Ticket ID"
                        value="<?php echo e(!empty(request()->input('ticket_no')) ? request()->input('ticket_no') : ''); ?>">
                    </div>
                  </div>

                  <div class="col-lg-3">
                    <div class="form-group">
                      <label><?php echo e(__('Ticket Status')); ?></label>
                      <select class="form-control " name="ticket_status"
                        onchange="document.getElementById('searchForm').submit()">
                        <option value="" <?php echo e(empty(request()->input('ticket_status')) ? 'selected' : ''); ?>>
                          <?php echo e(__('All')); ?>

                        </option>
                        <option value="pending" <?php echo e(request()->input('ticket_status') == 'pending' ? 'selected' : ''); ?>>
                          <?php echo e(__('Pending')); ?>

                        </option>
                        <option value="open" <?php echo e(request()->input('ticket_status') == 'open' ? 'selected' : ''); ?>>
                          <?php echo e(__('Open')); ?>

                        </option>
                        <option value="closed" <?php echo e(request()->input('ticket_status') == 'closed' ? 'selected' : ''); ?>>
                          <?php echo e(__('Closed')); ?>

                        </option>
                      </select>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <div class="col-lg-2">
              <button class="btn btn-danger btn-sm d-none bulk-delete float-lg-right card-header-button"
                data-href="<?php echo e(route('admin.support_tickets.bulk_delete')); ?>">
                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

              </button>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($tickets) == 0): ?>
                <h3 class="text-center mt-3"><?php echo e(__('NO TICKET FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-2">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col"><?php echo e(__('Ticket ID')); ?></th>
                        <th scope="col"><?php echo e(__('User Type')); ?></th>
                        <th scope="col"><?php echo e(__('User')); ?></th>
                        <th scope="col"><?php echo e(__('Customer Email')); ?></th>
                        <th scope="col"><?php echo e(__('Subject')); ?></th>
                        <th scope="col"><?php echo e(__('Ticket Status')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($ticket->id); ?>">
                          </td>
                          <td><?php echo e('#' . $ticket->id); ?></td>
                          <?php if($ticket->user_type == 'user'): ?>
                            <?php
                              $customer = $ticket->user()->first();
                            ?>
                            <td><span class="badge badge-success"><?php echo e(__('Customer')); ?></span></td>
                            <td><a target="_blank"
                                href="<?php echo e(route('admin.user_management.user.details', ['id' => $customer->id])); ?>"><?php echo e($customer->username); ?></a>
                            </td>
                            <td><?php echo e($customer->email_address); ?></td>
                          <?php else: ?>
                            <?php
                              $seller = $ticket->seller()->first();
                            ?>
                            <td><span class="badge badge-success"><?php echo e(__('Seller')); ?></span></td>
                            <td>
                              <?php if($seller): ?>
                                <a
                                  href="<?php echo e(route('admin.seller_management.seller_details', ['id' => $seller->id, 'language' => $defaultLang->code])); ?>"><?php echo e($seller->username); ?></a>
                              <?php endif; ?>
                            </td>
                            <td><?php echo e(@$seller->email); ?></td>
                          <?php endif; ?>

                          <td><?php echo e($ticket->subject); ?></td>
                          <td>
                            <?php if($ticket->status == 'pending'): ?>
                              <span class="badge badge-warning"><?php echo e(__('Pending')); ?></span>
                            <?php elseif($ticket->status == 'open'): ?>
                              <span class="badge badge-success"><?php echo e(__('Open')); ?></span>
                            <?php else: ?>
                              <span class="badge badge-danger"><?php echo e(__('Closed')); ?></span>
                            <?php endif; ?>
                          </td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo e(__('Select')); ?>

                              </button>

                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a href="<?php echo e('#assignModal-' . $ticket->id); ?>" data-toggle="modal" class="dropdown-item">
                                  <?php echo e(__('Assign To')); ?>

                                </a>

                                <a href="<?php echo e(route('admin.support_ticket.conversation', ['id' => $ticket->id])); ?>"
                                  class="dropdown-item">
                                  <?php echo e(__('Conversation')); ?>

                                </a>

                                <form class="deleteForm d-block"
                                  action="<?php echo e(route('admin.support_ticket.delete', ['id' => $ticket->id])); ?>"
                                  method="post">
                                  <?php echo csrf_field(); ?>
                                  <button type="submit" class="deleteBtn">
                                    <?php echo e(__('Delete')); ?>

                                  </button>
                                </form>
                              </div>
                            </div>
                          </td>
                        </tr>

                        <!-- Assign-Admin Modal -->
                        <?php if ($__env->exists('backend.support-ticket.assign-admin')) echo $__env->make('backend.support-ticket.assign-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="mt-3 text-center">
            <div class="d-inline-block mx-auto">
              <?php echo e($tickets->appends([
                      'order_no' => request()->input('order_no'),
                      'payment_status' => request()->input('payment_status'),
                      'order_status' => request()->input('order_status'),
                  ])->links()); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\support-ticket\tickets.blade.php ENDPATH**/ ?>