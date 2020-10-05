<?php


namespace App\UseCases\Groups;


use App\Entity\Group;

class GroupService
{
    public function create($request)
    {
        $groups = Group::create([
            'title'=>$request['title'],
        ]);

        return $groups;
    }

    public function edit($request)
    {
        $groups = $this->getGroup($request['id']);

        $groups->title = $request['title'];

        $groups->save();

        return $groups;
    }

    public function delete($request)
    {
        $groups = $this->getGroup($request['id']);

        $groups->delete();
    }

    private function getGroup($id)
    {
        return Group::findOrFail($id);
    }
}
