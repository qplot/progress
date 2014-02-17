<div class="row">
  <div class="col-md-12">
    <div class="grid simple ">
      <div class="grid-title">
        <h4>Phase <span class="semi-bold">Form</span></h4>
        <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
      </div>
      <div class="grid-body"> <br>
        <div class="row">
          <div class="col-md-8 col-sm-8 col-xs-8">

            <form id="phase_edit_form" action="" method="POST">

            <h3> Phase <span class="semi-bold">Info</span></h3>
            <input type="hidden" name="id" value="<?php echo $values['id'] ?>" />

            <!-- Phase Title -->
            <div class="form-group">
              <label class="form-label">Phase Title</label>
              <span class="help">e.g. "Evaluation" or "1/14/14"</span>
              <div class="controls">
                <input name="title" type="text" class="form-control" value="<?php echo $values['title'] ?>">
              </div>
            </div>

            <!-- Phase Duration -->
            <div class="form-group">
              <label class="form-label">Phase Duration</label>
              <span class="help">e.g. "From 02/14/2014 to 03/17/2014"</span>
              <div class="row">
                <div class="col-md-6">
                  <div class="controls">
                    <div class="input-append primary date">
                      <input name="from" type="text" class="form-control" value="<?php echo $values['from'] ?>">
                      <span class="add-on">
                        <span class="arrow"></span><i class="fa fa-th"></i>
                      </span> 
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="controls">
                    <div class="input-append primary date">
                      <input name="to" type="text" class="form-control" value="<?php echo $values['to'] ?>">
                      <span class="add-on">
                        <span class="arrow"></span><i class="fa fa-th"></i>
                      </span> 
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Phase Hours -->
            <div class="form-group">
              <label class="form-label">Budget Hour</label>
              <span class="help">e.g. "2.5" for two and half hour</span>
              <div class="controls">
                <div class="input-append bootstrap-timepicker-component primary">
                  <input name="hours" type="text" class="span12 auto" value="<?php echo $values['hours'] ?>" data-a-sign=" hrs" data-p-sign="s" data-v-min="0" />
                  <span class="add-on">
                    <span class="arrow"></span><i class="fa fa-clock-o"></i>
                  </span> 
                </div>
              </div>
            </div>

            <!-- Phase Notes -->
            <div class="form-group">
              <label class="form-label">Phase Description</label>
              <span class="help">e.g. ""</span>
              <div class="controls">
                <textarea name="description" id="text-editor" placeholder="Enter text ..." class="form-control" rows="10" ><?php echo $values['description'] ?></textarea>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-sm-4 col-xs-4">
            <h3> Phase <span class="semi-bold">Status</span></h3>

            <!-- Phase Status -->
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
              <label class="form-label">Phase Completion %</label>
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

            <h3> Phase <span class="semi-bold">Project</span></h3>
            <div class="form-group">
              <!-- <div class="radio radio-primary"> -->
              <div class="checkbox check-primary">
                <?php foreach ($values['projects'] as $value): ?>
                  <?php 
                    $project_id = 'project_' . $value['id']; 
                    $checked = in_array($value['id'], $values['project_ids']);
                  ?>
                  <div class="row-fluid">
                    <input id="<?php echo $project_id ?>" name="project_ids[]" type="checkbox" value="<?php echo $value['id'] ?>" <?php echo $checked ? 'checked="checked"' : '' ?> >
                    <label for="<?php echo $project_id ?>"><?php echo 'Project: ' . $value['title'] ?></label>
                  </div>                  
                <?php endforeach ?>
              </div>

            </div>

          </div>
        </div>
        <div class="form-actions">  
          <div class="pull-right">
            <button type="submit" name="op" value="Save" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
            <button type="submit" name="op" value="Cancel" class="btn btn-white btn-cons">Cancel</button>
          </div>
        </div>

        <input type='hidden' name="destination" value='<?php echo $form['destination'] ?>' />

      </form>
      </div>
    </div>
  </div>
</div>