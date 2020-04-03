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
    private const FINALITY = ["Venda", "Troca"];
    private const KIND = [
                          "Casa",
                          "Ponto Comercial",
                          "Barracão",
                          "Terreno",
                          "Sobrado",
                          "Sítio",
                          "Fazenda",
                          "Chácara"
                         ];

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

        $properties = (new Realty())->
        find(
            "user_id = :user",
            "user={$this->user->id}",
            "id, (SELECT name FROM person WHERE person.id = properties.proprietary) AS proprietary, " .
            "kind, finality "
        );
        $pager = new Pager(url("/imoveis/p/"));
        $pager->pager($properties->count(), 7, ($data['page'] ?? 1));
        $properties = (new Realty)->filter(
            $this->user,
            $data,
            $pager->limit(),
            $pager->offset()
        );

        echo $this->view->render("views/realty/index", [
        "user" => $this->user,
        "head" => $head,
        "finality" => RealtyController::FINALITY,
        "kinds" => RealtyController::KIND,
        "properties" => $properties,
        "paginator" => $pager->render(),
        "filter" => (object)[
            "finality" => ($data["finality"] ?? null),
            "kind" => ($data["kind"] ?? null)
          ]
        ]);
    }

    public function registrationForm(? array $data): void
    {
        if (!empty($data["id"])) {
            $id = filter_var($data["id"], FILTER_VALIDATE_INT);
            $realty = (new Realty())->findById($id);
        } else {
            $realty = null;
        }

        $head = $this->seo->render(
            "Cadastro de Imóveis - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/share.jpg"),
            false
        );

        $people = (new Person())->find(null, null, 'id,name')->fetch(true);


        $measureType = [
                        "Alqueire",
                        "Metro 2",
                        "Hectare",
                        "Km",
                        "Metro"
                      ];

        echo $this->view->render("views/realty/registration_form", [
                                 "head" => $head,
                                 "people" => $people,
                                 "finality" => RealtyController::FINALITY,
                                 "kinds" => RealtyController::KIND,
                                 "realty" => $realty,
                                 "measureType" => $measureType
                               ]);
    }

    public function save(array $data):void
    {
        if ($data['price'] == 0) {
            $json["message"] = $this->message->warning('Por favor, informe o preço do imóvel.')->render();
            echo json_encode($json);
            return;
        }

        if (empty($data["id"])) {
            $realty = new Realty();
            $message = "Imovel criado com sucesso!";
        } else {
            $id = filter_var($data["id"], FILTER_VALIDATE_INT);
            $realty = (new Realty())->findById($id);
            $message = "Imovel atualizado com sucesso!";
        }

        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        $realty->user_id = $this->user->id; //Vincular cadastro do imóvel ao usuário logado
        //Sobre o Imóvel
        $realty->proprietary = $data["proprietary"];
        $realty->finality = $data["finality"];
        $realty->kind = $data["kind"];
        $realty->price = str_replace([".", ","], ["", "."], $data["price"]);

        //Localização
        $realty->street = $data["street"];
        $realty->number = $data["number"];
        $realty->neighborhood = $data["neighborhood"];
        $realty->cep = $data["cep"];
        $realty->state = $data["state"];
        $realty->city = (isset($data["city"]) ? $data["city"] : '');
        $realty->complement = $data["complement"];
        $realty->situation = "Ativo";

        //Área
        $realty->measureType = $data["measureType"];
        $realty->zoneFront = $data["zoneFront"];
        $realty->zoneBottom = $data["zoneBottom"];
        $realty->zoneLeft = $data["zoneLeft"];
        $realty->zoneRight = $data["zoneRight"];

        //Características
        $realty->numberDorms = filter_var($data["numberDorms"], FILTER_VALIDATE_INT);
        $realty->numberSuites = filter_var($data["numberSuites"], FILTER_VALIDATE_INT);
        $realty->numberBathrooms = filter_var($data["numberBathrooms"], FILTER_VALIDATE_INT);
        $realty->numberRoom = filter_var($data["numberRoom"], FILTER_VALIDATE_INT);
        $realty->carsCapacity = filter_var($data["carsCapacity"], FILTER_VALIDATE_INT);
        $realty->isFurnished = $data["isFurnished"];

        if (!$realty->save()) {
            $json["message"] = $realty->message()->render();
            echo json_encode($json);
            return;
        }

        $this->message->success($message)->flash();
        $json["redirect"] = url("/imoveis");
        echo json_encode($json);
        return;
    }

    public function proprietary(? array $data): void
    {
        if (empty($data['term'])) {
            echo null;
            return;
        }

        $data['term'] = filter_var(trim($data['term']), FILTER_SANITIZE_STRIPPED);
        $term = "%{$data['term']}%";
        $proprietary = (new Person())->find(
            "user_id = {$this->user->id} AND (name LIKE '{$term}' OR nickname LIKE '{$term}')",
            null,
            "id, name, nickname"
        )->fetch(true);

        if ($proprietary) {
            $response = [];
            foreach ($proprietary as $property) {
                $response[] = [
                               'value' => "{$property->name} / {$property->nickname}",
                               'label' => "{$property->name} / {$property->nickname}",
                               'id' => $property->id
                              ];
            }
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }
        echo null;
    }

    public function filter(?array $data)
    {
        $finality = (!empty($data["finality"]) ? $data["finality"] : "Todas");
        $kind = (!empty($data["kind"]) ? $data["kind"] : "Todos");
        $json["redirect"] = url("/imoveis/{$finality}/{$kind}");
        echo json_encode($json);
    }
}
