<?php
/*
 * This file is part of the Goteo Package.
 *
 * (c) Platoniq y Fundación Goteo <fundacion@goteo.org>
 *
 * For the full copyright and license information, please view the README.md
 * and LICENSE files that was distributed with this source code.
 */

namespace Goteo\Controller\Admin;

use Goteo\Application\Config;
use Goteo\Application\Exception\ModelNotFoundException;
use Goteo\Application\Message;
use Goteo\Library\Forms\FormModelException;
use Goteo\Library\Text;
use Goteo\Model\Category;
use Goteo\Model\SocialCommitment;
use Goteo\Model\Sphere;
use Goteo\Model\Sdg;
use Goteo\Model\Footprint;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;

/**
 * This module should admin Categories, Spheres, SocialCommitments, SDGs, Footprints
 * and its interelationships
 */
class CategoriesAdminController extends AbstractAdminController {
	protected static $icon = '<i class="fa fa-2x fa-object-group"></i>';
    protected static $label = 'admin-categories';

    protected $tabs = [
        'category' => [ 'text' => 'categories', 'model' => 'Category' ],
        'socialcommitment' => [ 'text' => 'social_commitments', 'model' => 'SocialCommitment' ],
        'sphere' => [ 'text' => 'spheres', 'model' => 'Sphere' ],
        'sdg' => ['text' => 'sdgs', 'model' => 'Sdg'],
        'footprint' => [ 'text' => 'footprints', 'model' => 'Footprint' ]
    ];

	// this modules is part of a specific group
	public static function getGroup() {
		return 'contents';
	}

	public static function getRoutes() {
		return [
			new Route(
				'/{tab}',
				['_controller' => __CLASS__ . "::listAction", 'tab' => 'category']
			),
			new Route(
				'/{tab}/edit/{id}',
                ['_controller' => __CLASS__ . "::editAction", 'tab' => 'category']
			),
			new Route(
				'/{tab}/add',
				['_controller' => __CLASS__ . "::editAction", 'tab' => 'category', 'id' => '']
			),
		];
	}

	public function listAction($tab = 'category', Request $request) {
        if(!isset($this->tabs[$tab])) throw new ModelNotFoundException("Not found type [$tab]");


        if($tab === 'socialcommitment') {
            $list = SocialCommitment::getAll(Config::get('lang'));
            $fields = ['id', 'icon', 'name', 'sdgs', 'footprints', 'langs', /*'order',*/ 'actions'];
        } elseif($tab === 'sphere') {
            $list = Sphere::getAll([], Config::get('lang'));
            $fields = ['id', 'icon', 'name', 'landing_match', 'sdgs', 'footprints', 'langs', /*'order',*/ 'actions'];
        } elseif($tab === 'sdg') {
            $list = Sdg::getList([],0,100, false, Config::get('lang'));
            $fields = ['id', 'icon', 'name', 'footprints', 'langs', 'actions'];
        } elseif($tab === 'footprint') {
            $list = Footprint::getList([],0,100, false, Config::get('lang'));
            $fields = ['id', 'icon', 'name', 'sdgs', 'categories', 'social_commitments', 'langs', 'actions'];
        } else {
            $list = Category::getAll(Config::get('lang'));
            $fields = ['id', 'name', 'social_commitment', 'sdgs', 'footprints', 'langs', /*'order',*/ 'actions'];
        }

		return $this->viewResponse('admin/categories/list', [
            'tab' => $tab,
            'tabs' => $this->tabs,
            'list' => $list,
            'fields' => $fields,
            'link_prefix' => '/categories/edit/',
        ]);
    }

    public function editAction($tab = 'category', $id = '', Request $request) {

        if(!isset($this->tabs[$tab])) throw new ModelNotFoundException("Not found type [$tab]");
        $model = $this->tabs[$tab]['model'];
        $fullModel = "\\Goteo\\Model\\$model";

        $instance = $id ? $fullModel::get($id, Config::get('sql_lang')) : new $fullModel();

        if (!$instance) {
            throw new ModelNotFoundException("Not found $model [$id]");
        }

        $defaults = (array) $instance;
        $processor = $this->getModelForm("Admin{$model}Edit", $instance, $defaults, [], $request);
        $processor->createForm();
        $processor->getBuilder()
            ->add('submit', 'submit', [
                'label' => $submit_label ? $submit_label : 'regular-submit',
            ]);
        if ($instance->id) {
            $processor->getBuilder()
                ->add('remove', 'submit', [
                    'label' => Text::get('admin-remove-entry'),
                    'icon_class' => 'fa fa-trash',
                    'span' => 'hidden-xs',
                    'attr' => [
                        'class' => 'pull-right-form btn btn-default btn-lg',
                        'data-confirm' => Text::get('admin-remove-entry-confirm'),
                    ],
                ]);
        }

        $form = $processor->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $request->isMethod('post')) {
            // Check if we want to remove an entry
            if ($form->has('remove') && $form->get('remove')->isClicked()) {
                try {
                    $instance->dbDelete(); //Throws and exception if fails
                } catch(\PDOException $e) {
                    Message::error($e->getMessage());
                }
                Message::info(Text::get('admin-remove-entry-ok'));
                return $this->redirect("/admin/categories/{$tab}");
            }

            try {
                $processor->save($form); // Allow save event if does not validate
                Message::info(Text::get('admin-' . ($id ? 'edit' : 'add') . '-entry-ok'));
                return $this->redirect("/admin/categories/{$tab}?" . $request->getQueryString());
            } catch (FormModelException $e) {
                Message::error($e->getMessage());
            }
        }

        return $this->viewResponse('admin/categories/edit', [
            'tab' => $tab,
            'form' => $form->createView(),
            'instance' => $instance,
            'user' => $user,
        ]);
	}
}
