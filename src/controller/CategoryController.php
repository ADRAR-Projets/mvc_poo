<?php

namespace controller;

require_once './src/model/UserModel.php';
require_once './src/model/CategoryModel.php';
require_once './view/CategoryView.php';
require_once './src/abstracts/Controller.php';

use abstracts\Controller;
use model\CategoryModel;
use model\UserModel;
use view\CategoryView;

class CategoryController extends Controller
{

    private CategoryView $categoryView;
    private UserModel $userModel;
    private CategoryModel $categoryModel;

    public function __construct()
    {
        parent::__construct();
        $this->categoryView = new CategoryView();
        $this->userModel = new UserModel();
        $this->categoryModel = new CategoryModel();

    }

    public function add(): string {
        if (isset($_POST["submit"])) {
            if (!empty($_POST["name"])) {

                $category = $this->categoryModel->getByName($_POST["name"]);

                if (!empty($category)) {
                    return "Une catégorie avec le meme nom existe déjà.";
                }
                $this->categoryModel->setName($_POST['name']);
                $this->categoryModel->add();
                return !empty($this->categoryModel->getByName($this->categoryModel->getName())) ? 'La catégorie à bien été ajouté.' : 'La catégorie n\'a pas été ajouté.';
            } else {
                return "veuillez remplir le champ...";
            }
        } else {
            return "wait... add category.";
        }
    }

    private function getAll(): string
    {
        $categoriesList = "";

        $categories = $this->categoryModel->getAll();

        foreach ($categories as $category) {
            $categoriesList .= "<li>ID: {$category['id']}, Nom: {$category['name']}</li>";
        }

        return $categoriesList;
    }


    public function render(): string
    {
        $this->categoryView->setMessage($this->add());
        $this->categoryView->setCategoriesList($this->getAll());

        return $this->getLayout()->displayView($this->getHeader()->displayView() . $this->categoryView->displayView() . $this->getFooter()->displayView());
    }
}