<?php

use Goteo\Library\Text,
    Goteo\Core\View,
    Goteo\Library\Lang;

$langs = Lang::getAll();

// hay que elegir un idioma al que traducir, no se puede traducir a español, español es el idioma original
if ($_SESSION['translate_lang'] == 'es') {
    unset($_SESSION['translate_lang']);
    unset($this['section']);
    unset($this['action']);
}


$bodyClass = 'admin';

include 'view/prologue.html.php';
include 'view/header.html.php'; ?>

        <div id="sub-header" style="margin-bottom: 10px;">
            <div class="breadcrumbs"><?php echo defined('ADMIN_BCPATH') ? ADMIN_BCPATH : "<strong>Traductor</strong>"; ?></div>
        </div>

<?php if(isset($_SESSION['messages'])) { include 'view/header/message.html.php'; } ?>

        <div id="main">
            
            <div class="widget">
                <?php echo new View ('view/translate/langs/selector.html.php', $this); ?>
            </div>

            <?php if (!empty($this['errors'])) : ?>
                <div class="widget">
                    <p>
                        <?php echo implode('<br />', $this['errors']); ?>
                    </p>
                </div>
            <?php endif; ?>

            <?php
            if (!empty($this['section']) && !empty($this['action'])) :
                echo new View ('view/translate/'.$this['section'].'/'.$this['action'].'.html.php', $this);
            else :
                foreach ($this['menu'] as $sCode=>$section) : ?>
                    <a name="<?php echo $sCode ?>"></a>
                    <div class="widget board collapse">
                        <h3 class="title"><?php echo $section['label'] ?></h3>
                        <ul>
                            <?php foreach ($section['options'] as $oCode=>$option) :
                                echo '<li><a href="/translate/'.$oCode.'">'.$option['label'].'</a></li>
                                    ';
                            endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach;

            endif; ?>

        </div>
<?php
include 'view/footer.html.php';
include 'view/epilogue.html.php';