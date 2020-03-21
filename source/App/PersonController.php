<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Person;
use Source\Models\City;
use Source\Models\State;
use Source\Core\View;
use Source\Models\Auth;
use Source\Support\Pager;
use Source\Support\Thumb;
use Source\Support\Upload;

class PersonController extends Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VIEW_APP . "/");

        if (!$this->user = Auth::user()) {
            $this->message->warning("Efetue login para acessar o APP.")->flash();
            redirect("/entrar");
        }
    }

    public function index(? array $data):void
    {
        $head = $this->seo->render(
            "Pessoas - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/share.jpg"),
            false
        );

        $people = (new Person())->find(
            "user_id = :user",
            "user={$this->user->id}"
        );
        $pager = new Pager(url("/pessoas/p/"));
        $pager->pager($people->count(), 7, ($data['page'] ?? 1));

        echo $this->view->render("views/person/index", [
                                 "head" => $head,
                                 "people" => $people->limit($pager->limit())->offset($pager->offset())->fetch(true),
                                 "paginator" => $pager->render()
                               ]);
    }

    public function registrationForm(? array $data): void
    {
        if (!empty($data["id"])) {
            $id = filter_var($data["id"], FILTER_VALIDATE_INT);
            $person = (new Person())->findById($id);
        } else {
            $person = null;
        }

        $profiles = [
          "customer" => "Cliente",
          "broker" => "Corretor",
          "owner" => "Proprietário",
          "interested" => "Interessado",
          "other" => "Outro"
        ];

        $types = ["F" => "Física", "J" => "Jurídica"];

        $head = $this->seo->render(
            "Cadastro de Pessoas - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/share.jpg"),
            false
        );

        echo $this->view->render("views/person/registration_form", [
          "head" => $head,
          "person" => $person,
          "profiles" => $profiles,
          "types" => $types
        ]);
    }

    public function save(array $data):void
    {
        if (!empty($data["id"])) {
            $id = filter_var($data["id"], FILTER_VALIDATE_INT);
            $person = (new Person())->findById($id);
            $message = "Pessoa atualizado com sucesso!";
        } else {
            $person = new Person();
            $message = "Pessoa criado com sucesso!";
        }

        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        $person->user_id = $this->user->id;
        $person->profile = $data["profile"];
        $person->type = $data["type"];
        $person->name = $data["name"];
        $person->nickname = $data["nickname"];
        $person->genre = $data["genre"];

        if ($data["datebirth"]) {
            list($d, $m, $y) = explode("/", $data["datebirth"]);
            $person->datebirth = "{$y}-{$m}-{$d}";
        } else {
            $person->datebirth = "";
        }

        $person->rg = $data["rg"];
        $person->cpf = $data["cpf"];
        $person->occupation = $data["occupation"];
        $person->email = $data["email"];
        $person->phone = $data["phone"];
        $person->cellphone = $data["cellphone"];
        $person->street = $data["street"];
        $person->street_number = $data["street_number"];
        $person->neighborhood = $data["neighborhood"];
        $person->state = $data["state"];

        if (isset($data["city"])) {
            $person->city = $data["city"];
        } else {
            $person->city = "";
        }

        if (!empty($_FILES["photo"])) {
            $file = $_FILES["photo"];
            $upload = new Upload();

            if ($person->photo()) {
                (new Thumb())->flush("storage/{$person->photo}");
                $upload->remove("storage/{$person->photo}");
            }

            if (!$person->photo = $upload->image($file, "person-{$person->id}")) {
                $json["message"] = $upload->message()->before("Ooops.")->after(".")->render();
                echo json_encode($json);
                return;
            }
        }

        if (!$person->save()) {
            $json["message"] = $person->message()->render();
            echo json_encode($json);
            return;
        }

        $json["message"] = $this->message->success($message)->render();
        $json["redirect"] = url("/pessoas");
        echo json_encode($json);
        return;
    }

    public function cities(array $data):void
    {
        $cities = (new City())->findByState($data["state"]);
        echo json_encode($cities, JSON_PRETTY_PRINT);
        return;
    }
}
