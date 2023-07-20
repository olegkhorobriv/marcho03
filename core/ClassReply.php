<?php


namespace Core;


class ClassReply
{
    public $idReply;

    /**
     * @return mixed
     */
    public function getIdReply()
    {
        return $this->idReply;
    }


    public function getReplyComments(){
        $query = "select * from reply WHERE id_comments =".$this->idReply;
        return select($query);
    }


}