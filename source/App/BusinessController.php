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
        );

        $pager = new Pager(url("/negocios/p/"));
        $pager->pager($businessList->count(), 7, ($data['page'] ?? 1));

        echo $this->view->render("views/business/index", [
                                 "user" => $this->user,
                                 "head" => $head,
                                 "businessList" => $businessList->limit($pager->limit())->offset($pager->offset())->fetch(true),
                                 "paginator" => $pager->render()
                                 ]);
    }

    public function registrationForm(? array $data): void
    {
        $clients = (new Person())->find(null, null, 'id,name')->fetch(true);
        $properties = (new Realty())->find(null, null, 'id,street')->fetch(true);

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

        $json = [];
        if ($business) {
            $json['id'] = $business->id;
            $json['user'] = $business->user_id;
            $json['client'] = $business->client_id;
            $json['title'] = $business->title;
            $json['realty'] = $business->realty_id;
            $json['stage'] = $business->stage;
            $json['expected_closure'] = $business->expected_closure;
            $json['annotations'] = $business->annotations;
            $json['teste'] = $json["expected_closure"];
        }
        echo json_encode($json);
    }

    public function save(array $data):void
    {
        // echo json_encode($data);
        // return;

        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        if (empty($data["id"])) {
            $business = new Business();
            $message = "Negócio criado com sucesso!";
        } else {
            $id = filter_var($data["id"], FILTER_VALIDATE_INT);
            $business = (new Business())->findById($id);
            $message = "Negócio atualizado com sucesso!";
        }

        $business->user_id = $this->user->id; //Vincular negócio ao usuário logado
        $business->client_id = $data["client"];
        $business->title = $data["title"];
        $business->realty_id = $data["realty"];
        $business->status = $data["status"];
        $business->expected_closure = $data["expected_closure"];
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
