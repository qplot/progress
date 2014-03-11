<?php 
 // dsm($project);
 // dsm($items);
 // dsm($tasks)
?>

<div class="grid simple vertical green">
  <div class="grid-title no-border">
    <h4>Project <span class="semi-bold">Overview</span></h4>
    <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
  </div>
  <div class="grid-body no-border">
    <div class="row-fluid">
      <div>
        <?php if ($project['flag']): ?>
          <a href="" class="text-white pull-right"><i class="fa fa-star-o"></i></a>
        <?php endif; ?>
        <h3>
          Project: <span class="semi-bold"><?php echo $project['title'] ?></span>
          <?php if ($project['edit']): ?>
          <a href="<?php echo $project['edit'] ?>" class="btn btn-mini"><i class="fa fa-pencil"></i> edit </a>
          <?php endif; ?>
        </h3>
        <div class="color-bands green"></div>
        <div class="color-bands purple"></div>
        <div class="color-bands red"></div>
        <div class="color-bands blue"></div>
        <div class="pull-right">
          <?php if ($company): ?>
            <i class="fa fa-<?php echo $project['icon'] ?>"></i> Company: <a href="<?php echo $company['view'] ?>"> <?php echo $company['title'] ?> </a>
          <?php endif ?>
        </div>
        <div class="clearfix"></div>
        <br>
        <?php echo $project['description'] ?>
        <div class="clearfix"></div>
        <img src="<?php echo $project['photo']; ?>" width="100%" height="auto">
      </div>
    </div>
  </div>
</div>

