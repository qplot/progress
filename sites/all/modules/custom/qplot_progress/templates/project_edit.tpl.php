<div class="row">
  <div class="col-md-12">
    <div class="grid simple ">
      <div class="grid-title">
        <h4>Project <span class="semi-bold">Form</span></h4>
        <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
      </div>
      <div class="grid-body"> <br>
        <div class="row">
          <div class="col-md-8 col-sm-8 col-xs-8">

            <form id="phase_edit_form" action="" method="POST">

            <h3> Project <span class="semi-bold">Info</span></h3>
            <input type="hidden" name="id" value="<?php echo $values['id'] ?>" />

            <!-- Project Title -->
            <div class="form-group">
              <label class="form-label">Project Title</label>
              <span class="help">e.g. "Oncologist"</span>
              <div class="controls">
                <input name="title" type="text" class="form-control" value="<?php echo $values['title'] ?>">
              </div>
            </div>

            <!-- Project URL -->
            <div class="form-group">
              <label class="form-label">Project URL with Caption</label>
              <span class="help">e.g. "1 -> http://ticket/1"</span>
              <div class="row">
                <div class="col-md-4">
                  <div class="controls">
                    <input name="caption" type="text" class="form-control" value="<?php echo $values['caption'] ?>">
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="controls">
                    <input name="url" type="text" class="form-control" value="<?php echo $values['url'] ?>">
                  </div>
                </div>
              </div>
            </div>

            <!-- Project Notes -->
            <div class="form-group">
              <label class="form-label">Phase Description</label>
              <span class="help">e.g. ""</span>
              <div class="controls">
                <textarea name="description" id="text-editor" placeholder="Enter text ..." class="form-control" rows="10" ><?php echo $values['description'] ?></textarea>
              </div>
            </div>


            <h3> Project <span class="semi-bold">Picture</span></h3>
            <!-- Project Icon -->
            <div class="form-group">
              <label class="form-label">Project Icon</label>
              <span class="help">Pick one symbol from the list, this will be used when referring projects throughout the site</span>
              <div class="controls">
                <select name="icon" id="icon-select" style="width:200px">
                  <?php foreach ($variables['icons'] as $icon): ?>
                    <option value="<?php echo $icon['id'] ?>" <?php echo ($values['icon']['tid'] == $icon['id']) ? 'selected="selected"' : ''  ?> ><?php echo $icon['name'] ?></option>
                  <?php endforeach ?>
                </select>        
              </div>
            </div>

            <!-- Project Photo -->
            <div class="form-group">
              <label class="form-label">Project Photo</label>
              <span class="help">Upload photo, this photo will be used as slideshow and headline of the project profile</span>
              <div class="controls">
                <input name="file" type="file" multiple />
              </div>
            </div>

          </div>

          <div class="col-md-4 col-sm-4 col-xs-4">
            <h3> Project <span class="semi-bold">Status</span></h3>

            <!-- Project Status -->
            <div class="form-group">
              <label class="form-label">Completed</label>
              <!-- <span class="help">e.g. "Turn on or off"</span> -->
              <br />
              <div class="slide-primary controls">
                <input type="checkbox" name="switch" class="ios" <?php echo ($values['status']) ? 'checked="checked"' : '' ?> />
              </div>
            </div>


            <!-- Project Progress -->
            <div class="form-group">
              <label class="form-label">Project Completion %</label>
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

            <!-- Project Capacity -->
            <div class="form-group">
              <label class="form-label">Capacity</label>
              <span class="help">e.g. "20" hrs per week</span>
              <div class="controls">
                <div class="input-append">
                  <input name="capacity" type="text" class="form-control" value="<?php echo $values['capacity'] ?>">
                </div>
              </div>
            </div>

            <h3> Project <span class="semi-bold">Content</span></h3>
            <!-- Project content -->
            <div class="form-group">
              <label class="form-label">Content Types</label>
              <span class="help">Select lists of content types modeled by this application</span>
              <div class="controls">
                <input name="content" class="span12 tagsinput" type="text" value="<?php echo implode(',', $content) ?>" data-role="tagsinput" />
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