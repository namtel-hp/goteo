<?php

use Goteo\Library\Text;

$errors = $this['errors'] ?>

<div id="project-steps">
            
            <fieldset>

                <legend><h3><?php echo Text::get('form-navigation_bar-header'); ?></h3></legend>

                <div class="steps">
                    
                    <a href="/project/edit/<?php echo $this['id_project']; ?>/userProfile">
                    <span class="step first-off off<?php if ($this['step'] === 'userProfile') echo ' active'; else echo ' activable'; ?>">
                        <button type="button" name="view-step-userProfile" value="userProfile"><?php echo Text::get('step-1'); ?>
                        <strong class="number"></strong></button>
                    </span>
                    </a>
                    
                    <a href="/project/edit/<?php echo $this['id_project']; ?>/userPersonal">
                    <span class="step off-off off<?php if ($this['step'] === 'userPersonal') echo ' active'; else echo ' activable'; ?>">
                        <button type="button" name="view-step-userPersonal" value="userPersonal"><?php echo Text::get('step-2'); ?>
                        <strong class="number"></strong></button>
                    </span>
                    </a>
                    
                    <fieldset style="display: inline">
                        
                        <legend><?php echo Text::get('regular-new_project'); ?></legend>
                        
                        <a href="/project/edit/<?php echo $this['id_project']; ?>/overview">
                        <span class="step off-on<?php if ($this['step'] === 'overview') echo ' active'; else echo ' activable'; ?>">
                            <button type="button" name="view-step-overview" value="overview"><?php echo Text::get('step-3'); ?>
                            <strong class="number"></strong></button>                            
                        </span>
                        </a>

                        <a href="/project/edit/<?php echo $this['id_project']; ?>/images">
                        <span class="step on-on<?php if ($this['step'] === 'images') echo ' active'; else echo ' activable'; ?>">
                            <button type="button" name="view-step-images" value="images"><?php echo Text::get('step-3b'); ?>
                            <strong class="number"></strong></button>
                        </span>
                        </a>
                        
                        <a href="/project/edit/<?php echo $this['id_project']; ?>/costs">
                        <span class="step on-on<?php if ($this['step'] === 'costs') echo ' active'; else echo ' activable'; ?>">
                            <button type="button" name="view-step-costs" value="costs"><?php echo Text::get('step-4'); ?>
                            <strong class="number"></strong></button>
                        </span>
                        </a>

                        <a href="/project/edit/<?php echo $this['id_project']; ?>/rewards">
                        <span class="step on-on<?php if ($this['step'] === 'rewards') echo ' active'; else echo ' activable'; ?>">
                            <button type="button" name="view-step-rewards" value="rewards"><?php echo Text::get('step-5'); ?>
                            <strong class="number"></strong></button>                            
                        </span>
                        </a>

                        <a href="/project/edit/<?php echo $this['id_project']; ?>/supports">
                        <span class="step on-off<?php if ($this['step'] === 'supports') echo ' active'; else echo ' activable'; ?>">
                            <button type="button" name="view-step-supports" value="supports"><?php echo Text::get('step-6'); ?>
                            <strong class="number"></strong></button>                            
                        </span>
                        </a>
                        
                    </fieldset>
                    
                    <a href="/project/edit/<?php echo $this['id_project']; ?>/preview">
                    <span class="step off-last off<?php if ($this['step'] === 'preview') echo ' active'; else echo ' activable'; ?>">
                        <button type="button" name="view-step-preview" value="preview"><?php echo Text::get('step-7'); ?>
                        <strong class="number"></strong></button>                        
                    </span>
                    </a>

                </div>

            </fieldset>
        </div>