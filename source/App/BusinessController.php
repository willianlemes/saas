<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Core\View;
use Source\Models\Auth;
use Source\Models\Realty;
use Source\Models\Person;
use Source\Models\Business;
use Source\Support\Pager;

class BusinessController extends Controller
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
            "Meus Negócios - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/share.jpg"),
            false
        );

        $businessList = (new Business())->find(
            "user_id = :user",
            "user={$this->user->id}"
        )->fetch(true);

        echo $this->view->render("views/business/index", [
                                 "user" => $this->user,
                                 "head" => $head,
                                 "businessList" => $businessList
                                 ]);
    }

    public function registrationForm(? array $data): void
    {
        $clients = (new Person())->find(null, null, 'id,name')->fetch(true);
        $properties = (new Realty())->find(null, null, 'street')->fetch(true);

        if (!empty($data["id"])) {
            $id = filter_var($data["id"], FILTER_VALIDATE_INT);
            $business = (new Business())->findById($id);
        } else {
            $business = null;
        }

        $head = $this->seo->render(
            "Registro de Negócios - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/share.jpg"),
            false
        );

        echo $this->view->render("views/business/registration_form", [
                                 "head" => $head,
                                 "clients" => $clients,
                                 "properties" => $properties,
                                 "business" => $business
                               ]);
    }

    public function save(array $data):void
    {
        if (empty($data["id"])) {
            $business = new Business();
            $message = "Negócio criado com sucesso!";
        } else {
            $id = filter_var($data["id"], FILTER_VALIDATE_INT);
            $business = (new Business())->findById($id);
            $message = "Negócio atualizado com sucesso!";
        }

        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        $business->user_id = $this->user->id; //Vincular negócio ao usuário logado
        $business->client_id = $data["client"];
        $business->title = $data["title"];
        $business->realty_id = $data["realty"];
        $business->stage = $data["stage"];

        if ($data["expected_closure"]) {
            list($d, $m, $y) = explode("/", $data["expected_closure"]);
            $person->expected_closure = "{$y}-{$m}-{$d}";
        } else {
            $person->expected_closure = '';
        }

        $business->annotations = $data["annotations"];

        if (!$business->save()) {
            $json["message"] = $business->message()->render();
            echo json_encode($json);
            return;
        }

        $this->message->success($message)->flash();
        $json["redirect"] = url("/negocios");
        echo json_encode($json);
        return;
    }
}
