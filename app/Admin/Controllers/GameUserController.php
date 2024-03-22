<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\GameUser;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Http\Request;

class GameUserController extends AdminController
{
    public $characters = [
        0 => [
            'name' => '鬼剑士（男）',
            'class' => [
                1 => '剑魂',
                2 => '鬼泣',
                3 => '狂战士',
                4 => '阿修罗',
                5 => '剑影',
            ],
        ],
        1 => [
            'name' => '格斗家（女）',
            'class' => [
                1 => '气功师',
                2 => '散打',
                3 => '街霸',
                4 => '柔道家',
            ]
        ],
        2 => [
            'name' => '神枪手（男）',
            'class' => [
                1 => '漫游枪手',
                2 => '枪炮师',
                3 => '机械师',
                4 => '弹药专家',
                5 => '合金战士',
            ]
        ],
        3 => [
            'name' => '魔法师（女）',
            'class' => [
                1 => '元素师',
                2 => '召唤师',
                3 => '战斗法师',
                4 => '魔道学者',
                5 => '小魔女',
            ]
        ],
        4 => [
            'name' => '圣职者（男）',
            'class' => [
                1 => '圣骑士',
                2 => '蓝拳圣使',
                3 => '驱魔师',
                4 => '复仇者',
            ]
        ],
        5 => [
            'name' => '神枪手（女）',
            'class' => [
                1 => '漫游枪手',
                2 => '枪炮师',
                3 => '机械师',
                4 => '弹药专家',
            ]
        ],
        6 => [
            'name' => '暗夜使者',
            'class' => [
                1 => '刺客',
                2 => '死灵术士',
                3 => '忍者',
                4 => '影舞者',
            ]
        ],
        7 => [
            'name' => '格斗家（男）',
            'class' => [
                1 => '气功师',
                2 => '散打',
                3 => '街霸',
                4 => '柔道家',
            ],
        ],
        8 => [
            'name' => '魔法师（男）',
            'class' => [
                1 => '元素爆破师',
                2 => '冰结师',
                3 => '血法师',
                4 => '逐风者',
                5 => '次元行者',
            ]
        ],
        9 => [
            'name' => '缔造者',
        ],
        10 => [
            'name' => '黑暗武士'
        ],
        11 => [
            'name' => '鬼剑士（女）',
            'class' => [
                1 => '驭剑士',
                2 => '暗殿骑士',
                3 => '契魔者',
                4 => '流浪武士',
                5 => '刃影',
            ]
        ],
        12 => [
            'name' => '守护者',
            'class' => [
                1 => '精灵骑士',
                2 => '混沌魔灵',
                3 => '帕拉丁',
                4 => '龙骑士',
            ]
        ],
        13 => [
            'name' => '魔枪士',
            'class' => [
                1 => '征战者',
                2 => '决战者',
                3 => '狩猎者',
                4 => '暗枪士',
            ]
        ],
        14 => [
            'name' => '圣职者（女）',
            'class' => [
                1 => '圣骑士',
                2 => '异端审判者',
                3 => '巫女',
                4 => '诱魔者',
            ]
        ],
        15 => [
            'name' => '枪剑士',
            'class' => [
                1 => '暗刃',
                2 => '特工',
                3 => '战线佣兵',
                4 => '源能专家',
            ]
        ],
    ];

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new GameUser(['computer','vpn','account']), function (Grid $grid) {
            $userController = $this;
//            $grid->column('id')->sortable();
            $grid->column('computer.pc_name','机器');
            $grid->column('vpn.remark','IP');
            $grid->column('account.email','邮箱');
            $grid->column('name');
            $grid->column('character_base')->display(function($base) use($userController){
                return $userController->getCharacterBaseName($base);
            });
            $grid->column('character_class')->display(function($class) use($userController){
                return $userController->getCharacterClassName($this->character_base,$class);
            });
            $grid->column('level');
            $grid->column('clear_dungeon_times');
            $grid->column('last_online_time');
            $grid->column('created_time');

//            $grid->filter(function (Grid\Filter $filter) {
//                $filter->equal('id');
//            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new GameUser(), function (Show $show) {
            $show->field('id');
            $show->field('pc_id');
            $show->field('ip_id');
            $show->field('account_id');
            $show->field('name');
            $show->field('character_base');
            $show->field('character_class');
            $show->field('level');
            $show->field('clear_dungeon_times');
            $show->field('last_online_time');
            $show->field('created_time');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new GameUser(), function (Form $form) {
            $form->display('id');
            $form->select('pc_id')->options('/api/computers')->load('ip_id', '/api/vpns');
            $form->select('ip_id')->load('account_id', '/api/accounts');
//            $form->text('pc_id');
//            $form->text('ip_id');
            $form->select('account_id');
            $form->text('name');
            $form->select('character_base')->options('/api/character_bases')->load('character_class','/api/character_classes');
            $form->select('character_class');
            $form->number('level');
            $form->number('clear_dungeon_times');
            $form->datetime('last_online_time');
            $form->datetime('created_time');
        });
    }

    public function characterBase()
    {
        $data = [];
        foreach ($this->characters as $base_id => $base_item) {
            $data[] = [
                'id' => $base_id,
                'text' => $base_item['name']
            ];
        }
        return $data;
    }

    public function characterClass(Request $request)
    {
        $id = $request->get('q');
        $data = [];
        foreach ($this->characters as $base_id => $base_item) {
            if ($base_id == 9 || $base_id == 10) {
                continue;
            }

            if ($base_id != $id) {
                continue;
            }

            foreach ($base_item['class'] as $class_id => $class_name) {
                $data[] = [
                    'id' => $class_id,
                    'text' => $class_name
                ];
            }

        }
        return $data;
    }

    public function getCharacterBaseName($id)
    {
        if(array_key_exists($id,$this->characters)){
            return $this->characters[$id]['name'];
        }
        return '';
    }

    public function getCharacterClassName($base,$class)
    {
        if(array_key_exists($base,$this->characters)){
            if($base == 9 || $base == 10)
            {
                return '无';
            }
            if(array_key_exists($class,$this->characters[$base]['class']))
            {
                return $this->characters[$base]['class'][$class];
            }
        }

        return '无';
    }
}
