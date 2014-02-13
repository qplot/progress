<?php
  global $base_url;
  $path = $base_url . '/' . drupal_get_path('theme', 'webarch');

  // dsm($values);
?>
    <!-- BEGIN BASIC FORM ELEMENTS-->
<div class="row">
  <div class="col-md-12">
    <div class="grid simple ">
      <div class="grid-title">
        <h4>Task <span class="semi-bold">Form</span></h4>
        <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
      </div>
      <div class="grid-body"> <br>
        <div class="row">
          <div class="col-md-8 col-sm-8 col-xs-8">

            <form id="task_edit_form" action="" method="POST">

            <h3> Task <span class="semi-bold">Info</span></h3>
            <input type="hidden" name="id" value="<?php echo $values['id'] ?>" />

            <!-- Task Title -->
            <div class="form-group">
              <label class="form-label">Task Title</label>
              <span class="help">e.g. "Add a text box to home page"</span>
              <div class="controls">
                <input name="title" type="text" class="form-control" value="<?php echo $values['title'] ?>">
              </div>
            </div>

            <!-- Added Date -->
            <div class="form-group">
              <label class="form-label">Requested Date</label>
              <span class="help">e.g. "02/14/2014"</span>
              <div class="controls">
                <div class="input-append primary date">
                  <input name="date" type="text" class="form-control" value="<?php echo $values['date'] ?>">
                  <span class="add-on">
                    <span class="arrow"></span><i class="fa fa-th"></i>
                  </span> 
                </div>
              </div>
            </div>

            <!-- Budget Hours -->
            <div class="form-group">
              <label class="form-label">Budget Hour</label>
              <span class="help">e.g. "02:30" for two and half hour</span>
              <div class="controls">
                <div class="input-append bootstrap-timepicker-component primary">
                  <input name="hours" type="text" class="timepicker-24 span12" value="<?php echo $values['hours'] ?>">
                  <span class="add-on">
                    <span class="arrow"></span><i class="fa fa-clock-o"></i>
                  </span> 
                </div>
              </div>
            </div>

            <!-- Task Notes -->
            <div class="form-group">
              <label class="form-label">Task Description</label>
              <span class="help">e.g. ""</span>
              <div class="controls">
                <textarea name="description" id="text-editor" placeholder="Enter text ..." class="form-control" rows="10" ><?php echo $values['description'] ?></textarea>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-sm-4 col-xs-4">
            <h3> Task <span class="semi-bold">Status</span></h3>

            <!-- Task Status -->
            <div class="form-group">
              <label class="form-label">Completed</label>
              <!-- <span class="help">e.g. "Turn on or off"</span> -->
              <br />
              <div class="slide-primary controls">
                <input type="checkbox" name="switch" class="ios" <?php echo ($values['status']) ? 'checked="checked"' : '' ?> />
              </div>
            </div>


            <!-- Progress Percentage -->
            <div class="form-group">
              <label class="form-label">Progress Percentage %</label>
              <span class="help">e.g. "0 - 100"</span>
              <div class="controls">
                <div class="row">
                  <div class="slider primary col-md-6 controls">
                    <input type="hidden" name="progress" id="progress" value="<?php echo $values['progress'] ?>">
                    <input id="progress" type="text" class="slider-element form-control" value data-slider-min="0" data-slider-max="100" data-slider-step="5" data-slider-value="<?php echo $values['progress'] ?>" data-slider-orientation="horizontal" data-slider-selection="after" data-slider-tooltip="">
                  </div>          
                </div>
              </div>
            </div>

            <h3> Choose <span class="semi-bold">Phase</span></h3>
            <div class="form-group">
              <!-- <label class="form-label">Choose phase</label> -->
              <!-- <span class="help">e.g. "0 - 100"</span> -->
              <div class="radio radio-primary">
                <?php foreach ($values['phases'] as $value): ?>
                  <div class="row-fluid">
                    <input id="<?php echo 'phase_' . $value['id'] ?>" name="phase_id" type="radio" value="<?php echo $value['id'] ?>" <?php echo ($values['phase_id'] == $value['id']) ? 'checked="checked"' : '' ?> >
                    <label for="<?php echo 'phase_' . $value['id'] ?>"><?php echo 'Phase: ' . $value['title'] ?></label>
                  </div>                  
                <?php endforeach ?>
              </div>

            </div>

          </div>
        </div>
        <div class="form-actions">  
          <div class="pull-right">
            <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
            <button type="button" class="btn btn-white btn-cons">Cancel</button>
          </div>
        </div>

        <input type='hidden' name="destination" value='<?php echo $form['destination'] ?>' />

      </form>
      </div>
    </div>
  </div>
</div>
  <!-- END BASIC FORM ELEMENTS-->  
