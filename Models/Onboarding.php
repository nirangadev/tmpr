<?php
/*
** Model for the table on_boarding
*/
class Onboarding extends Model
{
    public function findAll()
    {
        $req = parent::all("onboarding");
        return $req;
    }

    public function findById($id)
    {
        $req = parent::findOne("onboarding", $id);
        return $req;
    }

}

?>