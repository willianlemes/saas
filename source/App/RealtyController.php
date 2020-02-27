<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Core\View;
use Source\Models\Auth;
use Source\Models\Realty;
use Source\Models\Person;
use Source\Support\Pager;

class RealtyController extends Controller
{
    /** @var User */
    private $user;

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VIEW_APP . "/");

        if (!$this->user = Auth::user()) {
            $this->message->warning("Efetue login para acessar o APP.")->flash();
            redirect("/entrar");
        }
    }

    public function index(?array $data): void
    {
        $head = $this->seo->render(
            "Meus Imóveis - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/share.jpg"),
            false
        );

        $properties = (new Realty())->find();
        $pager = new Pager(url("/imovel/p/"));
        $pager->pager($properties->count(), 7, ($data['page'] ?? 1));

        echo $this->view->render("views/realty/index", [
        "user" => $this->user,
        "head" => $head,
        "properties" => $properties->limit($pager->limit())->offset($pager->offset())->fetch(true),
        "paginator" => $pager->render(),
        "filter" => (object)[
            "status" => ($data["status"] ?? null),
            "category" => ($data["category"] ?? null),
            "date" => (!empty($data["date"]) ? str_replace("-", "/", $data["date"]) : null)
          ]
        ]);
    }

    public function registrationForm(): void
    {
        $head = $this->seo->render(
            "Cadastro de Imóveis - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/share.jpg"),
            false
        );

        $people = (new Person())->find(null, null, 'id,name')->fetch(true);
        $finality = [
           "Venda",
           "Troca"
        ];
        $types = [
          "Casa",
          "Ponto Comercial",
          "Barracão",
          "Terreno",
          "Sobrado",
          "Sítio",
          "Fazenda",
          "Chácara"
        ];

        echo $this->view->render("views/realty/registration_form", [
        "head" => $head,
        "people" => $people,
        "finality" => $finality,
        "types" => $types
      ]);
    }

    public function save(array $data):void
    {
        $realty = new Realty();
        $realty->name = $data["name"];

        if (!$realty->save()) {
            $json["message"] = $realty->message()->render();
            echo json_encode($json);
            return;
        }

        $this->message->success("Imovel criado com sucesso!")->flash();
        $json["redirect"] = url("/imovel");
        echo json_encode($json);
        return;
    }

    public function proprietary()
    {
      $proprietary = (new Person())->find(null,null,'id, name')->fetch(true);
      $first = true;
      $arrayJson = '[';
      foreach ($proprietary as $property) {
        if (!$first){
          $arrayJson .= ',';
        }else {
          $first = false;
        }
        $person['id'] = $property->id;
        $person['name'] = $property->name;
        $arrayJson .= json_encode($person,JSON_UNESCAPED_UNICODE);
      }
      $arrayJson .= ']';
      echo $arrayJson;
    }
}
