<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Menus Controller
 *
 * @property \App\Model\Table\MenusTable $Menus
 * @method \App\Model\Entity\Menu[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MenusController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
		$this->set('title', 'Menu Management');
        $this->paginate = [
            'contain' => ['ParentMenus'],
            'order' => [
                'lft' => 'ASC'
            ]
        ];
        $menus = $this->paginate($this->Menus);

        $this->set(compact('menus'));
    }

    /**
     * View method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $menu = $this->Menus->get($id, [
            'contain' => ['ParentMenus', 'ChildMenus'],
        ]);

        $this->set(compact('menu'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->set('title', 'New Menu');
        $menu = $this->Menus->newEmptyEntity();
        if ($this->request->is('post')) {
            $menu = $this->Menus->patchEntity($menu, $this->request->getData());
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The menu has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu could not be saved. Please, try again.'));
        }
        $parentMenus = $this->Menus->ParentMenus->find(
            'treeList',

            [
                'limit' => 200,
                'spacer' => str_repeat('&nbsp;', 3),
            ]
        )->all();
        $this->set(compact('menu', 'parentMenus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->set('title', 'Edit Menu');
        /* $menu = $this->Menus->get($id, [
            'contain' => [],
        ]); */
		$menu = $this->Menus->get($id, [
            'contain' => ['ParentMenus', 'ChildMenus'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $menu = $this->Menus->patchEntity($menu, $this->request->getData());
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The menu has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu could not be saved. Please, try again.'));
        }
        $parentMenus = $this->Menus->ParentMenus->find(
            'treeList',

            [
                'limit' => 200,
                'spacer' => str_repeat('&nbsp;', 3),
            ]
        )->all();
        $this->set(compact('menu', 'parentMenus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $menu = $this->Menus->get($id);
        if ($this->Menus->delete($menu)) {
            $this->Flash->success(__('The menu has been deleted.'));
        } else {
            $this->Flash->error(__('The menu could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function up($id = null, $spaces = 1)
    {
        $this->request->allowMethod(['post', 'delete']);
        $menu = $this->Menus->get($id);
        if ($this->Menus->moveUp($menu, $spaces)) {
            $this->Flash->success(__('The menu has been moved up.'));
        } else {
            $this->Flash->error(__('The menu could not be moved up. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function down($id = null, $spaces = 1)
    {
        $this->request->allowMethod(['post', 'delete']);
        $menu = $this->Menus->get($id);
        if ($this->Menus->moveDown($menu, $spaces)) {
            $this->Flash->success(__('The menu has been moved down.'));
        } else {
            $this->Flash->error(__('The menu could not be moved up. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function removeAndDelete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $menu = $this->Menus->get($id);

        $descendants = $this->Menus->find('children', ['for' => $menu->id])
            ->all();

        $this->Menus->removeFromTree($menu);

        if ($this->Menus->delete($menu)) {
            // $this->Menus->recover();

            foreach ($descendants as $child) {
                $childEntity = $this->Menus->get($child->id);
                $childEntity->level = $child->level - 1;
                $this->Menus->save($childEntity);
            }

            $this->Flash->success(__('The menu has been removed and deleted.'));
        } else {
            $this->Flash->error(__('The menu could not be removed and deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function authentication($id = null)
    {
        $menu = $this->Menus->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menu = $this->Menus->patchEntity($menu, $this->request->getData());
			$menu->auth = true;
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The menu has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu could not be saved. Please, try again.'));
        }
        $this->set(compact('menu'));
    }
	
	public function deauthentication($id = null)
    {
        $menu = $this->Menus->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menu = $this->Menus->patchEntity($menu, $this->request->getData());
			$menu->auth = false;
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The menu has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu could not be saved. Please, try again.'));
        }
        $this->set(compact('menu'));
    }
	
	public function admin($id = null)
    {
        $menu = $this->Menus->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menu = $this->Menus->patchEntity($menu, $this->request->getData());
			$menu->admin = true;
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The menu has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu could not be saved. Please, try again.'));
        }
        $this->set(compact('menu'));
    }
	
	public function nonAdmin($id = null)
    {
        $menu = $this->Menus->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menu = $this->Menus->patchEntity($menu, $this->request->getData());
			$menu->admin = false;
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The menu has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu could not be saved. Please, try again.'));
        }
        $this->set(compact('menu'));
    }
	
	public function active($id = null)
    {
        $menu = $this->Menus->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menu = $this->Menus->patchEntity($menu, $this->request->getData());
			$menu->active = true;
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The menu has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu could not be saved. Please, try again.'));
        }
        $this->set(compact('menu'));
    }
	
	public function disable($id = null)
    {
        $menu = $this->Menus->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menu = $this->Menus->patchEntity($menu, $this->request->getData());
			$menu->active = false;
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The menu has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu could not be saved. Please, try again.'));
        }
        $this->set(compact('menu'));
    }
	
	
}
