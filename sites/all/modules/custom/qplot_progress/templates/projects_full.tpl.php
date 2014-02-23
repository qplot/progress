<?php
	global $base_url;
	$path = $base_url . '/' . drupal_get_path('theme', 'webarch');

  // dsm($projects);
?>

<div class="row tiles-container tiles white spacing-bottom">
  <div class="grid simple ">
    <div class="grid-title no-border">
      <h4><?php echo $company['title'] ?></h4>
      <div class="tools"> 
        <a href="javascript:;" class="collapse"></a>
        <a href="#grid-config" data-toggle="modal" class="config"></a>
        <a href="javascript:;" class="reload"></a>
        <a href="javascript:;" class="remove"></a>
      </div>
    </div>
    <div class="grid-body no-border">
      <a href="<?php echo $company['create_project'] ?>" class="pull-right btn btn-mini"> <i class="fa fa-plus"></i> new project</a>
      <h3><?php echo count($projects) ?>  <span class="semi-bold">Projects</span></h3>

      <!-- Caption -->
      <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-8">
          <div class="row">
            <div class="col-md-4" align="middle"><span class="semi-bold">Accounting</span></div>
            <div class="col-md-4" align="middle"><span class="semi-bold">Resources</span></div>
            <div class="col-md-4" align="middle"><span class="semi-bold">Progress</span></div>
          </div>
        </div>
      </div>

      <br />

      <?php foreach ($projects as $value): ?>
        <hr />        
        <div class="row">
          <div class="col-md-4">
            <h3><a href="<?php echo $value['view'] ?>"><?php echo $value['title'] ?></a></h3>
            <p><?php echo $value['created'] ?></p>
            <p><?php echo $value['description'] ?></p>
            <p>
              <a href="<?php echo $value['edit'] ?>" class="btn btn-mini"><i class="fa fa-edit"></i> edit</a>
              <a href="<?php echo $value['delete'] ?>" class="btn btn-mini"><i class="fa fa-eraser"></i> remove</a>
            </p>
          </div>
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-4">
                <div id="ram-usage" class="easy-pie-custom" data-percent="85"><span class="easy-pie-percent"><?php echo $value['status'] ?></span></div>
              </div>
              <div class="col-md-4">
                <div id="project-capacity" class="easy-pie-custom" data-percent="<?php echo $value['capacity'] ?>"><span class="easy-pie-percent"><?php echo $value['capacity'] ?> hrs/w</span></div>    
              </div>
              <div class="col-md-4">
                <div id="project-progress" class="easy-pie-custom" data-percent="<?php echo $value['progress'] ?>"><span class="easy-pie-percent"><?php echo $value['progress'] ?>%</span></div>    
              </div>
            </div>
          </div>  
        </div>

        <br />
      <?php endforeach ?>

    </div>
  </div>
</div>
