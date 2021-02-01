<?php
include_once "controller/controller.php";
include_once "model/Utilisateur_model.php";
include_once "model/Message_model.php";
include_once "repository/utilisateurs_repo.php";

class Tchat_controller {
    private $bdd;
    function __construct()
    {
        $this->bdd = new BDD();
        $this->user_repo = new Utilisateur_repo();
        // $this->tchat_repo = new Tchat_repo();
    }
    
    function message()
    {
        
        $sqlMess = "SELECT * FROM message ORDER BY id_message DESC LIMIT 0,10";
        $result = $this->bdd->Request($sqlMess);
        $donneesMess = $result->fetchALL();
        $objects = array();
        foreach ($donneesMess as $objMess)
        {
            array_push($objects, new Message_model($objMess));
        }
        return $objects;
    }

    function messageHtml()
    {
        $messages=$this->message();
        $messages = array_reverse($messages);
        ob_start();
        foreach ($messages as $message) { ?>
            <div class="carte-head container ">
                <div class="bg-dark carte-head p-0">
                    <p><?php echo $message->autheur; ?> dit : </p>
                    <p class="d-flex bg-message justify-content-start w-100 flex-wrap carte-mess" style=""><?php echo $message->message; ?></p>
                    <p class="d-flex justify-content-end"><?php echo "à : ".$message->date; ?></p>
                </div>
            </div>
            <?php } 
            return ob_get_clean();
        
    }

    function SendMessage($message)
    {
        session_start();
        $idUser = $_SESSION['Connected']->ID;
        $user = $this->user_repo->GetById($idUser);
        $message = $this->bdd->secure($message);
        $InsertMess = "INSERT INTO message (autheur,message,date) VALUE(?,?,?)";
        $date = date("j/m/y H:i:s");
        $result = $this->bdd->Request($InsertMess,array($user->pseudo,$message,$date));
        $_POST['message'] = "";
        $message="";
        return $this->message();
    }
}
